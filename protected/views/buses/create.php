<?php
/* @var $this BusesController */
/* @var $model Buses */

$this->breadcrumbs=array(
	'Автобусы'=>array('admin'),
	'Создать',
);

$this->menu=array(
	/*array('label'=>' ', 'url'=>array('ск')),*/
	array('label'=>'Управление автобусами', 'url'=>array('admin')),
);
?>

<h1>Создать автобус</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>