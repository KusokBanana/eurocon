<?php

namespace frontend\controllers;

use frontend\models\Community;
use frontend\models\Company;
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
            $companies = $person->getCompaniesData();
            return $this->render('index', compact('companies', 'person'));

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
                case 'companies':
                    $person = Person::findOne($data['id']);
                    $companies = $person->getCompaniesData($page, $search);
                    return $this->renderAjax('/tabs/_companies',
                        [
                            'companies' => $companies,
                            'additionData' => $data
                        ]);
                case Community::ROLE_PARTICIPANT_TYPE:
                    $community = Community::findOne($data['id']);
                    $participants = $community->getPersonsData(Company::ROLE_PARTICIPANT_TYPE, $search);
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

        $community = Community::findOne($id);
        if (!$community) {
            throw new NotFoundHttpException();
        }
        $user = Yii::$app->user;
        $community->setRelation($user);

        $followers = $community->getPersonsData(Company::ROLE_PARTICIPANT_TYPE);
        $admins = $community->getPersonsData(Company::ROLE_ADMIN_TYPE);

        return $this->render('view', compact('community', 'followers', 'admins'));
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
            return $this->redirect(['view', 'id' => $community->id]);
        }

    }

    public function actionLeave($id)
    {

        $community = Community::findOne($id);
        if ($community) {
            $user = Yii::$app->user;
            $person = Person::getPerson($user);
            $community->leave($person->id);
            return $this->redirect(['view', 'id' => $community->id]);
        }

    }

    public function actionUpdate($id)
    {

        $community = Community::findOne($id);
        if (!$community)
            return false;

        if ($community->load(Yii::$app->request->post())) {

            $community->saveImage('image');
            $community->saveImage('background');

            $community->save();
            if ($community->id) {
                return $this->redirect(['view', 'id' => $community->id]);
            }
        }

    }

}
