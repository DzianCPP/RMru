<?php

/**
 * This is the model class for table "{{buses}}".
 *
 * The followings are the available columns in table '{{buses}}':
 * @property integer $id
 * @property string $name
 * @property string $route
 * @property integer $count_of_plases
 * @property string $departure_with_minsk
 * @property string $departure_with_resort
 * @property string $arrival_in_minsk
 *
 */
class Buses extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Buses the static model class
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

		return '{{buses}}';
	}

	public static function getOptions($key = 'id', $value = 'name', $class = null )
	{
$activeData = Buses::model()->findAll();
		$options = array();
		foreach ($activeData as $item) {
		 
		 	$options[$item->id] = $item->name . " " . $item->route;
		}
		
		return $options;
	}
	public static function getBuses()
	{
		
		$activeData = Buses::model()->findAll();
		$options = array();
		foreach ($activeData as $item) {
		 
		 	$options[$item->id] = $item->name . " " . $item->route;
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
			array('name, route, count_of_plases', 'required', 'message'=>'Поле {attribute} обязательно к заполнению'),
			array('count_of_plases', 'numerical', 'integerOnly'=>true, 'message'=> 'Поле {attribute} может быть только числом'),
			array('name', 'length', 'max'=>64, 'tooLong'=>'Поле {attribute} слишком длинное'),
			array('name', 'unique', 'message'=>'Поле {attribute} уже существует'),
			array('route, departure_with_minsk, departure_with_resort, arrival_in_minsk', 'length', 'max'=>1024, 'tooLong'=>'Поле {attribute} слишком длинное'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, route, count_of_plases, departure_with_minsk, departure_with_resort, arrival_in_minsk', 'safe', 'on'=>'search'),
		);
	}
	public function getRoute()	{
		return $this->route;
	}
	public function getBackRoute($separator = '-'){
		
		return implode($separator, array_reverse(explode($separator, $this->route)));

	}
	public static function getCountPassenger($bus_id,$period_id, $transit_type){
        if(!$period_id||!$bus_id||!$transit_type){
			return 0;
		}
		$model=new ListTourist('Search');
		
		$model->bus_id=$bus_id;
		$model->transit_type=$transit_type;
		$model->period_id=$period_id;
		$model->period_back_id=$period_id;
		$data=$model->search();


        return Buses::model()->findByPk($bus_id)->count_of_plases  - $data->itemCount;

	}
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'tours'=>array(self::HAS_MANY, 'Tour', 'bus'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Название',
			'route' => 'Маршрут',
			'count_of_plases' => 'Кол-во мест',
			'departure_with_minsk' => 'Отправление с Минска',
			'departure_with_resort' => 'Отправление в Минск',
			'arrival_in_minsk' => 'Прибытие в Минск',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('route',$this->route,true);
		$criteria->compare('count_of_plases',$this->count_of_plases);
		$criteria->compare('departure_with_minsk',$this->departure_with_minsk,true);
		$criteria->compare('departure_with_resort',$this->departure_with_resort,true);
		$criteria->compare('arrival_in_minsk',$this->arrival_in_minsk,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function beforeDelete() {
	    parent::beforeDelete();
	    Period::model()->deleteAllByAttributes(array('bus_id'=>$this->id));
	    Tour::model()->deleteAllByAttributes(array('bus'=>$this->id));
	    return true;
	}
}