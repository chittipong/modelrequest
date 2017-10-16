<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
<div class="col-lg-8">
<div class="panel panel-primary">
<div class="panel-heading"><h3><?= Html::encode($this->title) ?></h3></div>
<div class="panel-body">

    <div class="brand-form">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username') ?>
            
                <?= $form->field($model, 'fname') ?>
            
                <?= $form->field($model, 'lname') ?>

                <?= $form->field($model, 'tel') ?>
        
                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'country') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
    </div>
</div>
</div>
</div>
</div>