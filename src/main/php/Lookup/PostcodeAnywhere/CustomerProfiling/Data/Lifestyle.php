<?php
/**
 * @category   
 * @package    
 * @copyright  2011-04-09 (c) 2011 Campaign and Digital Intelligence (http://canddi.com)
 * @license    
 * @author     Tim Langley
**/

/**
 * Model class for the data returned by the interactive API.
**/
class Lookup_PostcodeAnywhere_CustomerProfiling_Data_Lifestyle
{
    const   INDICATOR_CHARATIES = 'Prefered charities';
    const   INDICATOR_MORTGAGES = 'Mortgages';
    const   INDICATOR_INSURANCE = 'Insurance';
    const   INDICATOR_SAVINGS = 'Savings & investments';
    const   INDICATOR_CREDIT_CARDS = 'Credit Cards';
    const   INDICATOR_SHOPPING = 'Shopping';
    const   INDICATOR_SHOPPING_FOOD = 'Weekly food shopping';
    const   INDICATOR_HOLIDAYS = 'Holidays';
    const   INDICATOR_INCOME = 'Income';
    const   INDICATOR_INTERESTS = 'Interests & hobbies';
    const   INDICATOR_AUTOMOTIVE = 'Automotive';
    const   INDICATOR_PRESS = 'Press';
    const   INDICATOR_COMPUTING = 'Computing & Internet';
    const   INDICATOR_ELECTRICAL = 'Electrical Goods';
    const   INDICATOR_TELEPHONE = 'Telephone';
    const   INDICATOR_EATING_OUT = 'Eating Out';
    const   INDICATOR_SWITCHERS = 'Switchers';
    
    public static $Indicators = array( self::INDICATOR_CHARATIES
                                     , self::INDICATOR_MORTGAGES
                                     , self::INDICATOR_INSURANCE
                                     , self::INDICATOR_SAVINGS
                                     , self::INDICATOR_CREDIT_CARDS
                                     , self::INDICATOR_SHOPPING
                                     , self::INDICATOR_SHOPPING_FOOD
                                     , self::INDICATOR_HOLIDAYS
                                     , self::INDICATOR_INCOME
                                     , self::INDICATOR_INTERESTS
                                     , self::INDICATOR_AUTOMOTIVE
                                     , self::INDICATOR_PRESS
                                     , self::INDICATOR_COMPUTING
                                     , self::INDICATOR_ELECTRICAL
                                     , self::INDICATOR_TELEPHONE
                                     , self::INDICATOR_EATING_OUT
                                     , self::INDICATOR_SWITCHERS);
    
    private $_data;

    /**
     * Creates a new ACORN model.
     *
     * @param array $data The model data.
     * @throws Lookup_PostcodeAnywhere_CustomerProfiling_Exception
    **/
    public function __construct(array $data)
    {
//@TODO - rather than being an array - I'd like this to be some kind of iterator?
        foreach($data AS $arrItem):
            $this->_data[$arrItem["Indicator"]][] = 
                new Lookup_PostcodeAnywhere_CustomerProfiling_Data_ListItem(
                     $arrItem[Lookup_PostcodeAnywhere_CustomerProfiling_Data_ListItem::SEGMENTATION]
                    ,$arrItem[Lookup_PostcodeAnywhere_CustomerProfiling_Data_ListItem::UKPOPULATION]
                    ,$arrItem[Lookup_PostcodeAnywhere_CustomerProfiling_Data_ListItem::VARIATION]);
        endforeach;
    }
    
    public function getAutomotive()
    {
        return isset($this->_data[self::INDICATOR_AUTOMOTIVE])
                    ?$this->_data[self::INDICATOR_AUTOMOTIVE]
                    :null;
    }
    public function getCharities()
    {
        return isset($this->_data[self::INDICATOR_CHARATIES])
                    ?$this->_data[self::INDICATOR_CHARATIES]
                    :null;
    }
    public function getComputing()
    {
        return isset($this->_data[self::INDICATOR_COMPUTING])
                    ?$this->_data[self::INDICATOR_COMPUTING]
                    :null;
    }
    public function getCreditCards()
    {
        return isset($this->_data[self::INDICATOR_CREDIT_CARDS])
                    ?$this->_data[self::INDICATOR_CREDIT_CARDS]
                    :null;
    }
    public function getEatingOut()
    {
        return isset($this->_data[self::INDICATOR_EATING_OUT])
                    ?$this->_data[self::INDICATOR_EATING_OUT]
                    :null;
    }
    public function getElectrical()
    {
        return isset($this->_data[self::INDICATOR_ELECTRICAL])
                    ?$this->_data[self::INDICATOR_ELECTRICAL]
                    :null;
    }
    public function getHolidays()
    {
        return isset($this->_data[self::INDICATOR_HOLIDAYS])
                    ?$this->_data[self::INDICATOR_HOLIDAYS]
                    :null;
    }
    public function getIncome()
    {
        return isset($this->_data[self::INDICATOR_INCOME])
                    ?$this->_data[self::INDICATOR_INCOME]
                    :null;
    }
    public function getInsurance()
    {
        return isset($this->_data[self::INDICATOR_INSURANCE])
                    ?$this->_data[self::INDICATOR_INSURANCE]
                    :null;
    }
    public function getInterests()
    {
        return isset($this->_data[self::INDICATOR_INTERESTS])
                    ?$this->_data[self::INDICATOR_INTERESTS]
                    :null;
    }
    public function getMortages()
    {
        return isset($this->_data[self::INDICATOR_MORTGAGES])
                    ?$this->_data[self::INDICATOR_MORTGAGES]
                    :null;
    }
    public function getPress()
    {
        return isset($this->_data[self::INDICATOR_PRESS])
                    ?$this->_data[self::INDICATOR_PRESS]
                    :null;
    }
    public function getSavings()
    {
        return isset($this->_data[self::INDICATOR_SAVINGS])
                    ?$this->_data[self::INDICATOR_SAVINGS]
                    :null;
    }
    public function getShopping()
    {
        return isset($this->_data[self::INDICATOR_SHOPPING])
                    ?$this->_data[self::INDICATOR_SHOPPING]
                    :null;
    }
    public function getShoppingFood()
    {
        return isset($this->_data[self::INDICATOR_SHOPPING_FOOD])
                    ?$this->_data[self::INDICATOR_SHOPPING_FOOD]
                    :null;
    }
    public function getSwitchers()
    {
        return isset($this->_data[self::INDICATOR_SWITCHERS])
                    ?$this->_data[self::INDICATOR_SWITCHERS]
                    :null;
    }
    public function getTelephone()
    {
        return isset($this->_data[self::INDICATOR_TELEPHONE])
                    ?$this->_data[self::INDICATOR_TELEPHONE]
                    :null;
    }
}