<?php

namespace frontend\controllers;

use frontend\models\Company;
use frontend\models\Location;
use frontend\models\Person;
use frontend\models\Tag;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class CompanyController extends CommunityController
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
                case 'projects':
                    $company = Company::findOne($data['id']);
                    $projects = $company->getProjectsData($page, $search);
                    return $this->renderAjax('_projects',
                        [
                            'projects' => $projects,
                            'additionData' => $data
                        ]);
                case Company::ROLE_ADMIN_TYPE:
                case Company::ROLE_PARTICIPANT_TYPE:
                    $company = Company::findOne($data['id']);
                    $company->setRelation(Yii::$app->user);
                    $persons = $company->getPersonsData($type, $page);
                    return $this->renderAjax('_persons',
                        [
                            'persons' => $persons,
                            'additionData' => $data,
                            'company' => $company
                        ]);
            }

        }
    }


    public function actionView($id)
    {

        $company = Company::findOne($id);
        if (!$company) {
            throw new NotFoundHttpException();
        }

        $user = Yii::$app->user;
        $company->setRelation($user);
        $cooperation = $company->getPersonsData(Company::ROLE_PARTICIPANT_TYPE);
        $admins = $company->getPersonsData(Company::ROLE_ADMIN_TYPE);
        $potentialSubscribers = $company->getPotentialSubscribers();
        $projects = $company->getProjectsData();

        return $this->render('view', compact('company', 'cooperation', 'admins', 'potentialSubscribers', 'projects'));
    }

    public function actionCreate()
    {

        $company = new Company();

        if ($company->load(Yii::$app->request->post())) {
            $companyId = $company->createNew();
            return $this->redirect(['view', 'id' => $companyId]);
        }

        return $this->render('create', compact('company'));
    }

    public function actionJoin($id)
    {

        $company = Company::findOne($id);
        if ($company) {
            $user = Yii::$app->user;
            $person = Person::getPerson($user);
            $result = $company->join($person->id);
            if ($result)
                return $this->redirect(['view', 'id' => $company->id]);
        }

    }

    public function actionLeave($id)
    {

        $company = Company::findOne($id);
        if ($company) {
            $user = Yii::$app->user;
            $person = Person::getPerson($user);
            $result = $company->leave($person->id);
            if ($result)
                return $this->redirect(['view', 'id' => $company->id]);
        }

    }


    public function actionUpdate($id)
    {

        $company = Company::findOne($id);
        if (!$company)
            return false;

        if ($company->load(Yii::$app->request->post())) {

            $company->updateCompany();

            if ($company->id) {
                return $this->redirect(['view', 'id' => $company->id]);
            }
        }

    }

    public function actionUpdatePersons($id)
    {
        $company = Company::findOne($id);
        if (!$company)
            return false;

        if ($company->load(Yii::$app->request->post())) {
            $company->addNewUsers();
        }

        return $this->redirect(['view', 'id' => $company->id]);

    }

}
