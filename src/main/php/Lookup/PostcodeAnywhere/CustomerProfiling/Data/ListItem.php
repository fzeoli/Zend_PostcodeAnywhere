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
class Lookup_PostcodeAnywhere_CustomerProfiling_Data_ListItem
{
    const   SEGMENTATION = 'Segmentation';
    const   UKPOPULATION = 'UKPopulation';
    const   VARIATION = 'Variation';
    
    private $_strSegmentation;
    private $_intUKpop;
    private $_intVariation;
    
    public function __construct($strSegmentation, $intUKPopulation, $intVariation)
    {
        $this->_strSegmentation = $strSegmentation;
        $this->_intUKpop = $intUKPopulation;
        $this->_intVariation = $intVariation;
    }
    
    public function getSegmentation()
    {
        return $this->_strSegmentation;
    }
    public function getUKPopulation()
    {
        return $this->_intUKpop;
    }
    public function getVariation()
    {
        return $this->_intVariation;
    }
}