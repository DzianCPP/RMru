<?php
/* @var $this TemplateController */
/* @var $model Template */

$this->breadcrumbs=array(
	'Шаблоны'=>array('admin'),
	$model->label,
	'Обновить',
);

?>

<h1>Обновить шаблон <?php echo $model->label; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>