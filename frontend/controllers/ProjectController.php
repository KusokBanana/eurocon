<?php

namespace frontend\controllers;


use frontend\models\books\BookFollowers;
use frontend\models\books\BookMarketplace;
use frontend\models\books\BookOwnerProject;
use frontend\models\MarketplaceItem;
use frontend\models\Person;
use frontend\models\Post;
use frontend\models\PostComment;
use frontend\models\Project;
use frontend\models\ProjectTimeline;
use frontend\models\Tag;
use frontend\widgets\CustomModal;
use frontend\widgets\Forum;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\imagine\Image;

class ProjectController extends Controller
{

    public function actionIndex()
    {
        $user = Yii::$app->user;
        if (!$user->isGuest) {

            $person = Person::getPerson(Yii::$app->user);
            $projects = $person->projects;
            $tags = Tag::returnAllTags($projects);
            return $this->render('index', compact('projects', 'tags', 'person'));

        } else {

        }
    }

    public function actionView($id)
    {

        $project = Project::findOne($id);
        if ($project) {

            $user = Yii::$app->user;
            $participants = $project->getParticipantsData();
            $admins = BookOwnerProject::getAdmins($user->id);
            $project->setRelation($user);

            $follows = BookFollowers::getPossiblePeopleToSubscribeForCurrentUser();

            $participantsArray = ArrayHelper::getColumn($participants['data'], 'id');
            $adminsArray = ArrayHelper::getColumn($admins, 'user_id');
            $potentialSubscribers = [];
            if (!empty($follows)) {
                foreach ($follows as $follow) {
                    if (!ArrayHelper::isIn($follow->id, ArrayHelper::merge($participantsArray, $adminsArray)))
                        $potentialSubscribers[$follow->id] = $follow->full_name;
                }
            }

            $posts = Post::getPostsData(Post::TYPE_PROJECT, $id);
            $newPost = new Post();
            $newPost->field_id = $id;

            $projectTimeline = ProjectTimeline::find()->where(['project_id' => $id])->orderBy(['id' => SORT_DESC])->all();
            $marketplaceItems = MarketplaceItem::getData($project->id, BookMarketplace::TYPE_FOR_PROJECT);

            return $this->render('view',
                compact('project', 'participants', 'potentialSubscribers',
                    'projectTimeline', 'admins', 'posts', 'newPost', 'marketplaceItems'));

        }

    }

    public function actionAjaxReload()
    {
        if (Yii::$app->request->isAjax) {
            $page = Yii::$app->request->get('page');
            $type = Yii::$app->request->get('type');
            $data = Yii::$app->request->post('data');
            $data = Json::decode($data, true);
            $action = isset($data['action']) ? $data['action'] : false;
            $search = isset($data['search']) ? trim($data['search']) : '';

            if ($action == 'search') {
                $page = $data['page'] = 1;
            }

            switch ($type) {
                case 'participants':
                    $project = Project::findOne($data['id']);
                    $participants = $project->getParticipantsData($page, $search);
                    return $this->renderAjax('/tabs/_participants',
                        [
                            'participants' => $participants,
                            'additionData' => $data
                        ]);
                case 'forum':
                    $posts = Post::getPostsData(Post::TYPE_PROJECT, $data['id'], $page, $search);

                    return Forum::widget([
                        'data' => $posts,
                        'additionData' => $data
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
                        $post->type_for = Post::TYPE_PROJECT;
                        $post->saveImages();
                        $post->save();

                        $posts = Post::getPostsData(Post::TYPE_PROJECT, $post->field_id);

                        return Forum::widget([
                            'data' => $posts,
                            'additionData' => [
                                'id' => $post->field_id,
                                'search-wrapper-class' => 'input-search-dark'
                            ]
                        ]);

                    }

            }

        }
    }

    public function actionCreate()
    {

        $newProject = new Project();
        $person = Person::getPerson(Yii::$app->user);
        $follows = BookFollowers::getFollows($person->id, 1, '', BookFollowers::TYPE_ALL, true)['data'];
        $follows = ArrayHelper::map($follows, 'id', 'full_name');
        if ($newProject->load(Yii::$app->request->post())) {
            $newProject->createNew();
            if ($newProject->id) {
                return $this->redirect(['view', 'id' => $newProject->id]);
            }
        }

        return $this->render('create', compact('newProject', 'follows'));

    }

    public function actionUpdate($project_id)
    {

        $project = Project::findOne($project_id);
        if (!$project)
            return false;

        if ($project->load(Yii::$app->request->post())) {
            $post = Yii::$app->request->post('Project');
            if (isset($post['completion_date']))
                $project->completion_date = date('Y-m-d', strtotime($post['completion_date']));

            $project->updateProject();
            if ($project->id) {
                return $this->redirect(['view', 'id' => $project->id]);
            }
        }

    }

    public function actionTimeline($id = 0, $project_id)
    {

//        if (Yii::$app->request->isAjax) {
            $type = Yii::$app->request->post('type');

            if ($id) {
                $timeLine = ProjectTimeline::findOne($id);

                if ($type && $type == 'delete') {
                    $timeLine->delete();
                    $project = Project::findOne($project_id);
                    $project->setRelation(Yii::$app->user);
                    $projectTimeline = ProjectTimeline::find()->where(['project_id' => $project_id])
                        ->orderBy(['id' => SORT_DESC])->all();

                    return $this->renderAjax('_timeline', ['timelines' => $projectTimeline, 'project' => $project]);
                }

            } else {
                $timeLine = new ProjectTimeline();
                $timeLine->project_id = $project_id;
            }

            if (!$timeLine)
                return false;

            if ($timeLine->load(Yii::$app->request->post())) {
                switch ($timeLine->media_type_id) {
                    case ProjectTimeline::MEDIA_TYPE_IMAGE:
                        $files = UploadedFile::getInstances($timeLine, 'image_files');
                        $timeLine->saveFile($files);
                        break;
                    case ProjectTimeline::MEDIA_TYPE_VIDEO:
                        $file = UploadedFile::getInstance($timeLine, 'video');
                        $timeLine->saveFile($file);
                        break;
                }

                if ($type == 'request') {
                    $timeLine->is_active = 0;
                }

                $timeLine->save();

                if ($timeLine->id) {
                    return $this->redirect(['view', 'id' => $timeLine->project_id]);
                }
            }

            return CustomModal::widget(['type' => 'project_timeline_edit', 'model' => $timeLine]);
//        }

    }

    public function actionNews()
    {

        $user = Yii::$app->user;
//        $person = Person::getPerson($user);
        $projects = Project::find()->all();


        return $this->render('news', compact('projects'));

    }

    public function actionJoin($id)
    {

        $project = Project::findOne($id);
        if ($project) {
            $user = Yii::$app->user;
            $person = Person::getPerson($user);
            $result = $project->join($person->id);
            return $this->redirect(['view', 'id' => $project->id]);
        }

    }

    public function actionLeave($id)
    {

        $project = Project::findOne($id);
        if ($project) {
            $user = Yii::$app->user;
            $person = Person::getPerson($user);
            $project->leave($person->id);
            return $this->redirect(['view', 'id' => $project->id]);
        }

    }

}