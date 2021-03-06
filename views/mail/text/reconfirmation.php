<?php

/*
 * This file is part of the Coreb2c project.
 *
 * (c) Coreb2c project <http://github.com/coreb2c>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

/**
 * @var coreb2c\auth\models\Token $token
 */
?>
<?= Yii::t('auth', 'Hello') ?>,

<?= Yii::t('auth', 'We have received a request to change the email address for your account on {0}', Yii::$app->name) ?>.
<?= Yii::t('auth', 'In order to complete your request, please click the link below') ?>.

<?= $token->url ?>

<?= Yii::t('auth', 'If you cannot click the link, please try pasting the text into your browser') ?>.

<?= Yii::t('auth', 'If you did not make this request you can ignore this email') ?>.
