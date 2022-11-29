<?php
/* @var $this PeriodController */
/* @var $model Period */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'period-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля помеченые <span class="required">*</span> обязательны для заполнения</p>

	<?php echo $form->errorSummary($model, 'Пожалуйста, правильно заполните поля: '); ?>

	<div>
		<?php echo $form->labelEx($model,'bus_id'); ?>
		<?php echo $form->dropDownList($model,'bus_id', Buses::getOptions()); ?>
		<?php echo $form->error($model,'bus_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
						    // additional javascript options for the date picker plugin
						    'options'=>array(
						        'showAnim'=>'fold',
						       	'dateFormat'=> "yy-mm-dd"
						    ),
						    'name'=>'date',
					        'attribute'=>'date', // Model attribute filed which hold user input
					        'model'=>$model,            // Model name
					        'language'=>'ru',
					        'value'=>date('Y-m-d'),
					        'htmlOptions'=>array('size'=>15),
						));
					?>
		<?php echo $form->error($model,'date'); ?>
	</div>
	
	<div>
		<?php echo $form->labelEx($model,'transit_type'); ?>
		<?php echo $form->dropDownList($model,'transit_type', Transittype::getShortListOptions()); ?>
		<?php echo $form->error($model,'transit_type'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->