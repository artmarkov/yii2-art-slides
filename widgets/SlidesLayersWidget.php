<?php
namespace artsoft\slides\widgets;

use yii\base\Widget;

/**
 * Description of ItemProgrammWidget
 *
 * @author artmarkov
 */
class SlidesLayersWidget extends Widget {
    
    public $model;
    public $dataProvider;

    public function run() {
  
        $this->dataProvider = new \yii\data\ActiveDataProvider([
            'query' => \artsoft\slides\models\SlidesLayers::find()
                ->andWhere(['in', 'slides_id' , $this->model->id]),
            'sort' => false,
        ]);
        $this->dataProvider->pagination = false;
        
        return $this->render('slidesLayers', [
                    'model' => $this->model,
                    'dataProvider' => $this->dataProvider,
                    
        ]);
    }

}
