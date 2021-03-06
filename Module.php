<?php

/*
 * This file is part of the Coreb2c project.
 *
 * (c) Coreb2c project <http://github.com/coreb2c/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace coreb2c\auth;

use yii\base\Module as BaseModule;

/**
 * This is the main module class for the yii2-auth.
 *
 * @property array $modelMap
 *
 * @author Abdullah Tulek <abdullah.tulek@coreb2c.com>
 */
class Module extends BaseModule {

    const VERSION = '1.0';

    /** Email is changed right after user enter's new email address. */
    const STRATEGY_INSECURE = 0;

    /** Email is changed after user clicks confirmation link sent to his new email address. */
    const STRATEGY_DEFAULT = 1;

    /** Email is changed after user clicks both confirmation links sent to his old and new email addresses. */
    const STRATEGY_SECURE = 2;

    /**
     * @var string
     */
    public $defaultRoute = 'admin/index';

    /** @var bool Whether to show flash messages. */
    public $enableFlashMessages = false;

    /** @var bool Whether to enable registration. */
    public $enableRegistration = true;

    /** @var bool Whether to remove password field from registration form. */
    public $enableGeneratingPassword = false;

    /** @var bool Whether user has to confirm his account. */
    public $enableConfirmation = true;

    /** @var bool Whether to allow logging in without confirmation. */
    public $enableUnconfirmedLogin = false;

    /** @var bool Whether to enable password recovery. */
    public $enablePasswordRecovery = true;

    /** @var bool Whether user can remove his account */
    public $enableAccountDelete = false;

    /** @var bool Enable the 'impersonate as another user' function */
    public $enableImpersonateUser = true;
    
    /** @var bool Enable login with email or username. This will be checked first */
    public $enableLoginWithUsernameOrEmail = true;
    
    /** @var bool Enable login with email. This will be checked secondly */
    public $enableLoginWithEmail = true;
    
    /** @var bool Enable login with username. This will be checked thirdly */
    public $enableLoginWithUsername = true;

    /** @var bool Whether role base access control (rbac) enabled. */
    public $enableRbac = true;
    
    /** @var int Email changing strategy. */
    public $emailChangeStrategy = self::STRATEGY_SECURE;
    
    /** @var int User category to sign in. Default is null for not to check user category. Can be set differently for each application layer. */
    public $userCategory = null;
    
    /** @var array User categories to sign in. Indexes are used to validate user category value for each application layer */
    public $userCategories = [];
    
    /** @var int The time you want the user will be remembered without asking for credentials. */
    public $rememberFor = 1209600; // two weeks

    /** @var int The time before a confirmation token becomes invalid. */
    public $confirmWithin = 86400; // 24 hours

    /** @var int The time before a recovery token becomes invalid. */
    public $recoverWithin = 21600; // 6 hours

    /** @var int Cost parameter used by the Blowfish hash algorithm. */
    public $cost = 10;

    /** @var array An array of administrator's usernames. */
    public $admins = [];

    /** @var string The Administrator permission name. */
    public $adminPermission = 'admin';

    /** @var array Mailer configuration */
    public $mailer = [];

    /** @var array Model map */
    public $modelMap = [];

    /**
     * @var string The prefix for user module URL.
     *
     * @See [[GroupUrlRule::prefix]]
     */
    public $urlPrefix = 'auth';

    /**
     * @var bool Is the user module in DEBUG mode? Will be set to false automatically
     * if the application leaves DEBUG mode.
     */
    public $debug = false;

    /** @var array The rules to be used in URL management. */
    public $urlRules = [
        '<id:\d+>' => 'profile/show',
        '<action:(auth)>' => 'security/<action>',
        '<action:(register|resend)>' => 'registration/<action>',
        'confirm/<id:\d+>/<code:[A-Za-z0-9_-]+>' => 'registration/confirm',
        'forgot' => 'recovery/request',
        'recover/<id:\d+>/<code:[A-Za-z0-9_-]+>' => 'recovery/reset',
        'settings/<action:\w+>' => 'settings/<action>',
        'register' => 'registration/register',
        'admin/<action:(update|delete|resend-password|switch|block)>/<id:\d+>' => 'admin/<action>',
        'rbac/<controller:(role|permission|rule)>/<action:(update|delete)>/<name:\w+>' => 'rbac/<controller>/<action>',
    ];

}
