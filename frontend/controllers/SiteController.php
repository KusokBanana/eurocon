<?php
namespace frontend\controllers;

use common\models\User;
use frontend\models\books\BookFollowers;
use frontend\models\ChatHandler;
use frontend\models\Community;
use frontend\models\Company;
use frontend\models\Person;
use frontend\models\Project;
use frontend\models\Tag;
use frontend\widgets\CustomModal;
use UploadHandler;
use Yii;
use yii\base\InvalidParamException;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\helpers\VarDumper;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\web\NotFoundHttpException;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ],
            ],
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'logout' => ['post', 'get'],
//                ],
//            ],
        ];
    }

    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;
        if( $exception )
        {
            $statusCode = $exception->statusCode;
            $name = $exception->getName();
            $message = $exception->getMessage();
            if ($statusCode == '404') {
                return $this->renderPartial('/layouts/error_404');
            } else {
                return $this->render('error', [
                    'exception' => $exception,
                    'statusCode' => $statusCode,
                    'name' => $name,
                    'message' => $message
                ]);
            }

        }
    }

    public function beforeAction($action)
    {
        return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
//            'error' => [
//                'class' => 'yii\web\ErrorAction',
//            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $user = Yii::$app->user;

        if ($user->isGuest) {
            $person = Person::get();
            return $this->render('index', ['person' => $person]);

        } else {
            return $this->redirect(['/person/profile', 'id' => $user->id]);
        }

    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        $this->layout='login_page';

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['index']);
//            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $this->layout='login_page';

        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $this->layout='login_page';

        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }


    public function actionLocations()
    {

        $projects = Project::find()->where(['not', ['location' => null]])->all();
        $companies = Company::find()->where(['not', ['location' => null]])->all();
        $persons = Person::find()->where(['not', ['location' => null]])->all();
        $tags = Tag::getAllByTypes(true);
        $person = Person::get();

        return $this->render('locations', compact('projects', 'companies', 'persons', 'tags', 'person'));

    }

    public function actionAjaxSign($type, $action = 'get')
    {

        static $TYPE_LOGIN = 'login';
        static $TYPE_SIGNUP = 'signup';

        if (Yii::$app->request->isAjax) {
            if ($type == $TYPE_LOGIN)
                $model = new LoginForm();
            elseif ($type == $TYPE_SIGNUP)
                $model = new SignupForm();

            if ($action == 'get') {
                $modal = CustomModal::widget(['type' => $type, 'model' => $model]);
                return $modal;
            } elseif ($action == 'send') {
                if ($type == $TYPE_LOGIN) {
                    if ($model->load(Yii::$app->request->post()) && $model->login()) {
                        return json_encode(['success' => true,
                            'content' => 'You Successfully Login in Your Account!']);
                    } else {
                        $modal = CustomModal::widget([
                            'type' => $type,
                            'model' => $model,
                            'additionalData' => ['isAjax' => true]
                        ]);
                        return json_encode(['success' => false,
                            'content' => $modal]);
                    }
                } elseif ($type == $TYPE_SIGNUP) {
                    if ($model->load(Yii::$app->request->post())) {
                        if ($user = $model->signup()) {
                            if (Yii::$app->getUser()->login($user)) {
                                return json_encode(['success' => true,
                                    'content' => 'Your Account was Successfully Registered!']);
                            }
                        }
                        $modal = CustomModal::widget([
                            'type' => $type,
                            'model' => $model,
                            'additionalData' => ['isAjax' => true]
                        ]);
                        return json_encode(['success' => false,
                            'content' => $modal]);
                    }
                }
            } elseif ($action == 'toggle') {
                $modal = CustomModal::widget([
                    'type' => $type,
                    'model' => $model,
                    'additionalData' => ['isAjax' => true]
                ]);
                return $modal;
            }

        }

    }

    public function actionGetCountries($country = false)
    {

        $filename = Yii::getAlias('@frontend/web/includes/countries.json');
        $countries = file_get_contents($filename);
        $countries = Json::decode($countries, true);
        $q = Yii::$app->request->get('q');
        if (!$country) {
            $data = array_keys($countries);
            $result = ArrayHelper::getColumn($data, function ($element) {
                return ['id' => $element, 'text' => $element];
            });
            $result[0] = '';
        } else {
            $data = ArrayHelper::getValue($countries, $country, []);
            $result = [];
            foreach ($data as $value) {
                if ($q && mb_strstr(mb_strtolower($value), mb_strtolower($q)))
                    $result[] = ['id' => $value, 'text' => $value];
            }
        }


        if ($country) {
            $result = ['results' => $result];
        }

        return Json::encode($result);

    }


}
