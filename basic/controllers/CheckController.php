<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\data\Pagination;
use app\models\TimeStamps;
use app\models\Account;
use yii\db\Connection;

class CheckController extends Controller
{
    public function actionIndex()
    {
	$user = Yii::$app->request->get('name');
	$query = Yii::$app->db->createCommand('Select timestamps.date,timestamps.checkin,timestamps.checkout From timestamps Inner join account On account.id = timestamps.id And account.user="'.$user.'"')->queryAll();
        //var_dump(count($query));
	
	//var_dump(timestamps::find()->count());
	//die();
	$pagination = new Pagination([
            'defaultPageSize' => 2,
            'totalCount' => timestamps::find()->count(),
        ]);

        $list_check = $query;
            /*->offset($pagination->offset)
            ->limit($pagination->limit);*/

        return $this->render('index', [
            'list_check' => $list_check,
            /*'pagination' => $pagination,*/
        ]);
	
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
	$pass = $query->where('user=:user', [':user' => $input_user])->andWhere('password=:password', [':password' => $model->password])->one();
				if($pass != null)
					{
	
	return $this->redirect('index.php?r=check%2Findex&name='.$input_user);
					}
				}else{
	die();
				}
		}else{
	return $this->render('login',['model' => $model]);
		}
	}
}
