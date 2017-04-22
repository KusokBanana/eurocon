<?php

namespace frontend\controllers;


use frontend\models\Project;
use Yii;
use yii\helpers\Json;
use yii\web\Controller;

class ProjectController extends Controller
{

    public function actionIndex()
    {

        return $this->render('index');

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