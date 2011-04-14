<?php
/**
 * @category   
 * @package    
 * @copyright  2011-04-14 (c) 2011 Campaign and Digital Intelligence (http://canddi.com)
 * @license    
 * @author     Tim Langley
**/

interface Lookup_PostcodeAnywhere_CustomerProfiling_Interface
{
    /**
     *  Lists the Demographic info
     *  @param: AcornType
     *  @param: (optional) IndicatorFilter
     *  @see:   http://www.postcodeanywhere.co.uk/support/webservices/CustomerProfiling/
     *              Interactive/ListDemographicInfo/v1.1/default.aspx
     *
     *  @return: Lookup_PostcodeAnywhere_CustomerProfiling_AcornData
    **/
    public function listDemographicInfo($intAcornType, $strIndicator = null);
    /**
     *  Lists the Lifestyle info
     *  @param: AcornType
     *  @param: (optional) IndicatorFilter
     *  @see:   http://www.postcodeanywhere.co.uk/support/webservices/CustomerProfiling/
     *              Interactive/ListDemographicInfo/v1.1/default.aspx
     *
     *  @return: Lookup_PostcodeAnywhere_CustomerProfiling_AcornData
    **/
    public function listLifestyleInfo($intAcornType, $strIndicator = null);
    /**
     * Returns the ACORN data for the given postcode.
     *
     * @param string $postcode The postcode.
     * @see http://www.postcodeanywhere.co.uk/support/webservices/CustomerProfiling/Interactive/RetrieveByPostcode/v1/default.aspx
     *
     * @return Lookup_PostcodeAnywhere_CustomerProfiling_ACORN The ACORN record.
    **/
    public function retrieveByPostcode($postcode);
}