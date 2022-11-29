<?php
/* @var $this TourController */
/* @var $model Tour */
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
		<?php echo $form->label($model,'manager_id'); ?>
		<?php echo $form->textField($model,'manager_id',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_only_transit'); ?>
		<?php echo $form->textField($model,'is_only_transit'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'transit'); ?>
		<?php echo $form->textField($model,'transit',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<!-- <div class="row">
		<?php //echo $form->label($model,'resorts'); ?>
		<?php //echo $form->textField($model,'resorts',array('size'=>60,'maxlength'=>255)); ?>
	</div> -->

	<div class="row">
		<?php echo $form->label($model,'period_id'); ?>
		<?php echo $form->textField($model,'period_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'count_of_day'); ?>
		<?php echo $form->textField($model,'count_of_day'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bus'); ?>
		<?php echo $form->textField($model,'bus',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'owner_name'); ?>
		<?php echo $form->textField($model,'owner_name',array('size'=>60,'maxlength'=>1000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'owner_tel1'); ?>
		<?php echo $form->textField($model,'owner_tel1',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'owner_tel2'); ?>
		<?php echo $form->textField($model,'owner_tel2',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'owner_passport'); ?>
		<?php echo $form->textField($model,'owner_passport',array('size'=>60,'maxlength'=>1000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'owner_birthday'); ?>
		<?php echo $form->textField($model,'owner_birthday'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'owner_travel_service'); ?>
		<?php echo $form->textField($model,'owner_travel_service'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'owner_travel_cost'); ?>
		<?php echo $form->textField($model,'owner_travel_cost'); ?>
	</div>

	

	<div class="row">
		<?php echo $form->label($model,'count_of_childs'); ?>
		<?php echo $form->textField($model,'count_of_childs'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ages'); ?>
		<?php echo $form->textField($model,'ages',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'total_travel_service'); ?>
		<?php echo $form->textField($model,'total_travel_service'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'total_travel_cost'); ?>
		<?php echo $form->textField($model,'total_travel_cost'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->