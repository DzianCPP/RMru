<?php
/* @var $this TemplateController */
/* @var $model Template */
/* @var $form CActiveForm */
?>

<?php 
$this->menu=array(
	array('label'=>'Шаблоны', 'url'=>array('admin')),
	
);
Yii::app()->clientScript->registerScriptFile('/js/tiny_mce/tiny_mce_src.js', CClientScript::POS_HEAD); 
Yii::app()->clientScript->registerScript('tiny_mce','

	tinyMCE.init({
		// General options
		mode : "textareas",
		language: "ru",
		theme : "advanced",
		skin : "o2k7",
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups,autosave",
		width : "720px",
		height : "600px",
		
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		
	});
	
', CClientScript::POS_HEAD); 

?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'template-form',
	'enableAjaxValidation'=>false,
)); ?>


	

	<div class="row">

		<?php echo $form->textArea($model,'html',array('rows'=>6, 'cols'=>50)); ?>

	</div>



<?php $this->endWidget(); ?>

</div><!-- form -->