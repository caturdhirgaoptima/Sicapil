<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\LayananSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Layanan Models';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="layanan-model-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Layanan Model', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nama_layanan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
