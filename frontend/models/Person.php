<?php

namespace frontend\models;

use common\models\User;
use Yii;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $birthday
 * @property string $phone
 * @property string $image
 * @property string $surname
 * @property string $name
 */
class Person extends User
{

    private static $quest_id = 5;
    private static $avatar_path = '@web/img/avatars/person/';

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'name'], 'required'],
            [['birthday'], 'safe'],
            [['username', 'email'], 'string', 'max' => 255],
            [['phone', 'image', 'surname', 'name'], 'string', 'max' => 65],
            [['username'], 'unique'],
            [['password_reset_token'], 'unique'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
//            'auth_key' => 'Auth Key',
//            'password_hash' => 'Password Hash',
//            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
//            'status' => 'Status',
//            'created_at' => 'Created At',
//            'updated_at' => 'Updated At',
            'birthday' => 'Birthday',
            'phone' => 'Phone',
            'image' => 'Image',
            'surname' => 'Surname',
            'name' => 'Name',
        ];
    }


    /*
     *  $person = new Person();
        $person->username = 'username';
        $person->name = 'Josef';
        $person->surname = 'Schwaiger';
        $person->birthday = date('Y-m-d', strtotime('01.01.1980'));
        $person->setPassword('username');
        $person->generateAuthKey();
        $person->save();
    */

    public static function getPerson($user)
    {

        if ($user->isGuest) {
            return self::findOne(self::$quest_id);
        } else {
            return self::findOne($user->id);
        }

    }

    public function afterFind()
    {
        parent::afterFind(); // TODO: Change the autogenerated stub

        $image = $this->image;
        if ($image) {
            $this->image = self::$avatar_path . $image;
        } else {
            $this->image = '@web/img/portraits/5.jpg';
        }

    }


}
