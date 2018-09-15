<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\LayananModel */

$this->title = 'Create Layanan Model';
$this->params['breadcrumbs'][] = ['label' => 'Layanan Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="layanan-model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
