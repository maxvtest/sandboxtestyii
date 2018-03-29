<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

use common\models\Api;
use common\models\Attribute;

use frontend\models\api\ApiForm;
use frontend\models\api\AttributeForm;

/**
 * Site controller
 */
class ApiController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    
    public function actionList()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Api::find()->with('apiAttributes.attribute0'),
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ],
            ],
        ]);
        
        return $this->render('list', [
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionCreate()
    {
        $model = new ApiForm;
        
        if ($model->load(Yii::$app->request->post()) && $model->saveApiForm()) {
            $this->redirect('list');
        }
        
        return $this->render('api-create', [
            'model' => $model,
            'attributes' => Attribute::find()->all(),
        ]);
    }
    
    public function actionUpdate($id)
    {
        $model = ApiForm::findOne(['id' => $id]);
        
        if (!$model) {
            throw NotFoundHttpException;
        }
        
        $model->attributeIds = ArrayHelper::getColumn($model->apiAttributes, 'attribute_id');
        
        if ($model->load(Yii::$app->request->post()) && $model->saveApiForm()) {
            $this->redirect('list');
        }
        
        return $this->render('api-create', [
            'model' => $model,
            'attributes' => Attribute::find()->all(),
        ]);
    }
    
    public function actionListAttribute()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Attribute::find(),
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ],
            ],
        ]);
        
        return $this->render('list-attribute', [
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionCreateAttribute()
    {
        $model = new AttributeForm();
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->redirect('/');
        }
        
        return $this->render('create-attribute', [
            'model' => $model,
        ]);
    }
    
    public function actionUpdateAttribute($id)
    {
        $model = AttributeForm::findOne(['id' => $id]);
        
        if (!$model) {
            throw NotFoundHttpException;
        }
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->redirect('/');
        }
        
        return $this->render('create-attribute', [
            'model' => $model,
        ]);
    }
}
