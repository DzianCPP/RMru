<?php

/**
 * This is the model class for table "{{resorts}}".
 *
 * The followings are the available columns in table '{{resorts}}':
 * @property integer $id
 * @property string $name
 * @property string $country
 * @property integer $is_active
 *
 * The followings are the available model relations:
 * @property Hotels[] $hotels
 */
class Resorts extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Resorts the static model class
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
		return '{{resorts}}';
	}

	/**
	* Returns array options name=>name
	*/
	public static function getOptions()
	{
		$activeData = Resorts::model()->findAll();
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
			array('name, country_id', 'required', 'message'=>'Поле {attribute} обязательно к заполнению'),
			//array('is_active, country_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>500, 'tooLong'=>'Поле {attribute} слишком длинное'),
			array('name', 'unique', 'message'=>'Поле {attribute} уже существует'),
			//array('country_id', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, country_id, is_active', 'safe', 'on'=>'search'),
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
			'hotels' => array(self::HAS_MANY, 'Hotels', 'resorts_id'),
			'country' =>array(self::BELONGS_TO, 'Countries', 'country_id'),
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
			'country_id' => 'Страна',
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
		$criteria->compare('country_id',$this->country_id,true);
		$criteria->compare('is_active',$this->is_active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function beforeDelete() {
	    parent::beforeDelete();
	    Tour::model()->deleteAllByAttributes(array('resort_id'=>$this->id));
	    Hotels::model()->deleteAllByAttributes(array('resorts_id'=>$this->id));
	    return true;
	}
}