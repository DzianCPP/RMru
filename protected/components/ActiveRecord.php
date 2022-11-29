<?php 
/**
*	Parent class for all ActiveRecord Entities
*/
class ActiveRecord extends CActiveRecord{

	/**
	* Returns array options name=>name
	*/
	public static function getOptions($key = 'id', $value = 'name', $class = null )
	{
		if (is_null($class )) {
			$class = get_called_class();
		}
		$activeData =  new CActiveDataProvider( $class);
		$options = array();
		foreach ($activeData->getData() as $item) {
		 
		 	$options[$item->$key] = $item->$value;
		}
		
		return $options;
	}
}
 ?>