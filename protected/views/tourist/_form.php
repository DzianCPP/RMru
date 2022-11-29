<?php
/* @var $this TouristController */
/* @var $model Tourist */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tourist-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model, 'Пожалуйста, правильно заполните поля: '); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'owner_id'); ?>
		<?php echo $form->textField($model,'owner_id'); ?>
		<?php echo $form->error($model,'owner_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>1000)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'passport'); ?>
		<?php echo $form->textField($model,'passport',array('size'=>60,'maxlength'=>1000)); ?>
		<?php echo $form->error($model,'passport'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'birthday'); ?>
		<?php echo $form->textField($model,'birthday'); ?>
		<?php echo $form->error($model,'birthday'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'travel_service'); ?>
		<?php echo $form->textField($model,'travel_service'); ?>
		<?php echo $form->error($model,'travel_service'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'travel_cost'); ?>
		<?php echo $form->textField($model,'travel_cost'); ?>
		<?php echo $form->error($model,'travel_cost'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->