<?php
/* @var $this TouristController */
/* @var $model Tourist */

$this->breadcrumbs=array(
	'Tourists'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Tourist', 'url'=>array('index')),
	array('label'=>'Manage Tourist', 'url'=>array('admin')),
);
?>

<h1>Create Tourist</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>