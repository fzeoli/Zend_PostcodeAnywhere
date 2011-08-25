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
class Lookup_PostcodeAnywhere_CustomerProfiling_Data_Demographic
{
    const   INDICATOR_AGE = 'Age';
    const   INDICATOR_ETHNIC = 'Ethnicity';
    const   INDICATOR_RELIGION = 'Religion';
    const   INDICATOR_WORKING = 'Working Status';
    const   INDICATOR_INDUSTRY = 'Industry';
    const   INDICATOR_EDUCATION = 'Educational qualifications';
    const   INDICATOR_SOCIO = 'Socio-ecomonic classification';
    const   INDICATOR_TRAVEL_TO_WORK = 'Travel to Work';
    const   INDICATOR_HOUSE_TYPE = 'House Type';
    const   INDICATOR_CAR_OWNERSHIP = 'Car ownership';
    const   INDICATOR_TENURE = 'Tenure';
    const   INDICATOR_DWELLING_HEIGHT = 'Dwelling Height';
    const   INDICATOR_DWELLING_SIZE = 'Dwelling size';
    const   INDICATOR_DENSITY = 'Density measures';
    const   INDICATOR_HOUSEHOLD_SIZE = 'Household size';
    const   INDICATOR_HOUSEHOLD_STRUCTURE = 'Household Structure';
    
    public static $Indicators = array( self::INDICATOR_AGE
                                     , self::INDICATOR_ETHNIC
                                     , self::INDICATOR_RELIGION
                                     , self::INDICATOR_WORKING
                                     , self::INDICATOR_INDUSTRY
                                     , self::INDICATOR_EDUCATION
                                     , self::INDICATOR_SOCIO
                                     , self::INDICATOR_TRAVEL_TO_WORK
                                     , self::INDICATOR_HOUSE_TYPE
                                     , self::INDICATOR_CAR_OWNERSHIP
                                     , self::INDICATOR_TENURE
                                     , self::INDICATOR_DWELLING_HEIGHT
                                     , self::INDICATOR_DWELLING_SIZE
                                     , self::INDICATOR_DENSITY
                                     , self::INDICATOR_HOUSEHOLD_SIZE
                                     , self::INDICATOR_HOUSEHOLD_STRUCTURE);
    
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
                     isset($arrItem[Lookup_PostcodeAnywhere_CustomerProfiling_Data_ListItem::SEGMENTATION])?
                           $arrItem[Lookup_PostcodeAnywhere_CustomerProfiling_Data_ListItem::SEGMENTATION]:null
                    ,isset($arrItem[Lookup_PostcodeAnywhere_CustomerProfiling_Data_ListItem::UKPOPULATION])?
                           $arrItem[Lookup_PostcodeAnywhere_CustomerProfiling_Data_ListItem::UKPOPULATION]:null
                    ,isset($arrItem[Lookup_PostcodeAnywhere_CustomerProfiling_Data_ListItem::VARIATION])?
                           $arrItem[Lookup_PostcodeAnywhere_CustomerProfiling_Data_ListItem::VARIATION]:null);
        endforeach;
    }
    
    public function getAge()
    {
        return isset($this->_data[self::INDICATOR_AGE])
                    ?$this->_data[self::INDICATOR_AGE]
                    :null;
    }
    public function getCarOwnership()
    {
        return isset($this->_data[self::INDICATOR_CAR_OWNERSHIP])
                    ?$this->_data[self::INDICATOR_CAR_OWNERSHIP]
                    :null;
    }
    public function getDensity()
    {
        return isset($this->_data[self::INDICATOR_DENSITY])
                    ?$this->_data[self::INDICATOR_DENSITY]
                    :null;
    }
    public function getDwellingHeight()
    {
        return isset($this->_data[self::INDICATOR_DWELLING_HEIGHT])
                    ?$this->_data[self::INDICATOR_DWELLING_HEIGHT]
                    :null;
    }
    public function getDwellingSize()
    {
        return isset($this->_data[self::INDICATOR_DWELLING_SIZE])
                    ?$this->_data[self::INDICATOR_DWELLING_SIZE]
                    :null;
    }
    public function getEducation()
    {
        return isset($this->_data[self::INDICATOR_EDUCATION])
                    ?$this->_data[self::INDICATOR_EDUCATION]
                    :null;
    }
    public function getEthnicity()
    {
        return isset($this->_data[self::INDICATOR_ETHNIC])
                    ?$this->_data[self::INDICATOR_ETHNIC]
                    :null;
    }
    public function getHouseholdSize()
    {
        return isset($this->_data[self::INDICATOR_HOUSEHOLD_SIZE])
                    ?$this->_data[self::INDICATOR_HOUSEHOLD_SIZE]
                    :null;
    }
    public function getHouseholdStructure()
    {
        return isset($this->_data[self::INDICATOR_HOUSEHOLD_STRUCTURE])
                    ?$this->_data[self::INDICATOR_HOUSEHOLD_STRUCTURE]
                    :null;
    }
    public function getHouseType()
    {
        return isset($this->_data[self::INDICATOR_HOUSE_TYPE])
                    ?$this->_data[self::INDICATOR_HOUSE_TYPE]
                    :null;
    }
    public function getIndustry()
    {
        return isset($this->_data[self::INDICATOR_INDUSTRY])
                    ?$this->_data[self::INDICATOR_INDUSTRY]
                    :null;
    }
    public function getReligion()
    {
        return isset($this->_data[self::INDICATOR_RELIGION])
                    ?$this->_data[self::INDICATOR_RELIGION]
                    :null;
    }
    public function getSocio()
    {
        return isset($this->_data[self::INDICATOR_SOCIO])
                    ?$this->_data[self::INDICATOR_SOCIO]
                    :null;
    }
    public function getTenure()
    {
        return isset($this->_data[self::INDICATOR_TENURE])
                    ?$this->_data[self::INDICATOR_TENURE]
                    :null;
    }
    public function getTravelToWork()
    {
        return isset($this->_data[self::INDICATOR_TRAVEL_TO_WORK])
                    ?$this->_data[self::INDICATOR_TRAVEL_TO_WORK]
                    :null;
    }
    public function getWorkingStatus()
    {
        return isset($this->_data[self::INDICATOR_WORKING])
                    ?$this->_data[self::INDICATOR_WORKING]
                    :null;
    }
}