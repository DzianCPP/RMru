
<?php
$this->pageTitle = Yii::app()->name . ' - Сменить пароль';
?>

<h1>Сменить пароль</h1>

<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'login-form',
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    ));
    ?>
    <?php echo $form->errorSummary($model, 'Пожалуйста, правильно заполните поля: '); ?>

    <p class="note">>Поля помеченые <span class="required">*</span> обязательны для заполнения</p>

    <div class="row">
        <?php echo $form->labelEx($model, 'username'); ?>
        <?php echo $form->textField($model, 'username'); ?>
        <?php  echo $form->error($model, 'username'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'password'); ?>
        <?php echo $form->passwordField($model,'password'); ?>
        <?php echo $form->error($model,'password'); ?>

    </div>
    <div class="row">
        <?php  echo $form->labelEx($model, 'new_username'); ?>
        <?php  echo $form->textField($model, 'new_username'); ?>
        <?php  echo $form->error($model, 'new_username'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'new_password'); ?>
        <?php echo $form->passwordField($model,'new_password'); ?>
        <?php echo $form->error($model,'new_password'); ?>

    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'repeat_password'); ?>
        <?php echo $form->passwordField($model,'repeat_password'); ?>
        <?php echo $form->error($model,'repeat_password'); ?>

    </div>
    <div class="row buttons">
        <?php echo CHtml::submitButton('Сброс'); ?>
    </div>

    <?php $this->endWidget(); ?>
</div><!-- form -->