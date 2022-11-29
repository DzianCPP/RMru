<?php
/* @var $this HotelsController */
/* @var $model Hotels */

$this->breadcrumbs=array(
	'Гостиницы'=>array('admin'),
	'Создать',
);

$this->menu=array(
	//array('label'=>'List Hotels', 'url'=>array('index')),
	array('label'=>'Управление Гостиницами', 'url'=>array('admin')),
);
?>

<h1>Создать Гостиницу</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>