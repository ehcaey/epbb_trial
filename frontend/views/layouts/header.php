<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">PBB</span><span class="logo-lg">E-PBB Kota Kendari</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-user-circle fa-fw"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="logout">
                            <?= Html::a(
                                'Sign out',
                                ['/site/logout'],
                                ['data-method' => 'post']
                            ) ?>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
