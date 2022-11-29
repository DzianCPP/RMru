<?php
/* @var $this BusesController */
/* @var $data Buses */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('route')); ?>:</b>
	<?php echo CHtml::encode($data->route); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('count_of_plases')); ?>:</b>
	<?php echo CHtml::encode($data->count_of_plases); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('departure_with_minsk')); ?>:</b>
	<?php echo CHtml::encode($data->departure_with_minsk); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('departure_with_resort')); ?>:</b>
	<?php echo CHtml::encode($data->departure_with_resort); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('arrival_in_minsk')); ?>:</b>
	<?php echo CHtml::encode($data->arrival_in_minsk); ?>
	<br />


</div>