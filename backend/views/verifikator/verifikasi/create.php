<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\UrusanlayananUserModel */

$this->title = 'Create Urusanlayanan User Model';
$this->params['breadcrumbs'][] = ['label' => 'Urusanlayanan User Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="urusanlayanan-user-model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
