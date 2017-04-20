<?php
/**
 * Created by PhpStorm.
 * User: kusok
 * Date: 19.04.2017
 * Time: 16:26
 */

namespace frontend\controllers;

//...
use bubasuma\simplechat\controllers\DefaultController;
use frontend\models\Conversation;
use frontend\models\Message;
use yii\web\Controller;
use bubasuma\simplechat\controllers\ControllerTrait;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

//...

class MessageController extends DefaultController
{
    use ControllerTrait;

    /**
     * @return string
     */
    public function getMessageClass()
    {
        return Message::className();
    }

    /**
     * @return string
     */
    public function getConversationClass()
    {
        return Conversation::className();
    }

    public function actionIndex($contactId = null)
    {
//        $user = \Yii::$app->user;
        $user = $this->user;
//        if (!$user->isGuest) {
            if ($contactId == $user->id) {
                throw new ForbiddenHttpException('You cannot open this conversation');
            }

            if (isset($contactId)) {
                $current = new Conversation(['user_id' => $user->id, 'contact_id' => $contactId]);
            }

            /** @var $conversationClass Conversation */
            $conversationClass = $this->conversationClass;
            $conversationDataProvider = $conversationClass::get($user->id, 8);

            $lol = $conversationDataProvider->getModels();

            if (!isset($current)) {
                if (0 == $conversationDataProvider->getTotalCount()) {
                    throw new NotFoundHttpException('You have no active conversations');
                }
                $current = current($conversationDataProvider->getModels());
            }

            $contact = $current['contact'];
            if (empty($contact)) {
                throw new NotFoundHttpException();
            }
            $this->view->title = $contact['name'];
            /** @var $messageClass Message */
            $messageClass = $this->messageClass;
            $messageDataProvider = $messageClass::get($user->id, $contact['id'], 10);
            $users = $this->getUsers([$user->id, $contact['id']]);
            return $this->render(
                'index',
                compact('conversationDataProvider', 'messageDataProvider', 'users', 'user', 'contact', 'current')
            );
//        }


    }

    public function actionGetChat()
    {
        return $this->renderAjax('list');
    }

}