<?php
/* @var $this PeriodController */
/* @var $model Period */

$this->breadcrumbs=array(
	'Periods'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Period', 'url'=>array('index')),
	array('label'=>'Create Period', 'url'=>array('create')),
	array('label'=>'Update Period', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Period', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Period', 'url'=>array('admin')),
);
?>

<h1>View Period #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'date',
	),
)); ?>
