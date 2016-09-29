<?php
	namespace app\models;
	use Yii;
	use yii\base\Model;
	use yii\db\ActiveRecord;

class InsertForm extends ActiveRecord {

//public $id;

public function attributeLabels() {
	return [
	    'id'=>'ID',
	    'date'=>'Date',
	    'checkin'=>'Checkin',
	    'checkout'=>'CheckOut',
	];
}

public function rules() {
	return [
	    [['date','checkin','checkout'], 'required'],
	    ['date','date','message'=>'{attribute}: is not a date. Format: yyyy-MM-dd!', 'format'=>'yyyy-MM-dd'],
	    ['id', 'safe'],
	    ['checkin', 'date', 'message'=>'{attribute}: is not a time. Format: HH:mm!', 'format'=>'HH:mm'],
	    ['checkout', 'date', 'message'=>'{attribute}: is not a time. Format: HH:mm!', 'format'=>'HH:mm'],
	];
}
public static function tableName() {
	return '{{%timestamps}}';
}

}
?>
