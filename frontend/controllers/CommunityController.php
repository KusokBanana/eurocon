<?php

namespace frontend\controllers;

use frontend\models\Community;
use frontend\models\Person;
use frontend\models\Tag;
use Yii;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class CommunityController extends Controller
{

    public function actionIndex()
    {
        $user = Yii::$app->user;
        if (!$user->isGuest) {

            $person = Person::getPerson(Yii::$app->user);
            $communities = $person->getCompaniesData();
            return $this->render('index', compact('communities', 'person'));

        } else {

        }
    }


    public function actionAjaxReload()
    {
        if (Yii::$app->request->isAjax) {
            $page = Yii::$app->request->get('page');
            $type = Yii::$app->request->get('type');
            $data = Yii::$app->request->post('data');
            $data = Json::decode($data, true);

            switch ($type) {
                case 'communities':
                    $person = Person::findOne($data['id']); // TODO maybe change it to global user Yii::@app->user...
                    $communities = $person->getCompaniesData($page);
                    return $this->renderAjax('/tabs/_communities',
                        [
                            'communities' => $communities,
                            'additionData' => $data
                        ]);
                case Community::COMMUNITY_ADMIN_TYPE:
                    $community = Community::findOne($data['id']);
                    $admins = $community->getPersonsData(Community::COMMUNITY_ADMIN_TYPE, $page);
                    return $this->renderAjax('_persons',
                        [
                            'persons' => $admins,
                            'additionData' => $data
                        ]);
                case Community::COMMUNITY_PARTICIPANT_TYPE:
                    $community = Community::findOne($data['id']);
                    $participants = $community->getPersonsData(Community::COMMUNITY_PARTICIPANT_TYPE, $page);
                    return $this->renderAjax('_persons',
                        [
                            'persons' => $participants,
                            'additionData' => $data
                        ]);
            }

        }
    }


    public function actionView($id)
    {

        $company = Community::findOne($id);
        if (!$company) {
            throw new NotFoundHttpException();
        }

        $cooperation = $company->getPersonsData(Community::COMMUNITY_PARTICIPANT_TYPE);
        $admins = $company->getPersonsData(Community::COMMUNITY_ADMIN_TYPE);

        return $this->render('view', compact('company', 'cooperation', 'admins'));
    }

}
