<?php
/**
 * Created by PhpStorm.
 * User: kusok
 * Date: 02.05.2017
 * Time: 16:47
 */

namespace frontend\controllers;


use common\models\User;
use frontend\models\Friends;
use frontend\models\Person;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class PersonController extends Controller
{

    public function actionProfile($id)
    {

        $user = Yii::$app->user;

        $pageUser = User::findOne($id);
        if ($pageUser) {
            $person = Person::getPerson($pageUser);
        } else {
            throw new NotFoundHttpException();
        }

        $person->setRelation($user);
        $projects = $person->getProjectsData();
        $friends = Friends::getFriends($person->id);
        $communities = $person->getCommunitiesData();

        return $this->render('profile',
            compact('person', 'projects', 'friends', 'communities'));

    }

}