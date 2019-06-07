<?php

namespace artsoft\slides\controllers;

use Yii;
use backend\controllers\DefaultController;
use artsoft\slides\models\SlidesLayers;

/**
 * SlidesLayersController implements the CRUD actions for artsoft\slides\models\SlidesLayers model.
 */
class SlidesLayersController extends DefaultController 
{
    public $modelClass       = 'artsoft\slides\models\SlidesLayers';
    public $modelSearchClass = '';

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
     * Вызывается методом Ajax из itemLayers.php
     */
    public function actionInitLayers()
    {
        $id = Yii::$app->request->get('id');
       
        $model = new $this->modelClass;
        
        //echo '<pre>' . print_r($model, true) . '</pre>';

        if (!Yii::$app->request->isAjax) {
            return $this->redirect(Yii::$app->request->referrer);
        }
        $model->slides_id = $id;       

        $this->layout = false;
        return $this->renderIsAjax('slides-layers-modal',  ['model' => $model]);
    }

    /**
     * @return array|\yii\web\Response
     * @throws HttpException
     */
    public function actionCreateLayers() {

        $model = new $this->modelClass();

        if ($model->load(Yii::$app->request->post())) {

            // echo '<pre>' . print_r($model, true) . '</pre>';

            if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {
                \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

                return \yii\widgets\ActiveForm::validate($model);
            } elseif ($model->load(Yii::$app->request->post())) {
                
                if ($model->save()) {
                    Yii::$app->session->setFlash('crudMessage', Yii::t('art', 'Your item has been created.'));
                    return $this->redirect(Yii::$app->request->referrer);
                }
            }
        } else {
            throw new HttpException(404, 'Page not found');
        }
    }

    /**
     * @return array|bool|string|\yii\web\Response
     */
    public function actionUpdateLayers() {

        $id = Yii::$app->request->get('id');
        $modelClass = $this->modelClass;
        $model = $modelClass::findOne($id);
        if(empty($model)) return false;

            //echo '<pre>' . print_r($model, true) . '</pre>';

        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            return \yii\widgets\ActiveForm::validate($model);
        } elseif ($model->load(Yii::$app->request->post())) {
            
            if ($model->save()) {
                Yii::$app->session->setFlash('crudMessage', Yii::t('art', 'Your item has been updated.'));
                return $this->redirect(Yii::$app->request->referrer);
            }

        } else {
            $this->layout = false;
            return $this->renderIsAjax('slides-layers-modal',  ['model' => $model]);
        }
    }

    /**
     * @return bool|\yii\web\Response
     *
     */
    public function actionRemove() {
        $id = Yii::$app->request->get('id');        
        $modelClass = $this->modelClass;
        $model = $modelClass::findOne($id);
        if (empty($model)) return false;
        $model->delete();
        Yii::$app->session->setFlash('crudMessage', Yii::t('art', 'Your item has been deleted.'));
        return $this->redirect(Yii::$app->request->referrer); 
    }
}