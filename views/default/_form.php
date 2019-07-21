<?php

use artsoft\widgets\ActiveForm;
use artsoft\slides\models\Slides;
use artsoft\helpers\Html;

/* @var $this yii\web\View */
/* @var $model artsoft\slides\models\Slides */
/* @var $form artsoft\widgets\ActiveForm */
?>

<div class="slides-form">

    <?php
    $form = ActiveForm::begin([
                'id' => 'slides-form',
                'validateOnBlur' => false,
            ])
    ?>

    <div class="row">
        <div class="col-md-8">

            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>   
                            
                            <?= $form->field($model->loadDefaultValues(), 'status')->dropDownList(Slides::getStatusList()) ?>                          
                        </div>                        
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php if (!$model->isNewRecord) : ?>
                        <?= artsoft\slides\widgets\SlidesLayersWidget::widget(['model' => $model]); ?>
                    <?php endif; ?>
                </div>

            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="record-info">                   
                        <div class="row">
                            <div class="col-md-4">
                                <?= $form->field($model, 'data_transition')->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-md-4">
                                <?= $form->field($model, 'data_slotamount')->textInput() ?>
                            </div>
                             <div class="col-md-4">
                                <?= $form->field($model, 'data_masterspeed')->textInput() ?>
                            </div>
                        </div>  
                       
                        <div class="row">
                            <div class="col-md-4">
                                <?= $form->field($model, 'data_fullwidthcentering')->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-md-4">
                                <?= $form->field($model, 'data_bgfit')->textInput(['maxlength' => true]) ?>
                            </div>
                             <div class="col-md-4">
                                 <?= $form->field($model, 'data_delay')->textInput() ?> 
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($model, 'data_bgposition')->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'data_bgrepeat')->textInput(['maxlength' => true]) ?>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">    
                    <div class="record-info">
                            <div class="form-group clearfix">
                                <label class="control-label" style="float: left; padding-right: 5px;"><?= $model->attributeLabels()['id'] ?>: </label>
                                <span><?= $model->id ?></span>
                            </div>
                        <?php if (!$model->isNewRecord): ?>

                            <div class="form-group clearfix">
                                <label class="control-label" style="float: left; padding-right: 5px;">
                                    <?= $model->attributeLabels()['created_at'] ?> :
                                </label>
                                <span><?= $model->createdDatetime ?></span>                                
                            </div>

                            <div class="form-group clearfix">
                                <label class="control-label" style="float: left; padding-right: 5px;">
                                    <?= $model->attributeLabels()['updated_at'] ?> :
                                </label>
                                <span><?= $model->updatedDatetime ?></span>
                            </div>

                            <div class="form-group clearfix">
                                <label class="control-label" style="float: left; padding-right: 5px;">
                                    <?= $model->attributeLabels()['updated_by'] ?> :
                                </label>
                                <span><?= $model->updatedBy->username ?></span>
                            </div>
                        <?php endif; ?>


                        <div class="form-group">
                            <?php if ($model->isNewRecord): ?>
                                <?= Html::submitButton(Yii::t('art', 'Create'), ['class' => 'btn btn-primary']) ?>
                                <?= Html::a(Yii::t('art', 'Cancel'), ['/slides/default/index'], ['class' => 'btn btn-default']) ?>
                            <?php else: ?>
                                <?= Html::submitButton(Yii::t('art', 'Save'), ['class' => 'btn btn-primary']) ?>
                                <?=
                                Html::a(Yii::t('art', 'Delete'), ['/slides/default/delete', 'id' => $model->id], [
                                    'class' => 'btn btn-danger',
                                    'data' => [
                                        'confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                        'method' => 'post',
                                    ],
                                ])
                                ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="record-info">
                        
                        <?= $form->field($model, 'img_src')->widget(\artsoft\media\widgets\FileInput::className(), [
                            'name' => 'image',
                            'buttonTag' => 'button',
                            'buttonName' => Yii::t('art', 'Browse'),
                            'buttonOptions' => ['class' => 'btn btn-primary btn-file-input'],
                            'options' => ['class' => 'form-control'],
                            'template' => '<div class="slides-img_src thumbnail"></div><div class="input-group"><span class="input-group-btn">{button}</span>{input}</div>',
                            'thumb' => 'original',
                            'imageContainer' => '.slides-img_src',
                            'pasteData' => \artsoft\media\widgets\FileInput::DATA_URL,
                            'callbackBeforeInsert' => 'function(e, data) {
                                $(".img_src-thumbnail").show();
                            }',
                        ])
                        ?>
                        <?= $form->field($model, 'data_lazyload')->widget(\artsoft\media\widgets\FileInput::className(), [
                            'name' => 'image',
                            'buttonTag' => 'button',
                            'buttonName' => Yii::t('art', 'Browse'),
                            'buttonOptions' => ['class' => 'btn btn-primary btn-file-input'],
                            'options' => ['class' => 'form-control'],
                            'template' => '<div class="slides-data_lazyload thumbnail"></div><div class="input-group"><span class="input-group-btn">{button}</span>{input}</div>',
                            'thumb' => 'original',
                            'imageContainer' => '.slides-data_lazyload',
                            'pasteData' => \artsoft\media\widgets\FileInput::DATA_URL,
                            'callbackBeforeInsert' => 'function(e, data) {
                                $(".data_lazyload-thumbnail").show();
                            }',
                        ])
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<!--        модал добавления слоя в слайд-->
<?php
\yii\bootstrap\Modal::begin([
    'header' => '<h3 class="page-title">' . Yii::t('art/slides', 'Add Layers') . '</h3>',
    'size' => 'modal-lg',
    'id' => 'slides-layers-modal',
        //'footer' => 'footer',
]);

\yii\bootstrap\Modal::end();
?>
<?php
$js = <<<JS
    var img_src = $("#slides-img_src").val();
    if(img_src.length == 0){
        $('.slides-img_src').hide();
    } else {
        $('.slides-img_src').html('<img src="' + img_src + '" />');
    }
        
    var data_lazyload = $("#slides-data_lazyload").val();
    if(data_lazyload.length == 0){
        $('.slides-data_lazyload').hide();
    } else {
        $('.slides-data_lazyload').html('<img src="' + data_lazyload + '" />');
    }
JS;

$this->registerJs($js, yii\web\View::POS_READY);
?>