<?php
/* @var $this BusesController */
/* @var $model Buses */

$this->breadcrumbs=array(
	'Автобусы'=>array('admin'),
	$model->name,
	'Обновить',
);

$this->menu=array(
/*	array('label'=>'List Buses', 'url'=>array('index')),*/
	array('label'=>'Создать автобус', 'url'=>array('create')),
	/*array('label'=>'View Buses', 'url'=>array('view', 'id'=>$model->id)),*/
	array('label'=>'Управление автобусами', 'url'=>array('admin')),
);
?>

<h1>Обновить автобус <?php echo $model->name; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>