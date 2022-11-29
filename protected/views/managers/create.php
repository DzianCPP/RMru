<?php
/* @var $this ManagersController */
/* @var $model Managers */

$this->breadcrumbs=array(
	'Менеджеры'=>array('admin'),
	'Создать',
);

$this->menu=array(
	/*array('label'=>'Список Менеджеров', 'url'=>array('index')),*/
	array('label'=>'Управление Менеджерами', 'url'=>array('admin')),
);
?>

<h1>Создать Менеджера</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>