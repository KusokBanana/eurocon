<?php

namespace frontend\controllers;

use frontend\models\books\BookMarketplace;
use frontend\models\Company;
use frontend\models\Location;
use frontend\models\MarketplaceItem;
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
        $person = Person::getPerson();
        $companies = Company::getData($person->id);
        return $this->render('index', compact('companies', 'person'));
    }


    public function actionAjaxReload()
    {
        if (Yii::$app->request->isAjax) {
            $page = Yii::$app->request->get('page');
            $type = Yii::$app->request->get('type');
            $data = Yii::$app->request->post('data');
            $data = Json::decode($data, true);
            $action = ArrayHelper::getValue($data, 'action', false);

            if ($action == 'search') {
                $page = $data['page'] = 1;
            }

            switch ($type) {
                case 'companies':
                    $person = Person::getPerson();
                    $companies = Company::getData($person->id, $page, $data);
                    return $this->renderAjax('_items',
                        [
                            'companies' => $companies,
                        ]);
                case 'projects':
                    $company = Company::findOne($data['id']);
                    $projects = $company->getProjectsData($page, $data);
                    return $this->renderAjax('_projects',
                        [
                            'projects' => $projects
                        ]);
                case Company::ROLE_ADMIN_TYPE:
                case Company::ROLE_PARTICIPANT_TYPE:
                    $company = Company::findOne($data['id']);
                    $company->setRelation(Yii::$app->user);
                    $persons = $company->getPersonsData($type, $page, $data);
                    return $this->renderAjax('_persons',
                        [
                            'persons' => $persons,
                            'company' => $company
                        ]);
                case 'marketplace':
                    $marketplace = MarketplaceItem::getData($data['id'], BookMarketplace::TYPE_FOR_COMPANY,
                        $page, $data);
                    return $this->renderAjax('/tabs/_marketplace',
                        [
                            'items' => $marketplace
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
        $marketplace = MarketplaceItem::getData($id, BookMarketplace::TYPE_FOR_COMPANY);
        $newMarketplaceItem = new MarketplaceItem();

        return $this->render('view', compact('company', 'cooperation', 'admins',
            'potentialSubscribers', 'projects', 'marketplace', 'newMarketplaceItem'));
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
