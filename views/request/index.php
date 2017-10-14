<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\RequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Requests');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php // Html::a(Yii::t('app', 'Create Request'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => [
            'id' => 'gridview-id'
        ],
        'rowOptions' => function ($model, $key, $index, $grid) { //สามารถกำหนด data-key ใหม่ (ปกติจะใช้ PK)
            return ['data' => ['key' => $model->tableid]];
        },
        'columns' => [
            [
                'class' => 'yii\grid\CheckboxColumn',
                'checkboxOptions' => function($model) {
                    //
                }
            ],
            ['class' => 'yii\grid\SerialColumn'],

            'tableid',
            'id',
            'n_number_request',
            'rd_status_app',
            'rd_developin',
             'internation_receive',
             'internation_receivedate',
             'internation_name',
             'sync_cloud_status',
             'sync_cloud_date',
             'cloud_uuid',
             'checked',
             'user_id',
             'user_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    
<?php Pjax::end(); ?></div>
<div class="form-group">
    <?=Html::button('<i class="glyphicon glyphicon-save"></i> Save Change', ['class' => 'btn btn-info', 'id' => 'btn-delete'])?>
</div>
<?php
$this->registerJs('
  $("#btn-delete").click(function(){
    var refIds = $("#gridview-id").yiiGridView("getSelectedRows");
    
    console.log(refIds);
    if(refIds.length > 0){
      $.post("'.Url::to(['update-checked']).'",{
        refIds: refIds.join(),
      },function(){

      })
      .done(function(data) { //callback
        alert(data);
      });
    }
  });
')
?>