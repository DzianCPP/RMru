<?php

/**
 * This is the model class for table "{{period}}".
 *
 * The followings are the available columns in table '{{period}}':
 * @property integer $id
 * @property string $date
 */
class Period extends ActiveRecord
{
	//const DAYS_IN_PERIOD = 7;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Period the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{period}}';
	}

	public static function getOptions($bus_id=null,$date_start=null,$date_to=null)	{
		$activeData =  new CActiveDataProvider( 'Period');
		
		if($date_start){
		    if($date_start<12)
            {
             $date_to2=(date('Y')+1).'-0'.($date_start+1).'-01';
             $date_to=date('Y').'-'.($date_start+1).'-01';
			 
            }
            else{
            $date_to=(date('Y')+1).'-01-01';
			$date_to2=(date('Y')+2).'-01-01';
            }
			$date_start2=(date('Y')+1).'-'.$date_start.'-01';
		    $date_start=date('Y').'-'.$date_start.'-01';
			
			//var_dump($date_to2);
			//die();
		  //  $activeData->criteria->addCondition(" (t.date<=".$date_to." AND t.date>=".$date_start.")");
		    $activeData->criteria->addBetweenCondition('date',$date_start,$date_to);
			$activeData->criteria->addBetweenCondition('date',$date_start2,$date_to2,'OR');
		    
		}
		$activeData->criteria->addCondition('transit_type='.Transittype::THERE);
		if($bus_id)
		$activeData->criteria->addCondition('bus_id='.$bus_id);
		//CVarDumper::dump($activeData->criteria); 
		$activeData->pagination->pageSize=100;
		$options = array();
		foreach ($activeData->getData() as $item) {
		 	$options[$item->id] = $item->date;
		}
		return $options;
	}
	public static function getBackOptions($bus_id=null,$date_start=null,$date_to=null)	{
		
		$activeData =  new CActiveDataProvider('Period');
		
		if($date_to){
			$date_start2=(date('Y')+1).'-'.$date_to.'-01';
		    $date_start=date('Y').'-'.$date_to.'-01';
		     if($date_to<12)
		    {
		     $date_to2=(date('Y')+1).'-'.($date_to+1).'-01';
		     $date_to=date('Y').'-'.($date_to+1).'-01';
		    }
		    else{
		   	$date_to2=(date('Y')+2).'-01-01';
			$date_to=(date('Y')+1).'-01-01';
		    }
		    $activeData->criteria->addBetweenCondition('date',$date_start,$date_to);
			$activeData->criteria->addBetweenCondition('date',$date_start2,$date_to2,'OR');
		    //CVarDumper::dump($activeData->criteria);
		}
		$activeData->criteria->addCondition('transit_type='.Transittype::BACK);
		if($bus_id)
		$activeData->criteria->addCondition('bus_id='.$bus_id);
		$activeData->pagination->pageSize=100;
		$options = array();
		foreach ($activeData->getData() as $item) {
		 
		 	$options[$item->id] = $item->date;
		}
		
		return $options;
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date, bus_id, transit_type', 'required', 'message'=>'Поле {attribute} обязательно к заполнению'),
            array('date', 'date', 'format'=> 'yyyy-mm-dd'),

			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, date, bus_id, transit_type', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'bus' => array(self::BELONGS_TO, 'Buses', 'bus_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'date' => 'Дата',
			'bus_id' => 'Автобус',
			'transit_type' => 'Направление',

		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('bus_id',$this->bus_id);
		$criteria->compare('transit_type',$this->transit_type);


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function getTransit_type_name()
	{
	$labels = Transittype::getShortListOptions();
	return $labels[$this->transit_type];
	}
    public function beforeDelete() {
        parent::beforeDelete();
        Tour::model()->deleteAllByAttributes(array('period_id'=>$this->id));
        Tour::model()->deleteAllByAttributes(array('period_back_id'=>$this->id));
        return true;
    }
}