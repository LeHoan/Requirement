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
	$name = Yii::$app->request->get('name');
	$id = Yii::$app->request->get('id');
	if(isset($_POST["btnBack"])){
		return $this->redirect('index.php?r=check%2Fstaff&name='.$name.'&id='.$id);
	}else{
	$user = Yii::$app->request->get('name');
	$query = Yii::$app->db->createCommand('Select timestamps.date,timestamps.checkin,timestamps.checkout From timestamps 
			Inner join account On account.id = timestamps.id And account.user="'.$user.'"')->queryAll();
	
        $list_check = $query;
	
        return $this->render('index', [
            'list_check' => $list_check,
        ]);
	}
	}

	public function actionLogin()
	{
	$model = new Account();
	if($model->load(Yii::$app->request->post()) && $model->validate())
		{
		$query = account::find();
		$input_user = $model->user;
		$acc = $query->where('user=:user', [':user' => $input_user])->one();
			if($acc != null)
				{
				$model_acc = $query->where('user=:user', [':user' => $input_user])
						  ->andWhere('password=:password', [':password' => $model->password])->one();
				if($model_acc != null){
					if($model_acc['role'] == 1) {return $this->redirect('index.php?r=check%2Fadmin&name='.$input_user);}
					else if($model_acc['role'] == 0) {return $this->redirect('index.php?r=check%2Fstaff&name='.$input_user.'&id='.$model_acc['id']);}
						     }
				}else{
				Yii::$app->getSession()->setFlash('error', 'Wrong user or password');
				return $this->render('login',['model' => $model]);
					}	
		}else{return $this->render('login',['model' => $model]);}
	}

	public function actionStaff()
	{
	$name = Yii::$app->request->get('name');
	$id = Yii::$app->request->get('id');
		if(isset($_POST["btnShow"])){
		return $this->redirect('index.php?r=check%2Findex&name='.$name.'&id='.$id);
		}
		else if(isset($_POST["btnCheck"])){
			$query = Yii::$app->db->createCommand('Select * From timestamps 
			Inner join account On account.id = timestamps.id where date = curdate() And account.user="'.$name.'"')->queryAll();
				//var_dump($query)
				if($query == null){
				return $this->redirect('index.php?r=check%2Fconfirm_in&id='.$id.'&name='.$name);
				}else{
					if($query[0]["checkout"] == null){
					return $this->redirect('index.php?r=check%2Fconfirm_out&id='.$id.'&name='.$name);
						}else{
							echo "You can't checkout second time";
						}
					
					}
			}
			else{
			return $this->render('staff');
			}
	}
	public function actionAdmin()
	{
	return $this->render('admin');
	}

	public function actionConfirm_in(){
	$name = Yii::$app->request->get('name');
	$id = Yii::$app->request->get('id');
		if(isset($_POST["btnYes"])){
		$query = Yii::$app->db->createCommand('Insert into timestamps values('.$id.',curdate(),curtime(),null)')->execute();
		return $this->redirect('index.php?r=check%2Findex&name='.$name.'&id='.$id);
		}else{
		return $this->render('confirm_in');
		}
	}
	
	public function actionConfirm_out(){
	$name = Yii::$app->request->get('name');
	$id = Yii::$app->request->get('id');
		if(isset($_POST["btnYes"])){
		$query = Yii::$app->db->createCommand('Update timestamps set checkout = curtime() where date = curdate()')->execute();
		return $this->redirect('index.php?r=check%2Findex&name='.$name.'&id='.$id);
		}else{
		return $this->render('confirm_out');
		}
	}
}
