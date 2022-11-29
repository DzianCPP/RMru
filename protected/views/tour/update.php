<?php
/* @var $this TourController */
/* @var $model Tour */

$this->breadcrumbs=array(
	'Главная'=>array('admin'),
	$model->id=>array('view','id'=>$model->id),
	'Обновить',
);

$this->menu=array(
	array('label'=>'List Tour', 'url'=>array('index')),
	array('label'=>'Create Tour', 'url'=>array('create')),
	array('label'=>'View Tour', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Tour', 'url'=>array('admin')),
);
?>

<h1>Изменение договора</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>