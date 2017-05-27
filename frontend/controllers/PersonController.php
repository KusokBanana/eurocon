<?php
/**
 * Created by PhpStorm.
 * User: kusok
 * Date: 02.05.2017
 * Time: 16:47
 */

namespace frontend\controllers;


use common\models\User;
use frontend\models\Community;
use frontend\models\Company;
use frontend\models\Friends;
use frontend\models\Location;
use frontend\models\Person;
use frontend\models\Project;
use Yii;
use yii\helpers\Json;
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
        $projects = $person->getProjectsData(1, '', Project::RELATION_ADMIN);
        $friends = Friends::getFriends($person->id);
        $companies = $person->getCompaniesData(1, '', Company::ROLE_ADMIN_TYPE);
        $communities = $person->getCommunitiesData(1, '', Community::ROLE_ADMIN_TYPE);

        return $this->render('profile',
            compact('person', 'projects', 'friends', 'companies', 'communities'));

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
                case 'friends':
                    $friends = Friends::getFriends($data['id'], $page, $search);
                    return $this->renderAjax('/tabs/_participants',
                        [
                            'participants' => $friends,
                            'additionData' => $data
                        ]);
                case 'projects':
                    $person = Person::findOne($data['id']);
                    $projects = $person->getProjectsData($page, $search, Project::RELATION_ADMIN);
                    return $this->renderAjax('/tabs/_projects',
                        [
                            'projects' => $projects,
                            'additionData' => $data
                        ]);
                case 'companies':
                    $person = Person::findOne($data['id']);
                    $companies = $person->getCompaniesData($page, $search, Company::ROLE_ADMIN_TYPE);
                    return $this->renderAjax('/tabs/_companies',
                        [
                            'companies' => $companies,
                            'additionData' => $data
                        ]);
                case 'communities':
                    $person = Person::findOne($data['id']);
                    $communities = $person->getCommunitiesData($page, $search, Community::ROLE_ADMIN_TYPE);
                    return $this->renderAjax('/tabs/_communities',
                        [
                            'communities' => $communities,
                            'additionData' => $data
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

}