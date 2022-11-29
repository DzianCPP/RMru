<?php
/* @var $this BusesController */
/* @var $model Buses */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'route'); ?>
		<?php echo $form->textField($model,'route',array('size'=>60,'maxlength'=>1024)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'count_of_plases'); ?>
		<?php echo $form->textField($model,'count_of_plases'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'departure_with_minsk'); ?>
		<?php echo $form->textField($model,'departure_with_minsk',array('size'=>60,'maxlength'=>1024)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'departure_with_resort'); ?>
		<?php echo $form->textField($model,'departure_with_resort',array('size'=>60,'maxlength'=>1024)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'arrival_in_minsk'); ?>
		<?php echo $form->textField($model,'arrival_in_minsk',array('size'=>60,'maxlength'=>1024)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->