<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class ListTourist extends CFormModel
{
	public $bus_id;
	public $period_id;
	public $period_back_id;
	public $transit_type;

	private $bus;
	private $period;
	private $back_period;
	public function getBus(){
		if(!isset($bus)){
			$this->bus = Buses::model()->findByPk($this->bus_id);
		}
		return $this->bus;
	}
	public function getPeriod(){
		if(!isset($period)){
			$this->period = Period::model()->findByPk($this->period_id);
		}
		return $this->period;
	}
	public function getBackPeriod()	{
		if(!isset($back_period)){
			$this->back_period = Period::model()->findByPk($this->period_back_id);
		}
		return $this->back_period;
	}
	public function getThereDate(){
		return $this->getPeriod()->date;
	}
	public function getBackDate(){
		return $this->getBackPeriod()->date;
	}
	public function getThereRoute(){
		return $this->getBus()->getRoute();
	}
	public function getBackRoute(){
		return $this->getBus()->getBackRoute();
	}

	

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('bus_id, period_id, period_back_id, transit_type','required'),
		
		
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'bus_id'=>'Автобус',
			'period_id'=>'Дата',
			'period_back_id'=>'Дата',
			'transit_type'=>'Тип проезда',
		);
	}
	/**
	* Search 
	*/
	public function search()
	{
		
		$criteria=new CDbCriteria;

		
		if($this->transit_type == Transittype::THERE){
		$criteria->compare('bus',$this->bus_id);
		$criteria->addCondition('period_id='.$this->period_id);
        	$criteria->compare('transit',array(Transittype::THERE, Transittype::TWO_SIDE ));
		
		}
		if($this->transit_type == Transittype::BACK){
		    $criteria->compare('bus_back',$this->bus_id);
			$criteria->addCondition('period_back_id='.$this->period_back_id);
        	$criteria->compare('transit', array(Transittype::BACK, Transittype::TWO_SIDE ));
		}
		//$criteria->addInCondition('transit',array($this->transit_type, 1));
			
		$criteria->order='resort_id ASC, owner_name ASC';
        
		$tours = Tour::model()->findAll($criteria);
		

		$result = array();
		$counter = 0;
		foreach ($tours as $tour) {
			$r = array();
			$r['id'] = ++$counter;
			$r['name'] = $tour->owner_name;
			$r['resort'] = $tour->resort->name;
			$r['birthday'] = $tour->owner_birthday;
			$r['passport'] = $tour->owner_passport;
			$result[] = $r;
			foreach ($tour->tourists as $tourist) {
				$r = array();
				$r['id'] = ++$counter;
				$r['name'] = $tourist->name;
				$r['resort'] = $tour->resort->name;
				$r['birthday'] = $tourist->birthday;
				$r['passport'] = $tourist->passport;
				$result[] = $r;
			}
		}
		$data=new CArrayDataProvider($result);
		$data->pagination->pageSize=100;
		return $data;
		
	}
}
