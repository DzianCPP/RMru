<?php
/* @var $this ManagersController */
/* @var $model Managers */

$this->breadcrumbs=array(
	'Менеджеры'=>array('index'),
	$model->name/*=>array('view','id'=>$model->id)*/,
	'Обновить',
);

$this->menu=array(
	array('label'=>'Управление Менеджерами', 'url'=>array('admin')),
	array('label'=>'Создать Менеджера', 'url'=>array('create')),
	/*array('label'=>'View Managers', 'url'=>array('view', 'id'=>$model->id)),*/
	/*array('label'=>'Manage Managers', 'url'=>array('admin')),*/
);
?>

<h1>Обновить менеджера <?php echo $model->name; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>