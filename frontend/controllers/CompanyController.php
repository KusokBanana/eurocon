<?php

namespace frontend\controllers;

use frontend\models\Company;
use frontend\models\Person;
use frontend\models\Tag;
use Yii;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class CompanyController extends Controller
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


    public function actionPage()
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
            }

        }
    }


    public function actionView($id)
    {

        $company = Company::findOne($id);
        if (!$company) {
            throw new NotFoundHttpException();
        }

        $participants = $company->getPersonsData();

        return $this->render('view', compact('company', 'participants'));
    }

}
