<?php
/* @var $this ResortsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Resorts',
);

$this->menu=array(
	array('label'=>'Create Resorts', 'url'=>array('create')),
	array('label'=>'Manage Resorts', 'url'=>array('admin')),
);
?>

<h1>Resorts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
