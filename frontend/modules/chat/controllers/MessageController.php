<?php

namespace frontend\modules\chat\controllers;

//...
use bubasuma\simplechat\controllers\DefaultController;
use frontend\modules\chat\models\Conversation;
use frontend\modules\chat\models\DataProvider;
use frontend\modules\chat\models\Message;
use frontend\widgets\Chat;
use yii\filters\ContentNegotiator;
use yii\web\Controller;
use bubasuma\simplechat\controllers\ControllerTrait;
use yii\web\ForbiddenHttpException;
use yii\web\IdentityInterface;
use yii\web\NotFoundHttpException;
use yii\web\Response;

//...

class MessageController extends Controller
{

    public function behaviors()
    {
        return [
            [
                'class' => ContentNegotiator::className(),
                'only' => [
                    'messages',
                    'create-message',
                    'conversations',
                    'delete-conversation',
                    'mark-conversation-as-read',
                    'mark-conversation-as-unread',
                    'render-view',
                ],
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
        ];
    }

    public function actionPage($contactId = null)
    {

        $user = $this->user;

        $conversationDataProvider = Conversation::get($user->id, 8);

        if (isset($contactId)) {
            $current = new Conversation(['user_id' => $user->id, 'contact_id' => $contactId]);
            if ($current)
                $current->toArray();
        }

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

        $messageDataProvider = Message::get($user->id, $contact['id'], 10);

//        $users = $this->getUsers([$user->id, $contact['id']]);

//        DataProvider::transformToArray($messageDataProvider);
        DataProvider::transformToArray($conversationDataProvider);

        return $this->render('page', compact('conversationDataProvider', 'current', 'contact',
            'user', 'messageDataProvider'));
    }

    public function actionGetChat()
    {
        $chat = Chat::widget();
        return $chat;
//        return $this->renderAjax('list');
    }


    public function actionMessages($contactId)
    {
        $user = $this->user;
        $request = \Yii::$app->request;
        $limit = $request->get('limit', $request->post('limit'));
        $key = $request->get('key', $request->post('key'));
        $type = $request->get('type', $request->post('type'));
        $history = strcmp('new', $type);
        $dp = Message::get($user->getId(), $contactId, $limit, $history, $key);
        $messagesArr = $dp->toArray();

        if ($type == 'fullReload' || $history) {
            $messages = array_reverse($messagesArr['models']);
            return $this->renderAjax('_messages', [
                'messages' => $messages,
                'user' => $user,
                'totalCount' => $messagesArr['totalCount']
            ]);
        }

        return $messagesArr;
    }

    public function actionConversations()
    {
        $userId = $this->user->getId();
        $request = \Yii::$app->request;
        $limit = $request->get('limit', $request->post('limit'));
        $key = $request->get('key', $request->post('key'));
        $history = strcmp('new', $request->get('type', $request->post('type')));
        $dp = Conversation::get($userId, $limit, $history, $key);
        DataProvider::transformToArray($dp);

        return $dp;
    }

    public function actionCreateMessage($contactId)
    {
        $userId = $this->user->getId();
        if ($userId == $contactId) {
            throw new ForbiddenHttpException('You cannot send a message in this conversation');
        }
        $text = \Yii::$app->request->post('text');
        return Message::create($userId, $contactId, $text);
    }

    public function actionMarkConversationAsRead($contactId)
    {
        $userId = $this->user->getId();
        return \frontend\modules\chat\models\db\Conversation::read($userId, $contactId);
    }

    /**
     * @return IdentityInterface
     */
    public function getUser()
    {
        return \Yii::$app->user->identity;
    }

    /**
     * @inheritdoc
     */
//    public function afterAction($action, $result)
//    {
//
//        $result = parent::afterAction($action, $result);
//        if ($result instanceof DataProvider) {
//            $query = $result->query;
//            $array = $result->toArray();
//            $array['models'] = $query->all();
//            return $array;
//        }
//        return $result;
//    }

    public function actionRenderView()
    {

        $id = \Yii::$app->request->post('id');
        $data = \Yii::$app->request->post('data');
        $href = \Yii::$app->request->post('href');

        $render = [];
        if ($id == 'conversation')
            $render = ['dialog' => $data['model'], 'isCurrent' => ($data['isCurrent']) === 'true'];
        elseif ($id == 'message')
            $render = ['message' => $data['model'], 'user' => $data['user']];

        return $this->renderAjax($href, $render);

    }

}