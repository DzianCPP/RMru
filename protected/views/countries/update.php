<?php
/* @var $this CountriesController */
/* @var $model Countries */

$this->breadcrumbs=array(
	'Страны'=>array('admin'),
	$model->name,
	'Обновить',
);

$this->menu=array(
	//array('label'=>'List Countries', 'url'=>array('index')),
	array('label'=>'Создать Страну', 'url'=>array('create')),
	//array('label'=>'View Countries', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Управление странами', 'url'=>array('admin')),
);
?>

<h1>Обновить страну <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>