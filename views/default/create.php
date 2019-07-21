<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model artsoft\slides\models\Slides */

$this->title = Yii::t('yii', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('art/slides', 'Slides'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('yii', 'Update');
?>

<div class="slides-create">
    <div class="row">
        <div class="col-sm-12">
            <h3 class="page-title"><?=  Html::encode($this->title) ?></h3>            
        </div>
    </div>
    <?=  $this->render('_form', compact('model')) ?>
</div>