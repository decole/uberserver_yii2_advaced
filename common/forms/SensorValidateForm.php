<?php

namespace common\forms;

use api\components\Error;
use backend\models\User;
use backend\services\AdminService;
use common\components\exceptions\passwordRecovery\RecoveryPasswordException;
use common\components\validators\PhoneFilter;
use common\exceptions\NotUniqueCredentialException;
use common\helpers\PhoneHelper;
use common\models\auth\CompanyAuthSettings;
use common\models\CompanyCredentialsSettingsModel;
use common\services\auth\CompanyAuthSettingsService;
use common\services\PasswordRecoveryAdminService;
use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\validators\Validator;

class SensorValidateForm extends Model
{
    /**
     * @var
     */
    public $topic;

    /**
     * @var
     */
    public $payload;

    public function __construct($topic, $payload, array $config = [])
    {
        parent::__construct($config);
        $this->topic = $topic;
        $this->payload = $payload;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'topic' =>'Topic',
            'payload' => 'Payload',
        ];
    }
    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['topic', 'payload'], 'trim'],
            [['topic', 'payload'], 'required'],
            ['payload', 'payloadValidator'],
        ];
    }

    public function payloadValidator(): void
    {

    }
}