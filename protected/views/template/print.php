<?php 
$this->breadcrumbs=array(
	'Templates',
);

$this->menu=array(
	//array('label'=>'Create Template', 'url'=>array('create')),
	//array('label'=>'Manage Template', 'url'=>array('admin')),
);
?>

<h1><?php echo $thead ?></h1>

<?php 


$js = 'tinyMCE.init({
		// General options
		mode : "exact",
		elements : "editor_textarea",
		language: "ru",
		theme : "advanced",
		skin : "o2k7",
		plugins : "autoresize,autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups,autosave",
		width: "910px",
		height: "600px",
		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,
		content_css : "/css/teamplate_contract.css" ,
';

$str = 
'		template_replace_values : {'."\n";


foreach ($tvalues as $key => $value) {
	$str .= 
'			"'.$key.'":'.'"'.$value.'",'."\n";
}
$str .= 
'		},'."\n";
$js .= $str;

$js .= 
'		init_instance_callback : "Editor_init_call_back"
	});
	
	function Editor_init_call_back(inst) {
		var teampl = $("#teamplate").val();
		tinymce.EditorManager.activeEditor.execCommand("mceInsertTemplate", false, {content : teampl});
		tinymce.EditorManager.activeEditor.execCommand("mcePrint");';
$js.= "location.replace('$return_url');";
$js.='
        
	}';

Yii::app()->clientScript->registerScriptFile('/js/tiny_mce/tiny_mce_src.js', CClientScript::POS_HEAD); 
Yii::app()->clientScript->registerScript('tiny_mce',$js	, CClientScript::POS_HEAD); 
//Yii::app()->clientScript->registerScript('redirect',"location.replace('$return_url');"	, CClientScript::POS_READY); 
Yii::app()->getClientScript()->registerCoreScript('jquery');

?>

<?php echo CHtml::textArea('editor_textarea')?>
<?php echo CHtml::textArea('teamplate', $tteamplate, array('style'=>'display:none;'))?>
