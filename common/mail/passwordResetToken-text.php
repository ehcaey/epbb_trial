<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
Halo <?= $user->username ?>,

Ikuti link di bawah ini untuk melakukan reset password Anda:

<?= $resetLink ?>
