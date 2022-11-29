<?php
/* @var $this TourController */
/* @var $model Tour */

$this->breadcrumbs=array(
	'Tours'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Tour', 'url'=>array('index')),
	array('label'=>'Create Tour', 'url'=>array('create')),
	array('label'=>'Update Tour', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Tour', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Tour', 'url'=>array('admin')),
);
?>

<h1>View Tour #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'manager',
		'is_only_transit',
		'transit',
		'resorts',
		'period_id',
		'count_of_day',
		'bus',
		'owner_name',
		'owner_tel1',
		'owner_tel2',
		'owner_passport',
		'owner_birthday',
		'owner_travel_service',
		'owner_travel_cost',
		'man1_name',
		'man1_birthday',
		'man1_travel_service',
		'man1_travel_cost',
		'man2_name',
		'man2_birthday',
		'man2_travel_service',
		'man2_travel_cost',
		'man3_name',
		'man3_birthday',
		'man3_travel_service',
		'man3_travel_cost',
		'count_of_childs',
		'ages',
		'total_travel_service',
		'total_travel_cost',
	),
)); ?>
