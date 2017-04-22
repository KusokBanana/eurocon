<?php

namespace frontend\controllers;

use frontend\models\Company;

class CompanyController extends \yii\web\Controller
{
    public function actionView($id)
    {

        $company = Company::findOne($id);
        if (!$company) {
            throw new \yii\web\NotFoundHttpException();
        }

        $participants = $company->getPersonsData();

        return $this->render('index', compact('company', 'participants'));
    }

}
