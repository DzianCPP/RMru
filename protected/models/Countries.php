<?php

/**
 * This is the model class for table "{{countries}}".
 *
 * The followings are the available columns in table '{{countries}}':
 * @property integer $id
 * @property string $name
 * @property integer $is_active
 */
class Countries extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Countries the static model class
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
		return '{{countries}}';
	}

	/**
	* Returns array options name=>name
	*/
	public static function getOptions()
	{
		$activeData = Countries::model()->findAll();
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
			//array('is_active', 'numerical', 'integerOnly'=>true),
            array('name', 'required', 'message'=>'Поле {attribute} не должно быть пустым'),
			array('name', 'length', 'max'=>64, 'tooLong'=>'Поле {attribute} слижком длинное.'),
            array('name', 'unique', 'message'=>'Такое поле  {attribute} уже существует.'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, is_active', 'safe', 'on'=>'search'),
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
			'is_active' => 'Активен',
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
		$criteria->compare('is_active',$this->is_active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function beforeDelete() {
	    parent::beforeDelete();
	    Resorts::model()->deleteAllByAttributes(array('country_id'=>$this->id));
	    return true;
	}
}