<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */

dmstr\web\AdminLteAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <!-- <title><?= Html::encode($this->title) ?></title> -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@600&family=Poppins&family=Quicksand:wght@500&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="<?= Url::to('@web/images/logo.png'); ?>" />
    <title>E-PBB | Kota Kendari</title>
    <?php
        $this->registerCssFile(Url::to('@web/css/style.css')); 
        $this->registerCssFile(Url::to('@web/css/site.css'));
        $this->head() 
    ?>
</head>
<body class="login-page">
    
<?php $this->beginBody() ?>

    <?= $content ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
