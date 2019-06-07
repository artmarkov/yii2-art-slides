<?php

use artsoft\widgets\ActiveForm;
use artsoft\helpers\Html;
use artsoft\grid\GridView;
use yii\widgets\Pjax;

?>
<?php $form = ActiveForm::begin(); ?>

<div class="works-author-widget">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    
                    <div class="row">
                        <div class="col-md-12">
                      <?php Pjax::begin(); ?>
   

    <?= GridView::widget([
        'id' => 'slidesLayers',
        'dataProvider' => $dataProvider,     
        //'filterModel' => $searchModel,
        'layout' => '{items}',
        'tableOptions' => ['class' => 'table table-hover table-striped'],
        'showFooter' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
           'content',
           'data_x',
           'data_y',
           'data_speed',
           'data_start',          
            [
            'options' => ['style' => 'width:20px'],
            'format' => 'raw',
            'value' => function ($model) {
                return Html::a('<span class="glyphicon glyphicon-pencil text-color-default" aria-hidden="true"></span>', ['/slides/slides-layers/update-layers'], [
                            'title' => Yii::t('yii', 'Update'),
                            'class' => 'btn btn-xs btn-primary update-layers',
                            'data-id' => $model->id,
                ]);
            },
            ],
            [
            'options' => ['style' => 'width:20px'],
            'format' => 'raw',
            'value' => function ($model) {
                return Html::a('<span class="glyphicon glyphicon-remove text-color-default" aria-hidden="true"></span>', ['/slides/slides-layers/remove'], [
                            'title' => Yii::t('yii', 'Delete'),
//                          'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                            'class' => 'btn btn-xs btn-default remove-layers',
                            'data-id' => $model->id,
                ]);
            },
        ],
    ],
    ]); ?>
    <?php Pjax::end(); ?>       
                           
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">

                             <?= Html::a(Yii::t('art/slides', 'Add Layers'), ['/slides/slides-layers/init-layers'], [
                                                'class' => 'btn btn-sm btn-primary add-to-slides-layers',
                                                'data-id' => $model->id,
                                        ]);
                            ?>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>

<?php
$js = <<<JS

function showLayers(author) {
    $('#slides-layers-modal .modal-body').html(author);
    $('#slides-layers-modal').modal();
}

$('.add-to-slides-layers').on('click', function (e) {

    e.preventDefault();
    
    var id = $(this).data('id')
       

    $.ajax({
        url: '/admin/slides/slides-layers/init-layers',
        data: {id: id},
        type: 'GET',
        success: function (res) {
            if (!res)  alert('Error...');
           // console.log(res);
           else showLayers(res);
        },
        error: function () {
            alert('Script Error!');
        }
    });
});

$('.update-layers').on('click', function (e) {

    e.preventDefault();

    var id = $(this).data('id');

    $.ajax({
        url: '/admin/slides/slides-layers/update-layers',
        data: {id: id},
        type: 'GET',
        success: function (res) {
            if (!res)  alert('Error!');
           // console.log(res);
           else showLayers(res);
        },
        error: function () {
            alert('Error!');
        }
    });
});

$('.remove-layers').on('click', function (e) {

    e.preventDefault();
    
    var id = $(this).data('id');

    $.ajax({
        url: '/admin/slides/slides-layers/remove',
        data: {id: id},
        type: 'GET'
    });
});

JS;

$this->registerJs($js);
?>

<?php
$css = <<<CSS
        
    #slidesLayers.grid-view tbody tr td {
        height: auto !important; 
    }
        
CSS;

$this->registerCss($css);
?>