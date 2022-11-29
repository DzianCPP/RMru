<?php
/* @var $this BusesController */
/* @var $model Buses */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'buses-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля помеченые <span class="required">*</span> обязательны для заполнения</p>

	<?php echo $form->errorSummary($model, 'Пожалуйста, правильно заполните поля: '); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'route'); ?>
		<?php echo $form->textField($model,'route',array('size'=>60,'maxlength'=>1024)); ?>
		<?php echo $form->error($model,'route'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'count_of_plases'); ?>
		<?php echo $form->textField($model,'count_of_plases'); ?>
		<?php echo $form->error($model,'count_of_plases'); ?>
	</div>

	

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->