<?php

namespace frontend\controllers;


use frontend\models\Friends;
use frontend\models\Person;
use frontend\models\Project;
use frontend\models\ProjectTimeline;
use frontend\models\Tag;
use frontend\widgets\CustomModal;
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
            $project->setRelation($user);

            $friends = Friends::getFriends($user->id, 1, '', true)['data'];

            $participantsArray = ArrayHelper::getColumn($participants['data'], 'id');
            $adminsArray = ArrayHelper::getColumn($project->owners, 'user_id');
            $potentialSubscribers = [];
            foreach ($friends as $friend) {
                if (!ArrayHelper::isIn($friend->id, ArrayHelper::merge($participantsArray, $adminsArray)))
                    $potentialSubscribers[$friend->id] = $friend->full_name;
            }

            $projectTimeline = ProjectTimeline::find()->where(['project_id' => $id])->orderBy(['id' => SORT_DESC])->all();

            return $this->render('view',
                compact('project', 'participants', 'potentialSubscribers', 'projectTimeline'));

        }

    }

    public function actionPage()
    {
        if (Yii::$app->request->isAjax) {
            $page = Yii::$app->request->get('page');
            $type = Yii::$app->request->get('type');
            $data = Yii::$app->request->post('data');
            $data = Json::decode($data, true);

            switch ($type) {
                case 'participants':
                    $project = Project::findOne($data['id']);
                    $participants = $project->getParticipantsData($page);
                    return $this->renderAjax('/tabs/_participants',
                        [
                            'participants' => $participants,
                            'additionData' => $data
                        ]);

            }

        }
    }

    public function actionCreate()
    {

        $newProject = new Project();
        $person = Person::getPerson(Yii::$app->user);
        $friends = Friends::getFriends($person->id, 1, '', true)['data'];
        $friends = ArrayHelper::map($friends, 'id', 'full_name');
        if ($newProject->load(Yii::$app->request->post())) {
            $newProject->createNew();
            if ($newProject->id) {
                return $this->redirect(['view', 'id' => $newProject->id]);
            }
        }

        return $this->render('create', compact('newProject', 'friends'));

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

            $file = UploadedFile::getInstance($project, 'imageFile');
            $project->saveImage($file, 'image');
            $file = UploadedFile::getInstance($project, 'background_imageFile');
            $project->saveImage($file, 'background_image');

            $project->updateProject();
            if ($project->id) {
                return $this->redirect(['view', 'id' => $project->id]);
            }
        }

    }

    public function actionTimeline($id = 0, $project_id)
    {

        if (Yii::$app->request->isAjax) {
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
//                    $files = UploadedFile::getInstances($timeLine, 'image_files');
//                    $timeLine->saveFile($files);
//                    break;
                }
//            $file = UploadedFile::getInstance($timeLine, 'video');
//            $project->saveImage($file, 'background_image');
                if ($type == 'request') {
                    $timeLine->is_active = 0;
                }
                $timeLine->save();

                if ($timeLine->id) {
                    return $this->redirect(['view', 'id' => $timeLine->project_id]);
                }
            }

            return CustomModal::widget(['type' => 'project_timeline_edit', 'model' => $timeLine]);
        }

    }

    public function actionNews()
    {

        $user = Yii::$app->user;
//        $person = Person::getPerson($user);
        $projects = Project::find()->all();


        return $this->render('news', compact('projects'));

    }

}