<?php

namespace frontend\models\books;

use frontend\models\Company;
use frontend\models\Person;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "book_user_company".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $company_id
 *
 * @property Person $user
 * @property Company $company
 */
class BookUserCompany extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'book_user_company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'company_id'], 'required'],
            [['user_id', 'company_id'], 'integer'],
            [['user_id', 'company_id'], 'unique', 'targetAttribute' => ['user_id', 'company_id'], 'message' => 'The combination of User ID and Company ID has already been taken.'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['company_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'company_id' => 'Company ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }
}
