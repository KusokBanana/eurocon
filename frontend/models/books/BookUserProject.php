<?php

namespace frontend\models\books;

use frontend\models\Person;
use frontend\models\Project;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "book_user_project".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $project_id
 *
 * @property Person $user
 * @property Project $project
 */
class BookUserProject extends BookOwnerProject
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'book_participant_project';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(Person::className(), ['id' => 'user_id']);
    }

    public static function add($user_id, $project_id)
    {
        $isAdmin = BookOwnerProject::isAdmin($user_id, $project_id);
        if ($isAdmin)
            return false;

        return parent::add($user_id, $project_id);
    }

    public static function remove($user_id, $project_id)
    {
        $participant = self::findOne(['user_id' => $user_id, 'project_id' => $project_id]);
        if ($participant)
            $participant->delete();
    }

    public static function getParticipants($id, $isJustQuery = false)
    {
        $query = self::find()->where(['project_id' => $id])->joinWith('person');

        if (!$isJustQuery)
            $query->all();

        return $query;
    }

}
