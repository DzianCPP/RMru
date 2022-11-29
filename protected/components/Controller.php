<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

	/**
	* теперь это действие будет вызвано у контроллера по умолчанию
	*/
	public $defaultAction = 'admin';
	

	/**
	 * @return array action filters
	 */
	public function filters()
	{

		return array(
			'accessControl', // perform access control for CRUD operations
			);
	}

	public function accessRules()
	{
		return array(

			 array('allow',  // allow all users to perform 'index' and 'view' actions
			 	'controllers'=>array('site'),
			 	'actions'=>array('error','login', 'index' ),
			 	'users'=>array('*'),
			 	),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				//'actions'=>array('captcha', 'page', 'index'),
				'users'=>array('@','admin'),
				),
			/*array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
				),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'users'=>array('admin','@'),
				),*/
			array('deny',  // deny all users
				'users'=>array('*'),
				),
			);
		
	}
	public function beforeAction($action) {
	    parent::beforeAction($action);
	    //CVarDumper::dump($action);
	    if(Yii::app()->user->isGuest && $action->id!='login')
		$this->redirect (Yii::app()->createUrl('/site/login'));
		//echo 1;
	    
	   else return true;
	}

}