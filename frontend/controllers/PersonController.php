<?php
/**
 * Created by PhpStorm.
 * User: kusok
 * Date: 02.05.2017
 * Time: 16:47
 */

namespace frontend\controllers;


use common\models\User;
use frontend\models\books\BookFollowers;
use frontend\models\Community;
use frontend\models\Company;
use frontend\models\Location;
use frontend\models\Person;
use frontend\models\Project;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class PersonController extends Controller
{

    public function actionProfile($id)
    {

        $pageUser = User::findOne($id);
        if ($pageUser) {
            $person = Person::getPerson($pageUser);
        } else {
            throw new NotFoundHttpException();
        }

        $projects = $person->getProjectsData(1, Project::RELATION_ADMIN);
        $follows = BookFollowers::getFollows($person->id);
        $companies = $person->getCompaniesData(Company::ROLE_ADMIN_TYPE, 1);
        $communities = $person->getCommunitiesData(Community::ROLE_ADMIN_TYPE, 1, '');

        return $this->render('profile',
            compact('person', 'projects', 'follows', 'companies', 'communities'));

    }

    public function actionAjaxReload()
    {
        if (Yii::$app->request->isAjax) {
            $page = Yii::$app->request->get('page');
            $type = Yii::$app->request->get('type');
            $data = Yii::$app->request->post('data');
            $data = Json::decode($data, true);
            $action = isset($data['action']) ? $data['action'] : false;

            if ($action == 'search') {
                $page = $data['page'] = 1;
            }

            switch ($type) {
                case 'followers':
                    $follows = BookFollowers::getFollows($data['id'], $page, $data);
                    return $this->renderAjax('_followers',
                        [
                            'participants' => $follows
                        ]);
                case 'projects':
                    $person = Person::findOne($data['id']);
                    $projects = $person->getProjectsData($page, Project::RELATION_ADMIN, $data);
                    return $this->renderAjax('/tabs/_projects',
                        [
                            'projects' => $projects,
                        ]);
                case 'companies':
                    $person = Person::findOne($data['id']);
                    $companies = $person->getCompaniesData(Company::ROLE_ADMIN_TYPE, $page, $data);
                    return $this->renderAjax('/tabs/_companies',
                        [
                            'companies' => $companies,
                        ]);
                case 'communities':
                    $person = Person::findOne($data['id']);
                    $communities = $person->getCommunitiesData(Community::ROLE_ADMIN_TYPE, $page, $data);
                    return $this->renderAjax('/tabs/_communities',
                        [
                            'communities' => $communities,
                        ]);
            }

        }
    }

    public function actionUpdate($id)
    {

        $person = Person::findOne($id);
        if (!$person)
            return false;

        if ($person->load(Yii::$app->request->post())) {

            $person->savePerson();

            $person->save();
            if ($person->id) {
                return $this->redirect(['profile', 'id' => $person->id]);
            }
        }

    }


    public function actionFollow($id)
    {
        $person = Person::findOne($id);
        if ($person) {
            $requestPerson = Person::getPerson(Yii::$app->user);
            if ($requestPerson) {
                $result = BookFollowers::follow($requestPerson->id, $id);;
                if ($result)
                    $this->redirect(Yii::$app->request->referrer);
            }
        }
    }


    public function actionUnFollow($id)
    {
        $person = Person::findOne($id);
        if ($person) {
            $requestPerson = Person::getPerson(Yii::$app->user);
            if ($requestPerson) {
                $result = BookFollowers::unFollow($requestPerson->id, $id);;
                if ($result)
                    return $this->redirect(Yii::$app->request->referrer);
            }
        }
    }

}