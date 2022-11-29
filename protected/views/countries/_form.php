<?php
/* @var $this CountriesController */
/* @var $model Countries */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'countries-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля помеченые <span class="required">*</span> обязательны для заполнения</p>

	<?php echo $form->errorSummary($model, 'Пожалуйста, правильно заполните поля: '); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

<!--	<div class="row">
		<?php /*echo $form->labelEx($model,'is_active'); */?>
		<?php /*echo $form->textField($model,'is_active'); */?>
		<?php /*echo $form->error($model,'is_active'); */?>
	</div>-->

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->