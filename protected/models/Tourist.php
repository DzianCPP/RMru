<?php

/**
 * This is the model class for table "{{tourists}}".
 *
 * The followings are the available columns in table '{{tourists}}':
 * @property integer $id
 * @property integer $owner_id
 * @property string $name
 * @property string $passport
 * @property string $birthday
 * @property integer $travel_service
 * @property integer $travel_cost
 *
 * The followings are the available model relations:
 * @property Tour $owner
 */
class Tourist extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Tourist the static model class
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
		return '{{tourists}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array(' name, passport, birthday, travel_service, travel_cost', 'required'),
			array('owner_id, travel_service, travel_cost', 'numerical', 'integerOnly'=>true),
			array('name, passport', 'length', 'max'=>1000),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, owner_id, name, passport, birthday, travel_service, travel_cost', 'safe'),
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
			'owner' => array(self::BELONGS_TO, 'Tour', 'owner_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'owner_id' => 'Owner',
			'name' => 'Ф.И.О.',
			'passport' => 'Пасспорт',
			'birthday' => 'День Рождения',
			'travel_service' => 'туристическая услуга',
			'travel_cost' => 'стоимость',
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
		$criteria->compare('owner_id',$this->owner_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('passport',$this->passport,true);
		$criteria->compare('birthday',$this->birthday,true);
		$criteria->compare('travel_service',$this->travel_service);
		$criteria->compare('travel_cost',$this->travel_cost);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}