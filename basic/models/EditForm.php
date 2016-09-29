<?php
namespace app\models;
use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

class EditForm extends ActiveRecord {
public function attributeLabels() {
	return [
	    'id'=>'ID',
	    'date'=>'Date',
	    'checkin'=>'CheckIn',
	    'checkout'=>'CheckOut'	
	];
}

public function rules() {
	return [
	    [['checkin','checkout'],'required'],
	    ['id', 'safe'],
	    ['date', 'safe']
	];
}
public static function tableName() {
	return '{{%timestamps%}}';
}


}
?>
