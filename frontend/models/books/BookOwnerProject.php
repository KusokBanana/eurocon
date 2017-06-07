<?php

namespace frontend\models\books;

use frontend\models\Person;
use frontend\models\Project;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "book_owner_project".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $project_id
 *
 * @property Person $user
 * @property Project $project
 */
class BookOwnerProject extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'book_owner_project';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'project_id'], 'required'],
            [['user_id', 'project_id'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Person::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['project_id' => 'id']],
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
            'project_id' => 'Project ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(Person::className(), ['id' => 'user_id']);
    }

    public static function getAdmins($projectId)
    {
        return self::find()->where(['project_id' => $projectId])->joinWith('person')->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'project_id']);
    }

    public static function add($personId, $projectId)
    {
        if ($personId && $projectId) {
            $newParticipant = new static();
            $newParticipant->user_id = $personId;
            $newParticipant->project_id = $projectId;
            $newParticipant->save();
        }
    }

    public static function isAdmin($admin_id, $project_id)
    {
        return self::find()->where(['user_id' => $admin_id, 'project_id' => $project_id])->one();
    }

}
