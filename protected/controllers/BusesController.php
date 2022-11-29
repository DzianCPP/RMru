<?php

class BusesController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	//public $defaultAction = 'admin';
	/**
	 * @return array action filters
	 */
	
	public function actionListcreate()
	{
		$this->layout='//layouts/column1';
		$model = new ListTourist('search');
		if (isset($_POST['ListTourist']))
		{		    //CVarDumper::dump($_POST['ListTourist']['period_id']);
			$model->attributes = $_POST['ListTourist'];

		}
		
		if(isset($_POST['action'])&&$_POST['action'] == 'print'){
		     $mPDF1 = Yii::app()->ePdf->mpdf();

        # Вы можете с легкостью переопределить параметры по умолчанию для конструктора
      //  $mPDF1 = Yii::app()->ePdf->mpdf('', 'A5');

        # render (полная страница page)
        //$mPDF1->WriteHTML($this->render('index', array(), true));

        # Загрузить таблицу стилей в документ
        $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . '/print.css');
        $mPDF1->WriteHTML($stylesheet, 1);
//$mPDF1->SetColumns(2,'justyfy', '5'); 
        # renderPartial (только представление текущего контроллера)
        $mPDF1->WriteHTML($this->renderPartial('_templateList', array('model'  => $model),true));

        # Отрисовка картинки в документе
       // $mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));

        # Вывод готового PDF
        $mPDF1->Output();
		    
		    
		    
		    
		}else{
		$this->render('listTourist', array('model' =>$model , ));
		}
	}
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/*public function actionFind()
	{
		$this->render();
	}*/
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Buses;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Buses']))
		{
			$model->attributes=$_POST['Buses'];
			if($model->save())
				$this->redirect(array('admin'));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Buses']))
		{
			$model->attributes=$_POST['Buses'];
			if($model->save())
				$this->redirect(array('admin'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Buses');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Buses('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Buses']))
			$model->attributes=$_GET['Buses'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Buses::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='buses-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
