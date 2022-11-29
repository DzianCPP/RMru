<?php
Yii::import('application.models.templates.*');

class TemplateController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	
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

		if(isset($_POST['Template']))
		{
			$model->attributes=$_POST['Template'];
			if($model->save())
				$this->redirect(array('update','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	


	public function actionPrintTemplate($type, $id)
	{
		$this->layout='//layouts/column1';
		switch ($type) {
			case 'contract':
                $contract = new Contract($id);
				$tvalues = $contract->getValues();

				$thead = 'Печать Договора' ;
				$tteamplate = $contract->getTemplate()->html;
				break;
			case 'contract_add2':
                $tour = Tour::model()->findByPk($id);

                switch($tour->transit){
                    case Transittype::BACK:
                        $contract = new ContractAdd2Back($id);
                        break;
                    case Transittype::THERE:
                        $contract = new ContractAdd2There($id);
                        break;
                    case Transittype::TWO_SIDE:
                        $contract = new ContractAdd2TwoSide($id);
                        break;
                    case Transittype::NO_TRANSIT:
                        $contract = new ContractAdd2NoTransit($id);
                        break;
                }

                $tvalues = $contract->getValues();

                $thead = 'Печать Приложения 2' ;
                $tteamplate = $contract->getTemplate()->html;
                break;

			default:
				new CHttpException(404, 'Not Found 1');
				break;
		}

        // prepare drow
		

		 $mPDF1 = Yii::app()->ePdf->mpdf();

        # Вы можете с легкостью переопределить параметры по умолчанию для конструктора
      //  $mPDF1 = Yii::app()->ePdf->mpdf('', 'A5');

        # render (полная страница page)
        //$mPDF1->WriteHTML($this->render('index', array(), true));

        # Загрузить таблицу стилей в документ
        
    //    $mPDF1->WriteHTML($stylesheet, 1);
//$mPDF1->SetColumns(2,'justyfy', '5'); 
        # renderPartial (только представление текущего контроллера)
      

        # Отрисовка картинки в документе
       // $mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));
     $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . '/print.css');
 $mPDF1->WriteHTML($stylesheet, 1);
   $mPDF1->WriteHTML(str_replace('\\','',strtr($tteamplate, $tvalues)),2);
        # Вывод готового PDF
        $mPDF1->Output();
/*$this->render('print', array(
			'tvalues' 		=> 	$tvalues,
			'tteamplate'	=>	$tteamplate,
			'thead'			=> 	$thead,
			'return_url'	=> 	isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:Yii::app()->baseUrl,
		));*/
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Template('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Template']))
			$model->attributes=$_GET['Template'];

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
		$model=Template::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='template-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

}
