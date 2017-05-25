<?php

namespace frontend\models\books;

use frontend\models\Community;
use frontend\models\Company;
use frontend\models\Person;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "book_admins_community".
 *
 * @property integer $id
 * @property integer $admin_id
 * @property integer $community_id
 *
 * @property Person $admin
 * @property Company $community
 */
class BookAdminCommunity extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'book_admin_community';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['admin_id', 'community_id'], 'required'],
            [['admin_id', 'community_id'], 'integer'],
            [['admin_id', 'community_id'], 'unique', 'targetAttribute' => ['admin_id', 'community_id'],
                'message' => 'The combination of Admin ID and Company ID has already been taken.'],
            [['admin_id'], 'exist', 'skipOnError' => true, 'targetClass' => Person::className(),
                'targetAttribute' => ['admin_id' => 'id']],
            [['community_id'], 'exist', 'skipOnError' => true, 'targetClass' => Community::className(),
                'targetAttribute' => ['community_id' => 'id']],
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
            'community_id' => 'Community ID',
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
    public function getCommunity()
    {
        return $this->hasOne(Company::className(), ['id' => 'community_id']);
    }
}
