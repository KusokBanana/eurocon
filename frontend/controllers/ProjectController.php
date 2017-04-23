<?php

namespace frontend\controllers;


use frontend\models\Person;
use frontend\models\Project;
use frontend\models\Tag;
use Yii;
use yii\helpers\Json;
use yii\helpers\VarDumper;
use yii\web\Controller;

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

            $participants = $project->getParticipantsData();

            return $this->render('view',
                compact('project', 'participants'));

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

}