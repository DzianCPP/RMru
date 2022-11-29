<?php

/**
 * This is the model class for table "{{tour}}".
 *
 * The followings are the available columns in table '{{tour}}':
 * @property integer $id
 * @property string $created
 * @property string $manager
 * @property integer $is_only_transit
 * @property string $transit
 * @property string $resorts
 * @property integer $period
 * @property integer $count_of_day
 * @property string $bus
 * @property string $owner_name
 * @property string $owner_tel1
 * @property string $owner_tel2
 * @property string $owner_passport
 * @property string $owner_birthday
 * @property integer $owner_travel_service
 * @property integer $owner_travel_cost
 * @property integer $count_of_childs
 * @property string $ages
 * @property integer $total_travel_service
 * @property integer $total_travel_cost
 *
 * The followings are the available model relations:
 * @property Managers $manager0
 * @property Resorts $resorts0
 * @property Buses $bus0
 * @property Period $period0
 */
class Tour extends CActiveRecord
{
	
	private $_count_piple;
	public function getCountPiple()	{

		if(!isset($this->_count_piple)){
			$this->_count_piple = count($this->tourists)  + 1;
		}
		return $this->_count_piple;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Tour the static model class
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
		return '{{tour}}';
	}

    public function behaviors()
    {
        return array(
            'withRelated'=>array(
                'class'=>'WithRelatedBehavior',
            ),
        );
    }

	protected function beforeSave()
	{	
		$result =  parent::beforeSave();
        switch($this->transit){
            case Transittype::BACK:
                if(isset($this->period_id)){
                    $this->period_id = null;
                    $this->bus=null;
                }
                break;
            case Transittype::THERE:
                if(isset($this->back_period_id)){
                    $this->back_period_id = null;
                    $this->bus_back=null;
                }
                break;
            case Transittype::NO_TRANSIT:
                if(isset($this->period_id)){
                    $this->period_id = null;
                    $this->bus=null;
                }
                if(isset($this->back_period_id)){
                    $this->back_period_id = null;
                    $this->bus_back=null;
                }
                break;

        }
        return $result;
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(

			array('created, manager_id, transit, resort_id,  owner_name, owner_tel1,  owner_passport, owner_birthday, owner_travel_service, owner_travel_cost, total_travel_service, total_travel_cost', 'required', 'message'=>'это поле обязательно к заполнению'),
			array('is_only_transit,resort_id, period_id,period_back_id,hotel_id, count_of_day, owner_travel_service, owner_travel_cost, count_of_childs, total_travel_service, total_travel_cost', 'numerical', 'integerOnly'=>true, 'message'=>'это поле должно быть числовым'),
			array('manager_id,  bus,bus_back, ages', 'length', 'max'=>255),
            array('period_id,period_back_id,begin_date', 'safe'),
			array('transit', 'length', 'max'=>100),
			array('owner_name, owner_passport', 'length', 'max'=>1000, 'tooLong'=>'Поле {attribute} слишком длинное'),
			array('owner_tel1, owner_tel2', 'length', 'max'=>20,  'tooLong'=>'Поле {attribute} слишком длинное'),
			
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.

			array('id, created, hotel_id,resort_id,begin_date, manager_id,period_back_id, is_only_transit, transit, period_id, count_of_day, bus, owner_name, owner_tel1, owner_tel2, owner_passport, owner_birthday, owner_travel_service, owner_travel_cost, count_of_childs, ages, total_travel_service, total_travel_cost', 'safe', 'on'=>'search'),

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
			'managers' => array(self::BELONGS_TO, 'Managers', 'manager_id'),
			'resort' => array(self::BELONGS_TO, 'Resorts', 'resort_id'),
			'buses' => array(self::BELONGS_TO, 'Buses', 'bus'),
			'buses_back' => array(self::BELONGS_TO, 'Buses', 'bus_back'),
			'period' => array(self::BELONGS_TO, 'Period', 'period_id'),
			'period_back' => array(self::BELONGS_TO, 'Period', 'period_back_id'),
			'hotel' => array(self::BELONGS_TO, 'Hotels', 'hotel_id'),
			'tourists' => array(self::HAS_MANY, 'Tourist', 'owner_id' ),
		);
	}

	

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'created' => 'Дата создания',
			'manager_id' => 'Менеджер',
			'is_only_transit' => 'Только проезд',
			'transit' => 'Проезд',
			'resort_id' => 'Курорт',
			'hotel_id' => 'Гостиница',
			'period_id' => 'Выезд из Минска',
			'period_back_id' => 'Выезд из курорта',
			'begin_date' => 'Начало',
			'count_of_day' => 'Кол-во дней',
			'bus' => 'Автобус',
			'bus_back' => 'Обратный автобус',
			'owner_name' => 'Ф.И.О.',
			'owner_tel1' => 'Телефон 1',
			'owner_tel2' => 'Телефон 2',
			'owner_passport' => 'Пасспорт',
			'owner_birthday' => 'День рождения',
			'owner_travel_service' => 'Тур услуга',
			'owner_travel_cost' => 'Стоимость тура',
			'count_of_childs' => 'Кол-во детей(если нет то "0")',
			'ages' => 'Возраст, через запятую(если нет то "-")',
			'total_travel_service' => 'Итого тур услуга',
			'total_travel_cost' => 'Итого стоимость',
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
		if($this->owner_name){
		$criteria->select='t.*';
		$criteria->join='LEFT JOIN trv_tourists tr ON t.id = tr.owner_id';
		$criteria->group='tr.owner_id';
		$criteria->compare('owner_name',$this->owner_name,true);
		$criteria->compare('tr.name',$this->owner_name,true, 'OR');
		
		}
		$criteria->compare('id',$this->id);
		$criteria->compare('created',$this->created);
		$criteria->compare('manager_id',$this->manager_id);
		$criteria->compare('is_only_transit',$this->is_only_transit);
		$criteria->compare('transit',$this->transit);
		$criteria->compare('hotel_id',$this->hotel_id);
		$criteria->compare('resort_id',$this->resort_id);
		$criteria->compare('period_id',$this->period_id);
		$criteria->compare('period_back_id',$this->period_back_id);
		$criteria->compare('begin_date',$this->begin_date);
		$criteria->compare('count_of_day',$this->count_of_day);
		$criteria->compare('bus',$this->bus);
		$criteria->compare('bus_back',$this->bus_back);
		$criteria->compare('owner_tel1',$this->owner_tel1,true);
		$criteria->compare('owner_tel2',$this->owner_tel2,true);
		$criteria->compare('owner_passport',$this->owner_passport,true);
		$criteria->compare('owner_birthday',$this->owner_birthday);
		$criteria->compare('owner_travel_service',$this->owner_travel_service);
		$criteria->compare('owner_travel_cost',$this->owner_travel_cost);
		$criteria->compare('count_of_childs',$this->count_of_childs);
		$criteria->compare('ages',$this->ages);
		$criteria->compare('total_travel_service',$this->total_travel_service);
		$criteria->compare('total_travel_cost',$this->total_travel_cost);
		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function beforeDelete() {
	    parent::beforeDelete();
	    Tourist::model()->deleteAllByAttributes(array('owner_id'=>$this->id));
	    return true;
	}
	public function getTransit_name()
	{
	$labels = Transittype::getOptions();
	return $labels[$this->transit];
	}
    public function getTravel_service_list(){
        $str=$this->owner_travel_service;
        if(isset($this->tourists))
        foreach ($this->tourists as $t) {
            $str.='+'.$t->travel_service;
            
        }
        return $str;
    }
    public function getTravel_cost_list(){
          $str=$this->owner_travel_cost;
        if(isset($this->tourists))
        foreach ($this->tourists as $t) {
            $str.='+'.$t->travel_cost;
            
        }
        return $str;
    }
    
}