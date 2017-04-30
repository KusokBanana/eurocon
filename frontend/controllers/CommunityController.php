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
            $communities = $person->getCommunitiesData();
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
            $action = isset($data['action']) ? $data['action'] : false;
            $search = isset($data['search']) ? trim($data['search']) : '';

            if ($action == 'search') {
                $page = $data['page'] = 1;
            }

            switch ($type) {
                case 'communities':
                    $person = Person::findOne($data['id']);
                    $communities = $person->getCommunitiesData($page, $search);
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

    public function actionCreate()
    {

        $community = new Community();

        if ($community->load(Yii::$app->request->post())) {
            $communityId = $community->createNew();
            return $this->redirect(['view', 'id' => $communityId]);
        }

        return $this->render('create', compact('community'));
    }

    public function actionJoin($id)
    {

        $community = Community::findOne($id);
        if ($community) {
            $user = Yii::$app->user;
            $person = Person::getPerson($user);
            $result = $community->join($person->id);
            if ($result)
                return $this->redirect(['view', 'id' => $community->id]);
        }

    }

    public function actionLeave($id)
    {

        $community = Community::findOne($id);
        if ($community) {
            $user = Yii::$app->user;
            $person = Person::getPerson($user);
            $result = $community->leave($person->id);
            if ($result)
                return $this->redirect(['view', 'id' => $community->id]);
        }

    }

}
