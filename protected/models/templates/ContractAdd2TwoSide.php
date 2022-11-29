<?php
class ContractAdd2TwoSide
{
    private $tour;
    public function __construct($id){
        $this->tour = Tour::model()->with('tourists','hotel','resort', 'period', 'resort.country')->findByPk($id);
    }

    public function getValues()    {
        $tour = $this->tour;

        return array(
            '{city}'=>$tour->resort->name,
            '{hotel}'=>$tour->hotel->name,
            '{territory}'=>$tour->hotel->area,
            '{beach}'=> $tour->hotel->beatch,
            '{housing}'=>$tour->hotel->body,
            '{number}'=>$tour->hotel->number,
            '{water}'=>$tour->hotel->water,
            '{food}'=>$tour->hotel->food,
            '{unique_features}'=>$tour->hotel->features,
            '{of_date}'=>$tour->period->date,
            '{upto_date}'=> date('Y-m-d',strtotime($tour->period_back->date)+86400),
            '{upto_date2}'=>$tour->period_back->date,
            '{address_hotel}'=>$tour->hotel->address_of_hotel,
            '{bus_route}' => $tour->buses->route,
            '{note}'=>$tour->hotel->description,
            '{customer_name}'=>$tour->owner_name,
	     '{column_start}'=>'<columns  column-count="2" vAlign="justify" column-gap="5" />',
	    '{column_end}'=>'<columns  column-count="1" vAlign="justify" column-gap="5" />',
	    '{column_break}'=>'<columnbreak />',
	    '{page_break}'=>'<pagebreak />'
        );
    }
    public function getTemplate(){
        $criteria=new CDbCriteria;
        if($this->tour->is_only_transit){
            $criteria->compare('name','contract_addw_TWO_SIDE');
        }else{
            $criteria->compare('name','contract_Add2_TWO_SIDE');
        }
        return Template::model()->find($criteria);
    }
}