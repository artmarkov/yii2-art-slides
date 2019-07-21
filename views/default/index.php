<?php

use yii\helpers\Url;
use yii\widgets\Pjax;
use artsoft\grid\SortableGridView;
use artsoft\grid\GridQuickLinks;
use artsoft\slides\models\Slides;
use artsoft\helpers\Html;
use artsoft\grid\GridPageSize;

/* @var $this yii\web\View */
/* @var $searchModel artsoft\slides\models\search\SlidesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $this->title = Yii::t('art/slides', 'Slides');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slides-index">

    <div class="row">
        <div class="col-sm-12">
            <h3 class="page-title"><?=  Html::encode($this->title) ?></h3>
            <?= Html::a(Yii::t('art', 'Add New'), ['/slides/default/create'], ['class' => 'btn btn-sm btn-success']) ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">

            <div class="row">
                <div class="col-sm-6">
                    <?php 
                    /* Uncomment this to activate GridQuickLinks */
                     echo GridQuickLinks::widget([
                        'model' => Slides::className(),
                        'searchModel' => $searchModel,
                    ])
                    ?>
                </div>

                <div class="col-sm-6 text-right">
                    <?=  GridPageSize::widget(['pjaxId' => 'slides-grid-pjax']) ?>
                </div>
            </div>

            <?php 
            Pjax::begin([
                'id' => 'slides-grid-pjax',
            ])
            ?>

            <?= SortableGridView::widget([
                'id' => 'slides-grid',
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'sortableAction' => ['grid-sort'],
                'bulkActionOptions' => [
                    'gridId' => 'slides-grid',
                   // 'actions' => [ Url::to(['bulk-delete']) => 'Delete'] //Configure here you bulk actions
                ],
                'columns' => [
                    ['class' => 'artsoft\grid\CheckboxColumn', 'options' => ['style' => 'width:10px']],
                    [
                        'class' => 'artsoft\grid\columns\TitleActionColumn',
                        'options' => ['style' => 'width:200px'],
                        'attribute' => 'name',                       
                        'controller' => '/slides/default',
                        'title' => function(Slides $model) {
                            return Html::encode($model->name);
                        },                        
                        'buttons' => [
                            'url' => Url::to(['/slides/default/copy', 'id' => $model->id]),
                            'copy' => function ($url, $model, $key) {
                                return Html::a(Yii::t('art/slides', 'Copy'), $url, 
                                    [
                                        'title' => Yii::t('art/slides', 'Copy'),
                                        'data-pjax' => 0,
                                        'data-confirm' => Yii::t('art/slides', 'The item will be copied. Are you sure?'),
                                    ]
                                );
                            },
                            
                        ],
                        'buttonsTemplate' => '{update} {copy} {delete}',
                        'options' => ['style' => 'width:300px']
                    ],
                    [
                        'class' => 'artsoft\grid\columns\StatusColumn',
                        'attribute' => 'status',
                        'optionsArray' => [
                            [Slides::STATUS_ACTIVE, Yii::t('art', 'Active'), 'primary'],
                            [Slides::STATUS_INACTIVE, Yii::t('art', 'Inactive'), 'info'],
                        ],
                        'options' => ['style' => 'width:100px']
                    ],           
                    [
                    'attribute' => 'img_src',
                    'options' => ['style' => 'width:100px'],
                    'value' => function(Slides $model) {
                            !empty($model->img_src) ? $img = $model->img_src : $img = '/images/noimg.png';
                            return Html::img($img, ['class'=> 'dw-media-image']);
                    },
                        'format' => 'html',
                    ],
                    [
                    'attribute' => 'data_lazyload',
                    'options' => ['style' => 'width:100px'],
                    'value' => function(Slides $model) {
                            !empty($model->data_lazyload) ? $img = $model->data_lazyload : $img = '/images/noimg.png';
                            return Html::img($img, ['class'=> 'dw-media-image']);
                    },
                        'format' => 'html',
                    ],
                ],
            ]);
            ?>

            <?php Pjax::end() ?>
        </div>
    </div>
</div>


