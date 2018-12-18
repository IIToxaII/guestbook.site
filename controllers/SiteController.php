<?php

namespace app\controllers;

use app\models\Message;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionMessage()
    {
        $model = new Message();
        if ($model->load(Yii::$app->request->post())) {
            $model->ipString = $_SERVER['REMOTE_ADDR'];
            $model->browser = $_SERVER['HTTP_USER_AGENT'];
            $model->creation_date = date('Y-m-d H:i:s');
            if ($model->save()) {
                Yii::$app->session->setFlash('messageSubmitted');

                return $this->refresh();
            }
        }
        return $this->render('message', [
            'model' => $model,
        ]);
    }

    /**
     * @return string
     */
    public function actionList()
    {
        $query = Message::find();

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 25,
            ],
            'sort' => [
                'defaultOrder' => [
                    'creation_date' => SORT_DESC,
                ]
            ],
        ]);

        return $this->render('list', ['provider' => $provider]);
    }
}
