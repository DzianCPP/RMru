<?php
/* @var $this TouristController */
/* @var $data Tourist */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('owner_id')); ?>:</b>
	<?php echo CHtml::encode($data->owner_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('passport')); ?>:</b>
	<?php echo CHtml::encode($data->passport); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('birthday')); ?>:</b>
	<?php echo CHtml::encode($data->birthday); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('travel_service')); ?>:</b>
	<?php echo CHtml::encode($data->travel_service); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('travel_cost')); ?>:</b>
	<?php echo CHtml::encode($data->travel_cost); ?>
	<br />


</div>