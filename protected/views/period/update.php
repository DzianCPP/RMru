<?php
/* @var $this PeriodController */
/* @var $model Period */

$this->breadcrumbs=array(
	'Periods'=>array('admin'),
	$model->date,
	'Обновить',
);

$this->menu=array(
    array('label'=>'Управление Периодами', 'url'=>array('admin')),
    array('label'=>'Создать Периодами', 'url'=>array('create')),
);
?>

<h1>Обновить период <?php echo $model->date; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>