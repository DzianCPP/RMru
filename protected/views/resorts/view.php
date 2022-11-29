<?php
/* @var $this ResortsController */
/* @var $model Resorts */

$this->breadcrumbs=array(
	'Resorts'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Resorts', 'url'=>array('index')),
	array('label'=>'Create Resorts', 'url'=>array('create')),
	array('label'=>'Update Resorts', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Resorts', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Resorts', 'url'=>array('admin')),
);
?>

<h1>View Resorts #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',

		'is_active',
	),
)); ?>
