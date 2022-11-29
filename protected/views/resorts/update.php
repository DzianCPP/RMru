<?php
/* @var $this ResortsController */
/* @var $model Resorts */

$this->breadcrumbs=array(
	'Курорты'=>array('admin'),
	$model->name,
	'Обновить',
);

$this->menu=array(
	//array('label'=>'List Resorts', 'url'=>array('index')),
	array('label'=>'Создать курорт', 'url'=>array('create')),
	//array('label'=>'View Resorts', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Управление курортами', 'url'=>array('admin')),
);
?>

<h1>Обновить курорт <?php echo $model->name; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>