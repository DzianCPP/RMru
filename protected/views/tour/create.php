<?php
/* @var $this TourController */
/* @var $model Tour */

$this->breadcrumbs=array(
	'Главная'=>array('admin'),
	'Создать',
);

$this->menu=array(
	array('label'=>'List Tour', 'url'=>array('index')),
	array('label'=>'Manage Tour', 'url'=>array('admin')),
);
?>

<h1>Оформить заказ</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>