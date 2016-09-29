<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\RegistrationForm;
use app\models\InsertForm;
use app\models\EditForm;
class SiteController extends Controller
{
	public $enableCsrfValidation = false;
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    public function actionRegistration() {
	$mRegistration = new RegistrationForm();
	$mRegistration->role = '0';
	//$mRegistration->id = null;
	if ($mRegistration->load(Yii::$app->request->post()) && $mRegistration->validate()) {
var_dump($mRegistration);
die();
	 //    $mRegistration->id = null;
	     $mRegistration->save();
	   
	    Yii::$app->session->setFlash('success','Account was created successfully.');
	}
    	return $this->render('registration', ['model' => $mRegistration]);	
    }

    public function actionShowTime() {
    $users = Yii::$app->db->createCommand('SELECT id,user FROM account')->queryAll();
//var_dump($users);
//die();
    return $this->render('showtime', ['users' => $users]); 
    }

    public function actionDetail() {
	$id =Yii::$app->request->get("id");
	$users = Yii::$app->db->createCommand('SELECT * FROM timestamps WHERE id ='.$id)->queryAll();
	return $this->render('detail', ['users' => $users]);
    }


     public function actionEdit() {
//	$date = Yii::$app->request->get("date");
//	$users = Yii::$app->db->createCommand('SELECT * FROM timestamps WHERE date='.$date)->queryOne();
	$mEdit = new EditForm();
	if($mEdit->load(Yii::$app->request->post()) && $mEdit->validate()){
	var_dump(Yii::$app->request->post());die();
	    $mEdit->save();
	}
	return $this->render('edit', ['model'=>$mEdit]);
     }

     public function actionInsert() {
//	$id = Yii::$app->request->get("id");
	$mInsert = new InsertForm();
	if($mInsert->load(Yii::$app->request->post()) && $mInsert->validate()){
//	var_dump(Yii::$app->request->post());die();
 //$mInsert->id = $id;
//	    var_dump($mInsert->id);die();
	    $mInsert->save();
	}
	return $this->render('insert', ['model' => $mInsert]);	
     }

}
