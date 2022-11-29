<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->
	 <?php //Yii::app()->clientScript->registerCoreScript('jquery'); ?>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/flash.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		
	</div><!-- header -->

	<div id="mainmenu">
	

		<?php $this->widget('zii.widgets.CMenu',array(
			'activeCssClass'=>'active',
  			'activateParents'=>true,
			'items'=>array(
				//array('label'=>'Home', 'url'=>array('/site/index')),
				//array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				//array('label'=>'Contact', 'url'=>array('/site/contact')),
				array('label'=>'Вход', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label' => 'Главная',  'url'=> array('/tour'), 'visible'=>!Yii::app()->user->isGuest ),
                array('label' => 'Сформировать список' , 'url'=> array('/buses/listcreate'), 'visible'=>!Yii::app()->user->isGuest ),
                array('label' => 'Поиск туров',  'url'=> array('/tour/admin'), 'visible'=>!Yii::app()->user->isGuest ),
				
			    array('label'=>'Справочники',  'visible'=>!Yii::app()->user->isGuest,'items'=>array(
				array('label' => 'Менеджеры',  'url'=> array('/managers'), 'visible'=>!Yii::app()->user->isGuest ),
				array('label' => 'Страны',  'url'=> array('/countries'), 'visible'=>!Yii::app()->user->isGuest ),
				array('label' => 'Курорты',  'url'=> array('/resorts'), 'visible'=>!Yii::app()->user->isGuest ),
				
				array('label' => 'Гостиницы',  'url'=> array('/hotels'), 'visible'=>!Yii::app()->user->isGuest ),
				array('label' => 'Автобусы',  'url'=> array('/buses'), 'visible'=>!Yii::app()->user->isGuest ),
				array('label' => 'Периоды',  'url'=> array('/period'), 'visible'=>!Yii::app()->user->isGuest ),
				array('label' => 'Шаблоны',  'url'=> array('/template'), 'visible'=>!Yii::app()->user->isGuest ),

				
				)),
			    array('label'=>'Сменить пароль ', 'url'=>array('/site/reset'), 'visible'=>!Yii::app()->user->isGuest),
                array('label'=>'Выход ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
			),	
		)); 



		?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
	//		'links'=>$this->breadcrumbs,
            'homeLink' => false,
		)); ?><!-- breadcrumbs -->
	<?php endif?>
    <?php
    $user = Yii::app()->user;
    if($user->hasFlash('success')){
        echo '<div id="flash_success">'. $user->getFlash('success') .'</div>';
    }
    if($user->hasFlash('failure')){
        echo '<div id="flash_failure">'. $user->getFlash('failure') .'</div>';
    }
    ?>
	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by Irianna.<br/>
		All Rights Reserved.<br/>
		Creation <a href="http://hotwebstudio.by" target="_self">Hot Web Studio</a>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
