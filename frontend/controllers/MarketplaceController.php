<?php

namespace frontend\controllers;

use frontend\models\books\BookMarketplace;
use frontend\models\MarketplaceItem;
use frontend\models\Person;
use frontend\models\Post;
use frontend\models\PostComment;
use frontend\widgets\Forum;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


class MarketplaceController extends Controller
{

    public function actionIndex()
    {
        $marketplaceItems = MarketplaceItem::getAll();

        return $this->render('index', compact('marketplaceItems'));

    }

    public function actionView($id)
    {
        $item = MarketplaceItem::findOne($id);
        if (!$item) {
            throw new NotFoundHttpException();
        }

        $posts = Post::getPostsData(Post::TYPE_MARKETPLACE, $id);
        $newPost = new Post();
        $newPost->field_id = $id;
        $projects = $item->getProjectsData(1, ['id' => $item->id]);

        return $this->render('view', compact('posts', 'newPost', 'item', 'projects'));

    }

    public function actionAjaxReload()
    {
        if (Yii::$app->request->isAjax) {
            $page = Yii::$app->request->get('page');
            $type = Yii::$app->request->get('type');
            $data = Yii::$app->request->post('data');
            $data = Json::decode($data, true);
            $action = isset($data['action']) ? $data['action'] : false;

            if ($action == 'search') {
                $page = $data['page'] = 1;
            }

            switch ($type) {
                case 'marketplace':
                    $marketplace = MarketplaceItem::getAll($page, $data);
                    return $this->renderAjax('_items',
                        [
                            'items' => $marketplace,
                        ]);

                case 'forum':
                    $posts = Post::getPostsData(Post::TYPE_MARKETPLACE, $data['id'], $page, $data);
                    return Forum::widget([
                        'data' => $posts,
                    ]);
                case 'projects':
                    $item = MarketplaceItem::findOne($data['id']);
                    $projects = $item->getProjectsData($page, $data);
                    return $this->renderAjax('/tabs/_projects',
                        [
                            'projects' => $projects
                    ]);
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
                        $post->type_for = Post::TYPE_MARKETPLACE;
                        $post->author_id = Yii::$app->user->id;
                        $post->saveImages();
                        $post->save();

                        $posts = Post::getPostsData(Post::TYPE_MARKETPLACE, $post->field_id);

                        return Forum::widget([
                            'data' => $posts->joinExtraData([
                                    'id' => $post->field_id
                                ]),
                            ]);

                    }

            }

        }
    }

    public function actionFollow($id)
    {

        $item = MarketplaceItem::findOne($id);
        if ($item) {
            $person = Person::get();
            $result = $item->follow($person->id);
            return $this->redirect(['view', 'id' => $item->id]);
        }

    }

    public function actionLeave($id)
    {

        $item = MarketplaceItem::findOne($id);
        if ($item) {
            $person = Person::get();
            $item->leave($person->id);
            return $this->redirect(['view', 'id' => $item->id]);
        }

    }

}