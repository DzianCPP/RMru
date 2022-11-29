<?php
/* @var $this TouristController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tourists',
);

$this->menu=array(
	array('label'=>'Create Tourist', 'url'=>array('create')),
	array('label'=>'Manage Tourist', 'url'=>array('admin')),
);
?>

<h1>Tourists</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
