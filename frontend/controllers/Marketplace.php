<?php
/**
 * Created by PhpStorm.
 * User: kusok
 * Date: 04.06.2017
 * Time: 20:21
 */

namespace frontend\controllers;

use Yii;
use yii\web\Controller;


class Marketplace extends Controller
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