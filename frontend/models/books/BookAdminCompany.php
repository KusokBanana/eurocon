<?php

namespace frontend\models\books;

use frontend\models\Company;
use frontend\models\Person;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "book_admin_company".
 *
 * @property integer $id
 * @property integer $admin_id
 * @property integer $company_id
 *
 * @property Person $admin
 * @property Company $company
 */
class BookAdminCompany extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'book_admin_company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['admin_id', 'company_id'], 'required'],
            [['admin_id', 'company_id'], 'integer'],
            [['admin_id', 'company_id'], 'unique', 'targetAttribute' => ['admin_id', 'company_id'], 'message' => 'The combination of Admin ID and Company ID has already been taken.'],
            [['admin_id'], 'exist', 'skipOnError' => true, 'targetClass' => Person::className(), 'targetAttribute' => ['admin_id' => 'id']],
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
            'admin_id' => 'Admin ID',
            'company_id' => 'Company ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdmin()
    {
        return $this->hasOne(Person::className(), ['id' => 'admin_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }
}
