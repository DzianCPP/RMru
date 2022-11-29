<?php

/**
 * This is the model class for table "{{hotels}}".
 *
 * The followings are the available columns in table '{{hotels}}':
 * @property integer $id
 * @property string $name
 * @property integer $resorts_id
 * @property string $address_of_hotel
 * @property string $area
 * @property string $beatch
 * @property string $body
 * @property string $number
 * @property string $water
 * @property string $food
 * @property string $features
 * @property string $description
 * @property integer $is_active
 *
 * The followings are the available model relations:
 * @property Resorts $resorts
 */
class Hotels extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Hotels the static model class
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
		return '{{hotels}}';
	}


	/**
	* Returns array options id=>name
	*/
	public static function getOptions()
	{
		$activeData = Hotels::model()->findAll();
		$options = array();
		foreach ($activeData as $item) {
		 
		 	$options[$item->id] = $item->name;
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
			array('name, resorts_id', 'required','message'=>'Поле {attribute} обязательно к заполнению'),
			array('resorts_id, is_active', 'numerical', 'integerOnly'=>true, 'message'=>'Поле {attribute} является целым числовым типом'),
			array('name', 'unique', 'message'=>'Поле {attribute} уже существует'),
			array('name, address_of_hotel, area, beatch, body, number, water, food, features, description', 'length', 'max'=>3100,'tooLong'=>'Поле {attribute} слишком длинное'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, resorts_id, address_of_hotel, area, beatch, body, number, water, food, features, description, is_active', 'safe', 'on'=>'search'),
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
			'resorts' => array(self::BELONGS_TO, 'Resorts', 'resorts_id'),
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
			'resorts_id' => 'Название курорта',
			'address_of_hotel' => 'Адрес проживания',
			'area' => 'Територия',
			'beatch' => 'Пляж',
			'body' => 'Корпуса',
			'number' => 'Номер',
			'water' => 'Вода',
			'food' => 'Питание',
			'features' => 'Отличительные особенности',
			'description' => 'Примечание',
			'is_active' => 'Is Active',
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
		$criteria->compare('resorts_id',$this->resorts_id);
		$criteria->compare('address_of_hotel',$this->address_of_hotel,true);
		$criteria->compare('area',$this->area,true);
		$criteria->compare('beatch',$this->beatch,true);
		$criteria->compare('body',$this->body,true);
		$criteria->compare('number',$this->number,true);
		$criteria->compare('water',$this->water,true);
		$criteria->compare('food',$this->food,true);
		$criteria->compare('features',$this->features,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('is_active',$this->is_active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function beforeDelete() {
	    parent::beforeDelete();
	    Tour::model()->deleteAllByAttributes(array('hotel_id'=>$this->id));
	    return true;
	}
}