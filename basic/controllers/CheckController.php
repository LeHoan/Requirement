<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\data\Pagination;
use app\models\Timestamps;
use app\models\Account;
use yii\db\Connection;
use yii\helpers\Html;

class CheckController extends Controller
{
	public $enableCsrfValidation = false;
	
    public function actionIndex()
	{
	$session = Yii::$app->session;
	$name = $session->get('user');
	$id = $session->get('id');
	if(isset($_POST["btnCheck"])){
		$query = Yii::$app->db->createCommand('Select * From timestamps 
			Inner join account On account.id = timestamps.id where date = curdate() And account.user="'.$name.'"')->queryAll();
				if($query == null){
				return $this->redirect('index.php?r=check%2Fconfirm_in');
				}else{
					if($query[0]["checkout"] == null){
					return $this->redirect('index.php?r=check%2Fconfirm_out');
						}else{
							echo "You  can't checkout second time";
						}
					
					}
	}else{
	$query = Yii::$app->db->createCommand('Select timestamps.date,timestamps.checkin,timestamps.checkout From timestamps 
			Inner join account On account.id = timestamps.id And account.user="'.$name.'"')->queryAll();
	
        $list_check = $query;
	
        return $this->render('index', [
            'list_check' => $list_check,
        ]);
	}
	}

	public function actionLogin()
	{
	$model = new Account();
	$session = Yii::$app->session;
	$session->open();
	if($model->load(Yii::$app->request->post()) && $model->validate())
		{
		$query = account::find();
		$input_user = $model->user;
		$acc = $query->where('user=:user', [':user' => $input_user])->one();
			if($acc != null)
				{
				$model_acc = $query->where('user=:user', [':user' => $input_user])
						  ->andWhere('password=:password', [':password' => $model->password])->one();
				$session->set('id', "$model_acc->id");
				$session->set('user', "$model_acc->user");
				$session->set('role', "$model_acc->role");
				if($model_acc != null){
					if($model_acc['role'] == 1) {return $this->redirect('index.php?r=check%2Fadmin');}
					else if($model_acc['role'] == 0) {return $this->redirect('index.php?r=check%2Findex');}
						     }
				}else{
				Yii::$app->getSession()->setFlash('error', 'Wrong user or password');
				return $this->render('login',['model' => $model]);
					}	
		}else{
	if($session->get('user') == null){
	return $this->render('login',['model' => $model]);
	}else{
	if( $session->get('role')== 1) 
	{return $this->redirect('index.php?r=check%2Fadmin');}
					else if($session->get('role') == 0) {return $this->redirect('index.php?r=check%2Findex');}}}
	}
	public function actionAdmin()
	{
	$session = Yii::$app->session;
	$name = $session->get('user');
	$id = $session->get('id');
	if(isset($_POST["btnCheck"])){
		$query = Yii::$app->db->createCommand('Select * From timestamps 
			Inner join account On account.id = timestamps.id where date = curdate() And account.user="'.$name.'"')->queryAll();
				if($query == null){
				return $this->redirect('index.php?r=check%2Fconfirm_in');
				}else{
					if($query[0]["checkout"] == null){
					return $this->redirect('index.php?r=check%2Fconfirm_out');
						}else{
							echo "You  can't checkout second time";
						}
					
					}
	}else{
	$query = Yii::$app->db->createCommand('Select timestamps.date,timestamps.checkin,timestamps.checkout From timestamps 
			Inner join account On account.id = timestamps.id And account.user="'.$name.'"')->queryAll();
	
        $list_check = $query;
	
        return $this->render('admin', [
            'list_check' => $list_check,
        ]);
	}

	}
	
	public function actionLogout()
	{
	$session = Yii::$app->session;
	if($session->get('user') != null){
	$session->destroy();
	return $this->redirect('index.php?r=check%2Flogin');
	}else{
	return $this->redirect('index.php?r=check%2Flogin');
	}
	}
	
	public function actionConfirm_in(){
	$session = Yii::$app->session;
	$name = $session->get('user');
	$id = $session->get('id');
	$role = $session->get('role');
		if($role == 0){
		if(isset($_POST["btnYes"])){
		$query = Yii::$app->db->createCommand('Insert into timestamps values('.$id.',curdate(),curtime(),null)')->execute();
		return $this->redirect('index.php?r=check%2Findex');
		}else if(isset($_POST["btnNo"])){
		return $this->redirect('index.php?r=check%2Findex');
		}else{
		return $this->render('confirm_in');
		}
		}else{
			if(isset($_POST["btnYes"])){
		$query = Yii::$app->db->createCommand('Insert into timestamps values('.$id.',curdate(),curtime(),null)')->execute();
		return $this->redirect('index.php?r=check%2Fadmin');
		}else if(isset($_POST["btnNo"])){
		return $this->redirect('index.php?r=check%2Fadmin');
		}else{
		return $this->render('confirm_in');
		}
		}
	}
	
	public function actionConfirm_out(){
	$session = Yii::$app->session;
	$name = $session->get('user');
	$id = $session->get('id');
	$role = $session->get('role');
		if($role == 0){
		if(isset($_POST["btnYes"])){
		$query = Yii::$app->db->createCommand('Update timestamps set checkout = curtime() where date = curdate()')->execute();
		return $this->redirect('index.php?r=check%2Findex');
		}else if(isset($_POST["btnNo"])){
		return $this->redirect('index.php?r=check%2Findex');
		}
		else{
		return $this->render('confirm_out');
		}
		}else{
			if(isset($_POST["btnYes"])){
		$query = Yii::$app->db->createCommand('Update timestamps set checkout = curtime() where date = curdate()')->execute();
		return $this->redirect('index.php?r=check%2Fadmin');
		}else if(isset($_POST["btnNo"])){
		return $this->redirect('index.php?r=check%2Fadmin');
		}
		else{
		return $this->render('confirm_out');
		}
		}
	}
}
