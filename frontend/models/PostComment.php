<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "post_comment".
 *
 * @property integer $id
 * @property integer $post_id
 * @property integer $reply_comment_id
 * @property string $date
 * @property integer $user_id
 * @property string $text
 *
 * @property Post $post
 * @property Person $user
 * @property PostComment $replyComment
 * @property PostComment[] $replies
 */
class PostComment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post_comment';
    }

    public $replies = [];

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'user_id', 'text'], 'required'],
            [['post_id', 'reply_comment_id', 'user_id'], 'integer'],
            [['date'], 'datetime'],
            [['date'], 'default', 'value' => date('Y-m-d H:i:s')],
            [['text'], 'string'],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(),
                'targetAttribute' => ['post_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Person::className(),
                'targetAttribute' => ['user_id' => 'id']],
            [['reply_comment_id'], 'exist', 'skipOnError' => true, 'targetClass' => PostComment::className(),
                'targetAttribute' => ['reply_comment_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_id' => 'Post ID',
            'reply_comment_id' => 'Reply Comment ID',
            'date' => 'Date',
            'user_id' => 'User ID',
            'text' => 'Text',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Person::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReplyComment()
    {
        return $this->hasOne(PostComment::className(), ['id' => 'reply_comment_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReplies()
    {
        return $this->hasMany(PostComment::className(), ['reply_comment_id' => 'id']);
    }


    public static function add($post_id, $text, $comment_id = null)
    {

        $newComment = new static();
        $newComment->post_id = $post_id;
        $newComment->reply_comment_id = $comment_id;
        $newComment->user_id = Yii::$app->user->id;
        $newComment->text = $text;
        return $newComment->save();

    }

}
