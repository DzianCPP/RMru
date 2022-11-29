<?php 
class Transittype
{
	const THERE = 2;
	const BACK = 3;
	const TWO_SIDE = 1;
	const NO_TRANSIT = 4;

	public static function getOptions()
	{
		return array(
			'1' => 'В обе стороны',
			'2' => 'Туда',
			'3' => 'Назад',
			'4' => 'Без проезда',
			);
	}
	public static function getShortListOptions()
	{
		return array(
			//'1' => 'В обе стороны',
			'2' => 'Туда',
			'3' => 'Назад',
			//'4' => 'Без проезда',
			);
	}

	/*public static function getLabel($value)
	{
		$options = self::getOptions();
		return $options[$value];
	}*/
}