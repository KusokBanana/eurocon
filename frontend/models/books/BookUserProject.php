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

}
