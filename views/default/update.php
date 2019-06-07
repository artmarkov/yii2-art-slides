<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model artsoft\slides\models\Slides */

$this->title = Yii::t('yii', 'Update') . ': ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('art/slides', 'Slides'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('yii', 'Update');
?>
<div class="slides-update">
    <h3 class="lte-hide-title"><?= Html::encode($this->title) ?></h3>
    <?= $this->render('_form', compact('model')) ?>
</div>