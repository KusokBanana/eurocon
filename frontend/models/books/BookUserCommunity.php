<?php

namespace frontend\models\books;

use frontend\models\Community;
use frontend\models\Company;
use frontend\models\Person;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "book_user_community".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $community_id
 * @property bool $is_confirmed [tinyint(1)]

 * @property Person $user
 * @property Company $company
 */
class BookUserCommunity extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'book_user_community';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'community_id'], 'required'],
            [['user_id', 'community_id'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Person::className(),
                'targetAttribute' => ['user_id' => 'id']],
            [['community_id'], 'exist', 'skipOnError' => true, 'targetClass' => Community::className(),
                'targetAttribute' => ['community_id' => 'id']],
            ['is_confirmed', 'boolean']
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
            'community_id' => 'Community ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(Person::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'community_id']);
    }

    public static function getParticipants($id, $isJustQuery = false)
    {
        $query = self::find()->where(['community_id' => $id, 'is_confirmed' => 1])->joinWith('person');

        if (!$isJustQuery)
            $query->all();

        return $query;
    }

    public static function add($user_id, $community_id, $is_confirmed = 0)
    {
        $isAdmin = BookAdminCommunity::isAdmin($user_id, $community_id);
        if ($isAdmin)
            return false;

        $newParticipant = new self();
        $newParticipant->user_id = $user_id;
        $newParticipant->community_id = $community_id;
        $newParticipant->is_confirmed = $is_confirmed;
        return $newParticipant->save();
    }

    public static function remove($user_id, $community_id)
    {
        $participant = self::findOne(['user_id' => $user_id, 'community_id' => $community_id]);
        if ($participant)
            $participant->delete();
    }

}
