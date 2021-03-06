<?php

/*
 * This file is part of the Coreb2c project.
 *
 * (c) Coreb2c project <http://github.com/coreb2c/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace coreb2c\auth\models;

use coreb2c\auth\traits\ModuleTrait;
use Yii;
use yii\base\Model;

/**
 * Registration form collects user input on registration process, validates it and creates new User model.
 *
 * @author Abdullah Tulek <abdullah.tulek@coreb2c.com>
 */
class RegistrationForm extends Model {

    use ModuleTrait;

    const SCENARIO_USERNAME_REQUIRED = 'usernameRequired';
    const SCENARIO_USERNAME_NOT_REQUIRED = 'usernameNotRequired';

    /**
     * @var string User email address
     */
    public $email;

    /**
     * @var string Username
     */
    public $username;

    /**
     * @var string Password
     */
    public $password;

    /**
     * @inheritdoc
     */
    public function scenarios() {
        return [
            self::SCENARIO_USERNAME_REQUIRED => ['email', 'username', 'password'],
            self::SCENARIO_USERNAME_NOT_REQUIRED => ['email', 'password'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        $user = $this->module->modelMap['User'];

        return [
            // email rules
            'emailRequired' => ['email', 'required'],
            'emailTrim' => ['email', 'filter', 'filter' => 'trim'],
            'emailPattern' => ['email', 'email'],
            'emailUnique' => [
                'email',
                'unique',
                'targetClass' => $user,
                'message' => Yii::t('auth', 'This email address has already been taken')
            ],
            // username rules
            'usernameRequired' => ['username', 'required'],
            'usernameLength' => ['username', 'string', 'min' => 3, 'max' => 255],
            'usernameTrim' => ['username', 'filter', 'filter' => 'trim'],
            'usernamePattern' => ['username', 'match', 'pattern' => $user::$usernameRegexp],
            'usernameUnique' => [
                'username',
                'unique',
                'targetClass' => $user,
                'message' => Yii::t('auth', 'This username has already been taken')
            ],
            // password rules
            'passwordRequired' => ['password', 'required', 'skipOnEmpty' => $this->module->enableGeneratingPassword],
            'passwordLength' => ['password', 'string', 'min' => 6, 'max' => 72],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'email' => Yii::t('auth', 'Email'),
            'username' => Yii::t('auth', 'Username'),
            'password' => Yii::t('auth', 'Password'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function formName() {
        return 'register-form';
    }

    /**
     * Registers a new user account. If registration was successful it will set flash message.
     *
     * @return bool
     */
    public function register() {
        if (!$this->validate()) {
            return false;
        }
        
        /** @var User $user */
        $user = Yii::createObject(User::className());
        $user->setScenario('register');
        if($this->scenario===self::SCENARIO_USERNAME_NOT_REQUIRED){
            $this->username = $user->generateUsername();
        }
        $this->loadAttributes($user);

        if (!$user->register()) {
            return false;
        }

        Yii::$app->session->setFlash(
                'info', Yii::t(
                        'auth', 'Your account has been created and a message with further instructions has been sent to your email'
                )
        );

        return true;
    }

    /**
     * Loads attributes to the user model. You should override this method if you are going to add new fields to the
     * registration form. You can read more in special guide.
     *
     * By default this method set all attributes of this model to the attributes of User model, so you should properly
     * configure safe attributes of your User model.
     *
     * @param User $user
     */
    protected function loadAttributes(User $user) {
        $user->setAttributes($this->attributes);
    }
}
