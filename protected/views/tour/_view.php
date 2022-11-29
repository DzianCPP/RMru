<?php
/* @var $this TourController */
/* @var $data Tour */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('manager_id')); ?>:</b>
	<?php echo CHtml::encode($data->manager_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_only_transit')); ?>:</b>
	<?php echo CHtml::encode($data->is_only_transit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('transit')); ?>:</b>
	<?php echo CHtml::encode($data->transit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('resorts')); ?>:</b>
	<?php echo CHtml::encode($data->resorts); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('period_id')); ?>:</b>
	<?php echo CHtml::encode($data->period_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('count_of_day')); ?>:</b>
	<?php echo CHtml::encode($data->count_of_day); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('bus')); ?>:</b>
	<?php echo CHtml::encode($data->bus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('owner_name')); ?>:</b>
	<?php echo CHtml::encode($data->owner_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('owner_tel1')); ?>:</b>
	<?php echo CHtml::encode($data->owner_tel1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('owner_tel2')); ?>:</b>
	<?php echo CHtml::encode($data->owner_tel2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('owner_passport')); ?>:</b>
	<?php echo CHtml::encode($data->owner_passport); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('owner_birthday')); ?>:</b>
	<?php echo CHtml::encode($data->owner_birthday); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('owner_travel_service')); ?>:</b>
	<?php echo CHtml::encode($data->owner_travel_service); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('owner_travel_cost')); ?>:</b>
	<?php echo CHtml::encode($data->owner_travel_cost); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('man1_name')); ?>:</b>
	<?php echo CHtml::encode($data->man1_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('man1_birthday')); ?>:</b>
	<?php echo CHtml::encode($data->man1_birthday); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('man1_travel_service')); ?>:</b>
	<?php echo CHtml::encode($data->man1_travel_service); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('man1_travel_cost')); ?>:</b>
	<?php echo CHtml::encode($data->man1_travel_cost); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('man2_name')); ?>:</b>
	<?php echo CHtml::encode($data->man2_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('man2_birthday')); ?>:</b>
	<?php echo CHtml::encode($data->man2_birthday); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('man2_travel_service')); ?>:</b>
	<?php echo CHtml::encode($data->man2_travel_service); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('man2_travel_cost')); ?>:</b>
	<?php echo CHtml::encode($data->man2_travel_cost); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('man3_name')); ?>:</b>
	<?php echo CHtml::encode($data->man3_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('man3_birthday')); ?>:</b>
	<?php echo CHtml::encode($data->man3_birthday); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('man3_travel_service')); ?>:</b>
	<?php echo CHtml::encode($data->man3_travel_service); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('man3_travel_cost')); ?>:</b>
	<?php echo CHtml::encode($data->man3_travel_cost); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('count_of_childs')); ?>:</b>
	<?php echo CHtml::encode($data->count_of_childs); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ages')); ?>:</b>
	<?php echo CHtml::encode($data->ages); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_travel_service')); ?>:</b>
	<?php echo CHtml::encode($data->total_travel_service); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_travel_cost')); ?>:</b>
	<?php echo CHtml::encode($data->total_travel_cost); ?>
	<br />

	*/ ?>

</div>