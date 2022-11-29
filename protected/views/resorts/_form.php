<?php
/* @var $this ResortsController */
/* @var $model Resorts */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'resorts-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля помеченые <span class="required">*</span> обязательны для заполнения</p>

	<?php echo $form->errorSummary($model, 'Пожалуйста, правильно заполните поля: '); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'country_id'); ?>
		<?php echo $form->dropDownList($model,'country_id',Countries::getOptions()); ?>
		<?php echo $form->error($model,'country_id'); ?>
	</div>

	<!--<div class="row">
		<?php /*echo $form->labelEx($model,'is_active'); */?>
		<?php /*echo $form->textField($model,'is_active'); */?>
		<?php /*echo $form->error($model,'is_active'); */?>
	</div>-->

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->