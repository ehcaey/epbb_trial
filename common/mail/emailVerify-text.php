<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['site/verify-email', 'token' => $user->verification_token]);
?>
Halo <?= $user->username ?>,

Ikuti link di bawah ini untuk memverifikasi e-mail Anda:

<?= $verifyLink ?>
