<?php
/* @var $this ResortsController */
/* @var $model Resorts */

$this->breadcrumbs=array(
	'Курорты'=>array('admin'),
	'Создать',
);

$this->menu=array(
	//array('label'=>'List Resorts', 'url'=>array('index')),
	array('label'=>'Управление курортами', 'url'=>array('admin')),
);
?>

<h1>Создать Курорт</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>