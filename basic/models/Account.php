<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

class Account extends ActiveRecord
{	
    public function rules()
    {
        return [
            [['user', 'password'], 'required'],
        ];
    }

   }
