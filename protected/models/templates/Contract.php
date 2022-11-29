<?php
class Contract
{
    private $tour;
    public function __construct($id){
        $this->tour = Tour::model()->with('tourists','hotel','resort', 'period', 'resort.country')->findByPk($id);
    }

    public function getValues()    {
        $tour = $this->tour;
	switch($tour->transit){
                    case Transittype::BACK:
                        $of_date=$tour->begin_date;
			$upto_date=date('Y-m-d',strtotime($tour->period_back->date)+86400);
			$upto_date2=$tour->period_back->date;
                        break;
                    case Transittype::THERE:
			$of_date=$tour->period->date;
			$upto_date=date('Y-m-d',strtotime($tour->period->date)+86400*$tour->count_of_day);
			$upto_date2=date('Y-m-d',strtotime($tour->period->date)+86400*$tour->count_of_day);
                        break;
                    case Transittype::TWO_SIDE:
                        $of_date=$tour->period->date;
			$upto_date=date('Y-m-d',strtotime($tour->period_back->date)+86400);
			$upto_date2=$tour->period_back->date;
                        break;
                    case Transittype::NO_TRANSIT:
                        $of_date=$tour->begin_date;
			$upto_date=date('Y-m-d',strtotime($tour->begin_date)+86400*$tour->count_of_day);
			$upto_date2=$tour->period_back->date;
			break;
                }
				if(isset($tour->created))
					$date_create = new DateTime($tour->created);
        $mount_rus = array('01'=>'января','02'=>'февраля','03'=>'марта','04'=>'апреля','05'=>'мая','06'=>'июня','07'=>'июля','08'=>'августа','09'=>'сентября',10=>'октября',11=>'ноября',12=>'декабря',);
        return array(
            '{city}'=>$tour->resort->name,
            '{hotel}'=>$tour->hotel->name,
            /*'create_day'=>$date_create->format('d'),
            'create_month'=>$mount_rus[$date_create->format('m')],
            'create_year'=>$date_create->format('Y'),*/
            '{date1}'=>$date_create->format('d'),
            '{date2}'=>$mount_rus[$date_create->format('m')],
            '{date3}'=>$date_create->format('Y'),
            '{of_date}'=>$of_date,
            '{upto_date}'=>$upto_date,
	    '{upto_date2}'=>$upto_date2,
            '{managers_name}'=>$tour->managers->name,
            '{customer_name}'=>$tour->owner_name,
            '{n_persons}'=>count($tour->tourists)+1,
            '{n_children}'=>$tour->count_of_childs,
            '{age_children}'=>$tour->ages,
            '{travel_service}'=>$tour->travel_service_list,
            '{tour_price}'=>$tour->travel_cost_list,
            '{total_travel_service}'=>$tour->total_travel_service,
            '{total_tour_price}'=>$tour->total_travel_cost,
            '{country}'=>$tour->resort->country->name,
            '{customer_name}'=>$tour->owner_name,
            '{passport_number}'=>$tour->owner_passport,
            '{home_phone}'=>$tour->owner_tel1,
            '{mobile_phone}'=>$tour->owner_tel2,
	    '{column_start}'=>'<columns  column-count="2" vAlign="justify" column-gap="5" />',
	    '{column_end}'=>'<columns  column-count="1" vAlign="justify" column-gap="5" />',
	    '{column_break}'=>'<columnbreak />',
	    '{page_break}'=>'<pagebreak />'
	    
        );

    }
    public function getTemplate(){
        $criteria=new CDbCriteria;
        $criteria->compare('name','contract');
        return Template::model()->find($criteria);
    }
}