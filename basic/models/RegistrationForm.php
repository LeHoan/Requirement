<?php
	namespace app\models;
	use Yii;
	use yii\base\Model;
	use yii\db\ActiveRecord;

class RegistrationForm extends ActiveRecord {
    public $repassword;


    //return array customized attribute labels
    public function attributeLabels() {
    	return [
	   'user'=>'UserName',
	   'password'=>'Password',
	   'repassword'=>'Re-enter password',
	   'role'=>'Role'
	];
    }
    public function rules() {
	return [
	   [['user','password','repassword'], 'required'],
	   ['repassword', 'compare', 'compareAttribute'=>'password'],
	   [['role'], 'safe'],
	  // ['id','default','value'=>NULL,'isEmpty'=>false,'on'=>'insert']
	];
    }

    public function setDefaultAttributes() {
   	$this->$id = null;
    }


    public static function tableName() {   
   	return '{{%account}}';
    }

}


?>
