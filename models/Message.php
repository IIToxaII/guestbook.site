<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * @property $message_id
 * @property $name
 * @property $email
 * @property $homepage
 * @property $text
 * @property $ipString
 * @property $browser
 * @property $creation_date
 *
 */
class Message extends ActiveRecord
{
    /**
     * @var string
     */
    public $verifyCode;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['name', 'email', 'text'], 'required'],
            ['name', 'match', 'pattern' => '/^[a-z]\w{2,49}$/i'],
            ['email', 'email'],
            ['homepage', 'url', 'defaultScheme' => 'true'],
            ['text', 'string', 'max' => 20000],
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }

    /**
     * @param $value
     */
    public function setIpString($value)
    {
        $this->ip = ip2long($value);
    }

    /**
     * @return string
     */
    public function getIpString()
    {
        return long2ip($this->ip);
    }

}