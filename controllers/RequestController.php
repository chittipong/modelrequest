<?php

namespace app\controllers;

use Yii;
use app\models\Request;
use app\models\RequestSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\User;           //For set Permission & Access Control
use yii\filters\AccessControl;  //For set Permission & Access Control
use app\component\AccessRule;   //For set Permission & Access Control

/**
 * RequestController implements the CRUD actions for Request model.
 */
class RequestController extends Controller
{
    /**
     * @inheritdoc
     */
     public function behaviors(){
        return [
             'access' => [
                 'class' => AccessControl::className(),
                 'ruleConfig'=>[
                   'class'=>AccessRule::className(),
                 ],
                 'only' => ['create', 'update', 'delete','index','view'],
                 'rules' => [
                     [
                         //กำหนด User ที่สามารถทำการ Create,Update,Delete ได้
                         'actions' => ['create','update','delete','index','view'],
                         'allow' => true,
                         'roles' => [
                             User::ROLE_MANAGER,
                             User::ROLE_ADMIN,
                             //User::ROLE_USER,
                         ],
                     ],
                     [
                         //กำหนดสิทธิ์ User ที่สามารถเข้าดูข้อมูลได้ในหน้า index,view ได้เท่านั้น
                         'actions' => ['view','update'],
                         'allow' => true,
                         'roles' => [
                             User::ROLE_USER,
                         ],
                     ],
                 ],
             ],
             'verbs' => [
                 'class' => VerbFilter::className(),
                 'actions' => [
                     'logout' => ['post'],
                 ],
             ],
         ];
     }//End***

    /**
     * Lists all Request models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RequestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Request model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Request model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Request();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->tableid]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Request model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->tableid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdateChecked()
    {
        $ridArr = explode(',', Yii::$app->request->post('refIds'));
        $c=count($ridArr);
        
        if($c>0){
            
            foreach($ridArr as $rid){
                $model = $this->findModel($rid);
                $model->checked = 'Y';
                $model->user_id = Yii::$app->user->identity->id;
                $model->user_name = Yii::$app->user->identity->username;

                $model->save();
                echo $model->user_id;
            }

            echo "Update Sucessfully";
        }else{
            echo "You don't select anything";
        }
        /*if(Request::updateAll(['in','tableid',$rid])){
        //if(Account::deleteAll(['in', 'id', $account_ids])){
            Yii::$app->session->setFlash('success', 'ลบบัญชีเรียบร้อยแล้ว');
            return $this->redirect(['index']);
        }else{
            Yii::$app->session->setFlash('error', 'เกิดข้อผิดพลาด');
            return $this->redirect(['index']);
        }*/
    }//End***

    /**
     * Deletes an existing Request model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Request model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Request the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Request::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
