<?php

namespace frontend\controllers;

use frontend\models\Community;
use frontend\models\Company;
use frontend\models\Person;
use frontend\models\Post;
use frontend\models\PostComment;
use frontend\models\Tag;
use frontend\widgets\Forum;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class CommunityController extends Controller
{

    public function actionIndex()
    {
        $person = Person::get();
        $communities = Community::getData($person->id, 1, ['wrapSelector' => '#communitiesWrap']);
        return $this->render('index', compact('communities', 'person'));
    }


    public function actionAjaxReload()
    {
        if (Yii::$app->request->isAjax) {
            $page = Yii::$app->request->get('page');
            $type = Yii::$app->request->get('type');
            $data = Yii::$app->request->post('data');
            $data = Json::decode($data, true);
            $action = ArrayHelper::getValue($data, 'action', false);

            if ($action == 'search') {
                $page = $data['page'] = 1;
            }

            switch ($type) {
                case 'communities':
                    $person = Person::get();
                    $communities = Community::getData($person->id, $page, $data);
                    return $this->renderAjax('_items',
                        [
                            'communities' => $communities,
                        ]);
                case Community::ROLE_PARTICIPANT_TYPE:
                    $community = Community::findOne($data['id']);
                    $participants = $community->getPersonsData(Company::ROLE_PARTICIPANT_TYPE, $data);
                    return $this->renderAjax('_persons',
                        [
                            'persons' => $participants,
                        ]);

                case 'forum':
                    $posts = Post::getPostsData(Post::TYPE_COMMUNITY, $data['id'], $page, $data);
                    return Forum::widget([
                        'data' => $posts,
                    ]);
            }

        }
    }


    public function actionView($id)
    {

        $community = Community::findOne($id);
        if (!$community) {
            throw new NotFoundHttpException();
        }
        $user = Yii::$app->user;
        $community->setRelation($user);

        $followers = $community->getPersonsData(Company::ROLE_PARTICIPANT_TYPE);
        $admins = $community->getPersonsData(Company::ROLE_ADMIN_TYPE);

        $posts = Post::getPostsData(Post::TYPE_COMMUNITY, $id);
        $newPost = new Post();
        $newPost->field_id = $id;

        return $this->render('view', compact('community', 'followers', 'admins', 'posts', 'newPost'));
    }

    public function actionCreate()
    {

        $community = new Community();

        if ($community->load(Yii::$app->request->post())) {
            $communityId = $community->createNew();
            return $this->redirect(['view', 'id' => $communityId]);
        }

        return $this->render('create', compact('community'));
    }

    public function actionJoin($id)
    {

        $community = Community::findOne($id);
        if ($community) {
            $user = Yii::$app->user;
            $person = Person::get($user);
            $result = $community->join($person->id);
            return $this->redirect(['view', 'id' => $community->id]);
        }

    }

    public function actionLeave($id)
    {

        $community = Community::findOne($id);
        if ($community) {
            $user = Yii::$app->user;
            $person = Person::get($user);
            $community->leave($person->id);
            return $this->redirect(['view', 'id' => $community->id]);
        }

    }

    public function actionUpdate($id)
    {

        $community = Community::findOne($id);
        if (!$community)
            return false;

        if ($community->load(Yii::$app->request->post())) {

            $community->saveImage('image');
            $community->saveImage('background');
            Tag::updateAllTags($community->tagValues, $community->id, Tag::COMMUNITY_TYPE);

            $community->save();
            if ($community->id) {
                return $this->redirect(['view', 'id' => $community->id]);
            }
        }

    }

    public function actionForum($post_id, $comment_id = null)
    {

        if (Yii::$app->request->isAjax) {

            $text = Yii::$app->request->post('text');
            $action = Yii::$app->request->get('action');

            switch ($action) {
                case 'add':
                    $res = PostComment::add($post_id, $text, $comment_id);
                case 'show':
                    $post = Post::find()->where([Post::tableName().'.id' => $post_id])
                        ->joinWith('comments')->one();
                    /** @var Post $post */
                    if ($post)
                        $post->setCommentaries();


                    return Forum::widget([
                        'type' => Forum::$TYPE_COMMENTS,
                        'data' => $post,
                        'index' => 0
                    ]);

                case 'create':
                    $post = new Post();
                    if ($post->load(Yii::$app->request->post())) {
                        $post->type_for = Post::TYPE_COMMUNITY;
                        $post->author_id = Yii::$app->user->id;
                        $post->saveImages();
                        $post->save();

                        $posts = Post::getPostsData(Post::TYPE_COMMUNITY, $post->field_id);

                        return Forum::widget([
                            'data' => $posts->joinExtraData([
                                    'id' => $post->field_id
                                ])
                        ]);

                    }

            }

        }
    }

}
