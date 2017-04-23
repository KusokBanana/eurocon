<?php

namespace frontend\controllers;

use frontend\models\Company;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class CompanyController extends Controller
{
    public function actionView($id)
    {

        $company = Company::findOne($id);
        if (!$company) {
            throw new NotFoundHttpException();
        }

        $participants = $company->getPersonsData();

        return $this->render('view', compact('company', 'participants'));
    }

}
