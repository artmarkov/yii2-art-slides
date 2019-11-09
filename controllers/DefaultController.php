<?php

namespace artsoft\slides\controllers;

use Yii;
use artsoft\controllers\admin\BaseController;
use artsoft\slides\models\SlidesLayers;
use yii\web\NotFoundHttpException;
use himiklab\sortablegrid\SortableGridAction;

/**
 * Controller implements the CRUD actions for Block model.
 */

class DefaultController extends BaseController
{
    public $modelClass       = 'artsoft\slides\models\Slides';
    public $modelSearchClass = 'artsoft\slides\models\search\SlidesSearch';

    protected function getRedirectPage($action, $model = null)
    {
        switch ($action) {
            case 'update':
                return ['update', 'id' => $model->id];
                break;
            case 'create':
                return ['update', 'id' => $model->id];
                break;
            default:
                return parent::getRedirectPage($action, $model);
        }
    }
    /**
     * Copied an existing model.
     * If copied is successful, the browser will be redirected to the 'update' page.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionCopy($id) {
        /* @var $model \artsoft\db\ActiveRecord */
        $model_old = $this->findModel($id);
        
        if (!$model_old) {
            throw new NotFoundHttpException(Yii::t('art', 'Item not found'));
        }
        
        $model = new $this->modelClass;
        $model->setAttributes($model_old->attributes);

        if ($model->save()) {
            $items = SlidesLayers::find()
                    ->andWhere(['slides_id' => $model_old->id])
                    ->all();
            foreach ($items as $item) {
                $model_layers = new SlidesLayers;
                $model_layers->setAttributes($item->attributes);
                $model_layers->slides_id = $model->id;
                $model_layers->save();
            }
            Yii::$app->session->setFlash('success', Yii::t('art/slides', 'Your item has been copied.'));
            return $this->redirect($this->getRedirectPage('update', $model));
        }

        throw new NotFoundHttpException(Yii::t('art', 'Item not found'));
    }

    /**
     * action sort for himiklab\sortablegrid\SortableGridBehavior
     * @return type
     */
    public function actions()
    {
        return [
            'grid-sort' => [
                'class' => SortableGridAction::className(),
                'modelName' => $this->modelClass,
            ],
        ];
    }
}