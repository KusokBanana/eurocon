<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;


class MarketplaceController extends Controller
{

    public function actionIndex()
    {
        $user = Yii::$app->user;
        if (!$user->isGuest) {


            return $this->render('index', compact('companies', 'person'));

        } else {

        }
    }


}