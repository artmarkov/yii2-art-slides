<?php

use artsoft\widgets\ActiveForm;
use artsoft\helpers\Html;
use kartik\switchinput\SwitchInput;
/* @var $model artsoft\slides\models\SlidesLayers */
/* @var $form artsoft\widgets\ActiveForm */

?>

<div class="slides-layers-form">
    <?php if ($model->isNewRecord) {
        $action = 'create-layers';
    } else {
        $action = 'update-layers';
    }
    ?>
    <?php $form = ActiveForm::begin([
    'id' => 'slides-layers-form',
        
    'enableAjaxValidation' => true,
    'action' => ['slides-layers/' . $action , 'id' => $model->id]
]);
    ?>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group clearfix">
                <label class="control-label" style="float: left; padding-right: 5px;">
                    <?= $model->attributeLabels()['id'] ?> :
                </label>
                <span><?= $model->id ?></span>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <?= $form->field($model, 'content')->textarea(['rows' => 3]) ?>                 
                                </div> 
                            </div> 
                        </div> 
                    </div> 
                </div> 
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12"> 
                                    <?= $form->field($model, 'class')->textInput(['maxlength' => true]) ?>
                                </div>
                            </div>
                            <div class="row">                               
                                <div class="col-md-6"> 
                                    <?= $form->field($model, 'data_x')->textInput() ?>
                                </div>
                                <div class="col-md-6">
                                    <?= $form->field($model, 'data_y')->textInput() ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <?= $form->field($model, 'data_hoffset')->textInput() ?>
                                </div>
                                <div class="col-md-6">
                                    <?= $form->field($model, 'data_voffset')->textInput() ?>
                                </div>
                            </div>    
                            <div class="row">
                                <div class="col-md-4">
                                    <?= $form->field($model, 'data_speed')->textInput() ?>
                                </div>
                                <div class="col-md-4">
                                    <?= $form->field($model, 'data_start')->textInput() ?>
                                </div>
                                <div class="col-md-4">
                                    <?= $form->field($model, 'data_easing')->textInput(['maxlength' => true]) ?>
                                </div>
                            </div> 
                        </div>
                    </div> 
                </div>
           
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <?= $form->field($model, 'data_customin')->textInput(['maxlength' => true]) ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <?= $form->field($model, 'data_customout')->textInput(['maxlength' => true]) ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <?= $form->field($model, 'data_splitin')->textInput() ?>
                                </div>
                                <div class="col-md-6">
                                    <?= $form->field($model, 'data_splitout')->textInput() ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <?= $form->field($model, 'data_elementdelay')->textInput() ?>
                                </div>
                                <div class="col-md-6">
                                    <?= $form->field($model, 'data_endelementdelay')->textInput() ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <?= $form->field($model, 'data_end')->textInput() ?>
                                </div>
                                <div class="col-md-6">
                                    <?= $form->field($model, 'data_endspeed')->textInput() ?>
                                </div>
                            </div>                            
                            <div class="row">
                                <div class="col-md-6">
                                    <?= $form->field($model, 'data_endeasing')->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class="col-md-6">
                                    <?= $form->field($model, 'data_captionhidden')->textInput(['maxlength' => true]) ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <?= $form->field($model, 'style')->textInput(['maxlength' => true]) ?>   
                                </div>
                            </div>   
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-2">  
                                    <?=
                                    $form->field($model, 'btn_flag')->widget(SwitchInput::classname(), [
                                        'pluginOptions' => [
                                            'size' => 'small',
                                        ],
                                    ]);
                                    ?>
                                </div>
                                <div class="col-md-10">    

                                    <?= $form->field($model, 'btn_url')->textInput(['maxlength' => true]) ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">  
                                    <?= $form->field($model, 'btn_icon')->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class="col-md-4">  
                                    <?= $form->field($model, 'btn_name')->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class="col-md-4">  
                                    <?= $form->field($model, 'btn_class')->textInput(['maxlength' => true]) ?>  

                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>

            <?= $form->field($model, 'slides_id')->label(false)->hiddenInput() ?>

            <?php if ($model->isNewRecord) {
                echo Html::submitButton(Yii::t('art/slides', 'Add Layers'), ['class' => 'btn btn-primary']);
            } else {
                echo Html::submitButton(Yii::t('art', 'Update'), ['class' => 'btn btn-primary']);
            }
            ?>

        </div>
    </div>

<?php ActiveForm::end(); ?>

</div>
