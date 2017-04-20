<?php

namespace frontend\controllers;


use frontend\models\Project;
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

            $participants = $project->participants;

            return $this->render('view',
                compact('project', 'participants'));

        }

    }

}