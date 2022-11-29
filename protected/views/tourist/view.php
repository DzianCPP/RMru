<?php
/* @var $this TouristController */
/* @var $model Tourist */

$this->breadcrumbs=array(
	'Tourists'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Tourist', 'url'=>array('index')),
	array('label'=>'Create Tourist', 'url'=>array('create')),
	array('label'=>'Update Tourist', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Tourist', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Tourist', 'url'=>array('admin')),
);
?>

<h1>View Tourist #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'owner_id',
		'name',
		'passport',
		'birthday',
		'travel_service',
		'travel_cost',
	),
)); ?>
