<?php
namespace frontend\modules\chat\models\db;

use frontend\modules\chat\models\DataProvider;
use frontend\models\Person;
use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\Html;

/**
 * Class Model
 * @package frontend\models\chat\db
 *
 * @property integer $id
 * @property integer $sender_id
 * @property integer $receiver_id
 * @property string $text
 * @property integer $is_new
 * @property string $created_at
 *
 * @property Person $sender
 * @property Person $receiver
 *
 * @property-read mixed newMessages
 *
 *
 */
class Message extends ActiveRecord
{
    public static function tableName()
    {
        return 'chat_message';
    }

    public $isUnread;

    /**
     * @inheritDoc
     */
    public function rules()
    {
        return [
            [['sender_id', 'receiver_id', 'text', 'created_at'], 'required', 'on' => 'create'],
            [['sender_id', 'receiver_id', 'is_new'], 'integer'],
            [['created_at'], 'safe'],
            [['text'], 'string', 'max' => 1020],
            [['sender_id'], 'exist', 'skipOnError' => true, 'targetClass' => Person::className(),
                'targetAttribute' => ['sender_id' => 'id']],
            [['receiver_id'], 'exist', 'skipOnError' => true, 'targetClass' => Person::className(),
                'targetAttribute' => ['receiver_id' => 'id']],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLastMessage()
    {
        return $this->hasOne(Message::className(), ['id' => 'last_message_id']);
    }

    public static function getMiniChatData($user_id)
    {

        $conversations = static::find()
            ->where(['or',
                ['chat_message.sender_id' => $user_id],
                ['chat_message.receiver_id' => $user_id]
            ])
            ->addSelect(['*', 'chat_message.isUnread'])
            ->orderBy(['id' => SORT_DESC])
            ->joinWith('lastMessage')
            ->groupBy(['chat_message.contact_id']);

    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSender()
    {
        return $this->hasOne(Person::className(), ['id' => 'sender_id']);
    }

    /**
     * @param int $userId
     * @param int $contactId
     * @param int $limit
     * @param bool $history
     * @param int $key
     * @return DataProvider
     * @since 2.0
     */
    public static function get($userId, $contactId, $limit, $history = true, $key = null)
    {
        $query = static::baseQuery($userId, $contactId);
        if (null !== $key) {
            $query->andWhere([$history ? '<' : '>', 'id', $key]);
        }
        return new DataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $limit
            ]
        ]);
    }

    /**
     * @param int $userId
     * @param int $contactId
     * @return MessageQuery
     */
    protected static function baseQuery($userId, $contactId)
    {
        return static::find()
            ->between($userId, $contactId)
            ->with('sender')
            ->orderBy(['id' => SORT_DESC]);
    }


    /**
     * @param int $userId
     * @param int $contactId
     * @param string $text
     * @return array|bool returns true on success or errors if validation fails
     */
    public static function create($userId, $contactId, $text)
    {
        $instance = new static(['scenario' => 'create']);
        $instance->created_at = new Expression('UTC_TIMESTAMP()');
        $instance->sender_id = $userId;
        $instance->receiver_id = $contactId;
        $instance->text = Html::encode($text);
        $instance->save();
        return $instance->errors;
    }

    /**
     * @return MessageQuery
     * @throws \yii\base\InvalidConfigException
     */
    public static function find()
    {
        return Yii::createObject(MessageQuery::className(), [get_called_class()]);
    }

}
