<?php
/* @var $this PeriodController */
/* @var $model Period */

$this->breadcrumbs=array(
	'Periods'=>array('index'),
	'Create',
);
$this->menu=array(
    array('label'=>'Управление Периодами', 'url'=>array('admin')),

);
?>

<h1>Создать период</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>