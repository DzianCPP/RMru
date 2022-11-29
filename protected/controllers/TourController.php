<?php

class TourController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	public $defaultAction = 'create';

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model = $this->loadModel($id);

		$this->render('view',array(
			'model'=>$model,
		));
	}

    /**
     * @param $tourists
     * @return Tourist[]
     */
    private function processingArrayDataTourists($tourists){
        $return = array();
        foreach($tourists as $t){
            $tourist = null;
            if($t['id']){
                $tourist = Tourist::model()->findByPk($t['id']);
            }else{
                $tourist = new Tourist;
            }
            $tourist->attributes = $t;
            $return[] = $tourist;
        }
        return $return;
    }
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
        $this->layout="//layouts/column1";
		$model=new Tour;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Tour']))
		{
			$attributes = $_POST['Tour'];
			if(isset($attributes['tourist'])){
				$model->tourists = $this->processingArrayDataTourists($attributes['tourist']);
				unset($attributes['tourist']);
			}
			$model->attributes=$attributes;


			if($model->withRelated->save(true,array('tourists'))){
                Yii::app()->user->setFlash('success', 'Заказ успешно оформлен!');
                $this->redirect(array('update','id'=>$model->id));

            }else{
                Yii::app()->user->setFlash('failure', 'Что-то пошло не так :(');
            }
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
		$this->layout="//layouts/column1";
        $model = $this->loadModel($id); ;// load model with existing relations
		if(isset($_POST['Tour']))
		{	
			$attributes = $_POST['Tour'];
            $db = $model->getDbConnection();
            $transaction = $db->beginTransaction();
            try{

                $new_tourists = $model->tourists;
                if(count($new_tourists)>0 && !isset($attributes['tourist'])){
                    foreach($new_tourists as $dt){
                        $dt->delete();
                    }
                }
                if(isset($attributes['tourist'])){

                    foreach($new_tourists as $key => $exist_tourist){ // change or delete
                        /** @var $exist_tourist Tourist */
                        $need_unset_key = null;
                        foreach($attributes['tourist'] as $key => $attr_tourists){
                            if($exist_tourist->id == $attr_tourists['id']){ // applay changes
                                $exist_tourist->attributes = $attr_tourists;
                                $need_unset_key = $key;
                            }
                        }
                        if(!is_null($need_unset_key)){ // update data for current record find,  need unset from input data
                            unset($attributes['tourist'][$need_unset_key]);
                        }else{ // update data for current record not find => item will DELETED
                            $exist_tourist->delete();
                            unset($new_tourists[$key]);
                        }
                    }
                    foreach($attributes['tourist'] as  $attr_tourists){ // not processing data - data is new!
                        $t = new Tourist();
                        $t->attributes = $attr_tourists;
                        $t->owner_id = $model->id;
                        $new_tourists[] = $t;
                    }

                    unset($attributes['tourist']);


                    foreach($new_tourists as $t){
                        /** @var $t Tourist */
                        if(!$t->save()){
                            throw new CException('Не пройдена валидация!');
                        }
                    }
                }
				$model->unsetAttributes(array('bus','bus_back','period_id','period_back_id'));
                $model->attributes=$attributes;
                if($model->save()){
                    Yii::app()->user->setFlash('success', 'Заказ успешно оформлен!');
                    $transaction->commit();
                    $this->redirect(array('update','id'=>$model->id));


                }else{
                    throw new CException('Не пройдена валидация!');
                }
            }
            catch(Exception $e){
                $transaction->rollback();
                Yii::app()->user->setFlash('failure', 'Что-то пошло не так :('. $e->getMessage());
            }
		}
		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Print contract.
	 * @param integer $id the ID of the model to be print
	 */
	public function actionPrintcontract($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		//echo 'bla';
		return Yii::app()->getRequest()->sendFile('contract.doc','Hello World!!!');
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
		$dataProvider=new CActiveDataProvider('Tour');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$this->layout = '//layouts/column1';
		$model=new Tour('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Tour']))
			$model->attributes=$_GET['Tour'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	
	public function actionSearch()
	{
		$this->layout = '//layouts/column1';
		$model=new Tour('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Tour']))
			$model->attributes=$_GET['Tour'];

		$this->render('search',array(
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
		$model=Tour::model()->with('tourists')->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='tour-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionGetresorts($country_id)
	{
		//echo 'hello world!';
		//echo $country_id;
		//print_r($_GET);
		$result = array();
		$result['type'] = 'success';
		$criteria=new CDbCriteria;
		$criteria->compare('country_id',$country_id);
		$criteria->limit=100;
		try {
			$dataProvider=new CActiveDataProvider('Resorts',array(
			'criteria'=>$criteria,'pagination'=>array('pageSize'=>100)
			));	
		} catch (Exception $e) {
			$result['type'] = 'error';
			Yii::app()->end();
		}
	//print_r($dataProvider->getData()); 
		$result = array();
		foreach ($dataProvider->getData() as $value) {
			
			$result['resorts'][] = array('id'=>$value->id,
				'title'=>$value->name,);
		}
		print json_encode($result);

		 Yii::app()->end();
	}

	public function actionGethotels($resorts_id)
	{
		
		$result = array();
		$result['type'] = 'success';
		$criteria=new CDbCriteria;
		$criteria->compare('resorts_id',$resorts_id);
		try {
			$dataProvider=new CActiveDataProvider('Hotels',array(
			'criteria'=>$criteria,'pagination'=>array('pageSize'=>100)
			));	
		} catch (Exception $e) {
			$result['type'] = 'error';
			Yii::app()->end();
		}
		//print_r($dataProvider); 
		$result = array();
		foreach ($dataProvider->getData() as $value) {
			
			$result['resorts'][] = array('id'=>$value->id,
				'title'=>$value->name,);
		}
		print json_encode($result);

		 Yii::app()->end();
	}
    public function actionCansave(){
      
          
         $result = array();
        if(($_GET['ctour']+1>Buses::getCountPassenger($_GET['bus'], $_GET['period_id'], Transittype::THERE)&&$_GET['period_id'])||($_GET['ctour']+1>Buses::getCountPassenger($_GET['bus_back'], $_GET['period_back_id'], Transittype::BACK)&&$_GET['period_back_id']))
            {
                
                 $result['res']=0;   
				 if($_GET['period_id'])
                 $result['bb']=Buses::getCountPassenger($_GET['bus'], $_GET['period_id'], Transittype::THERE); 
				if($_GET['period_back_id'])
                 $result['b2']=Buses::getCountPassenger($_GET['bus_back'], $_GET['period_back_id'], Transittype::BACK);      
            }else  $result['res']=1;
            print json_encode($result);

         Yii::app()->end();
    }
	public function actionGetbusperiods($bus_id, $transit_type , $period_id = null, $period_back_id = null,$date_start=null,$date_to=null)
	{
		$result = array('type' => 'success');
		if ($transit_type == Transittype::THERE or $transit_type == Transittype::TWO_SIDE) {
			//$result['there'] = Buses::getCountPassenger($bus_id, $period_id, Transittype::THERE);
			$result['opt']=CHtml::DropDownList('Tour[period_id]',$period_id,Period::getOptions($bus_id,$date_start,$date_to),array('id'=>'Tour_period_id', 'class'=>'period_change valid','empty'=>''));
		}

		if ($transit_type == Transittype::BACK or $transit_type == Transittype::TWO_SIDE) {
			//$result['back'] = Buses::getCountPassenger($bus_id, $period_back_id, Transittype::BACK);
			$result['backopt']=CHtml::DropDownList('Tour[period_back_id]',$period_back_id,Period::getBackOptions($bus_id,$date_start,$date_to),array('id'=>'Tour_period_back_id', 'class'=>'period_change valid','empty'=>''));
		}

		/*$result['there'] =	$there_count_of_plases;
		$result['back']  =	$back_count_of_plases;*/
		print json_encode($result);
	 	Yii::app()->end();
	}
	public function actionGetbusperiodsfbus($bus_id, $transit_type , $period_id = null, $period_back_id = null,$date_start=null,$date_to=null)
	{
	    $result = array('type' => 'success');
        if ($transit_type == Transittype::THERE or $transit_type == Transittype::TWO_SIDE) {
            //$result['there'] = Buses::getCountPassenger($bus_id, $period_id, Transittype::THERE);
            $result['opt']=CHtml::DropDownList('ListTourist[period_id]',$period_id,Period::getOptions($bus_id,$date_start,$date_to),array('id'=>'ListTourist_period_id', 'class'=>'period_change valid','empty'=>''));
        }

        if ($transit_type == Transittype::BACK or $transit_type == Transittype::TWO_SIDE) {
            //$result['back'] = Buses::getCountPassenger($bus_id, $period_back_id, Transittype::BACK);
            $result['backopt']=CHtml::DropDownList('ListTourist[period_back_id]',$period_back_id,Period::getBackOptions($bus_id,$date_start,$date_to),array('id'=>'ListTourist_period_back_id', 'class'=>'period_change valid','empty'=>''));
        }

        /*$result['there'] =    $there_count_of_plases;
        $result['back']  =  $back_count_of_plases;*/
        print json_encode($result);
        Yii::app()->end();
 
	}
	public function actionGetbusplaces($bus_id, $transit_type , $period_id = null)
	{
		$result = array('type' => 'success');

		if ($period_id && ($transit_type == Transittype::THERE or $transit_type == Transittype::TWO_SIDE)) {
			$result['there'] = Buses::getCountPassenger($bus_id, $period_id, Transittype::THERE);
			//$result['opt']=CHtml::DropDownList('Tour[period_id]','',Period::getOptions($bus_id),array('id'=>'Tour_period_id','empty'=>''));
		}

		if ($period_id && ($transit_type == Transittype::BACK || $transit_type == Transittype::TWO_SIDE)) {
			$result['back'] = Buses::getCountPassenger($bus_id, $period_id, Transittype::BACK);
		//	$result['backopt']=CHtml::DropDownList('Tour[period_back_id]','',Period::getBackOptions($bus_id),array('id'=>'Tour_period_back_id','empty'=>''));
		}

		/*$result['there'] =	$there_count_of_plases;
		$result['back']  =	$back_count_of_plases;*/
		print json_encode($result);
	 	Yii::app()->end();
	}
}


		
