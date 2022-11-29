<?php

/**
 * This is the model class for table "{{template}}".
 *
 * The followings are the available columns in table '{{template}}':
 * @property integer $id
 * @property string $name
 * @property string $html
 */
class Template extends CActiveRecord
{
	const C = 'tour';
	//const TOUR = 'tour';

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Template the static model class
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
		return '{{template}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, html', 'required'),
			array('name', 'length', 'max'=>255),
			array('name', 'unique', 'message'=>'Поле {attribute} уже существует'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, html', 'safe', 'on'=>'search'),
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
			//'label' => 'Название',
			'html' => 'Html',
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
		$criteria->compare('html',$this->html,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}