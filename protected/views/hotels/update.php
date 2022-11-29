<?php
/* @var $this HotelsController */
/* @var $model Hotels */

$this->breadcrumbs=array(
	'Гостиницы'=>array('admin'),
	$model->name,
	'Обновить',
);

$this->menu=array(
	//array('label'=>'List Hotels', 'url'=>array('index')),
	array('label'=>'Создать Гостиницу', 'url'=>array('create')),
	//array('label'=>'View Hotels', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Управление Гостиницами', 'url'=>array('admin')),
);
?>

<h1>Обновить Гостиницу <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>