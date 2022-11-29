<?php
/* @var $this TouristController */
/* @var $model Tourist */

$this->breadcrumbs=array(
	'Tourists'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Tourist', 'url'=>array('index')),
	array('label'=>'Create Tourist', 'url'=>array('create')),
	array('label'=>'View Tourist', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Tourist', 'url'=>array('admin')),
);
?>

<h1>Update Tourist <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>