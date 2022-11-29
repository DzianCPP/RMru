<?php
/* @var $this CountriesController */
/* @var $model Countries */

$this->breadcrumbs=array(
	'Страны'=>array('admin'),
	'Создать',
);

$this->menu=array(
	//array('label'=>'List Countries', 'url'=>array('index')),
	array('label'=>'Управление Странами', 'url'=>array('admin')),
);
?>

<h1>Создать страну</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>