<?php

namespace frontend\controllers;

use frontend\models\Company;

class CompanyController extends \yii\web\Controller
{
    public function actionIndex($id)
    {

        $company = Company::findOne($id);
        if (!$company) {
            throw new \yii\web\NotFoundHttpException();
        }

        return $this->render('index', ['company' => $company]);
    }

}
