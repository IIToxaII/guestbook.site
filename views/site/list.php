<?php

/* @var $this yii\web\View */
/* @var $provider \yii\data\ActiveDataProvider */

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'List';
$this->params['breadcrumbs'][] = $this->title;
?>
<div>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $provider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' =>'message_id',
                'enableSorting' => false,
            ],
            'name',
            'email',
            [
                'attribute' =>'homepage',
                'enableSorting' => false,
            ],
            [
                'attribute' =>'text',
                'enableSorting' => false,
            ],
            [
                'attribute' =>'ipString',
                'enableSorting' => false,
            ],
            [
                'attribute' =>'browser',
                'enableSorting' => false,
            ],
            'creation_date',
        ],
    ]); ?>
</div>
