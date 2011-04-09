<?php
/**
 * PostcodeAnywhere
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://github.com/canddi/Zend_RabbitMQ/blob/master/LICENSE.txt
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to hello@canddi.com so we can send you a copy immediately.
 *
**/

/**
 * Library class to interact with PostcodeAnywhere's customer profiling
 * interactive API.
**/
class Lookup_PostcodeAnywhere_CustomerProfiling_Interactive
{

    private $_apiKey;

    /**
     * @var Zend_Http_Client
    **/
    private $_client;
    /*
     * TODO: Maybe this should be refactored if more API methods are
     * implemented.
    **/
    const BASE_URL =
        'http://services.postcodeanywhere.co.uk/CustomerProfiling/Interactive';

    const LIST_DEMOGRAPHIC_INFO = '/ListDemographicInfo/v1.10/json.ws?';
    const LIST_LIFESTYLE_INFO = '/ListLifeStyleInfo/v1.10/json.ws?';
    const RETRIEVE_BY_POSTCODE  = '/RetrieveByPostcode/v1.00/json.ws?';
    
    const ACORN_TYPE = 'AcornType';
    const API_KEY_KEY = 'Key';
    const INDICATOR = 'IndicatorFilter';
    const POSTCODE_KEY = 'Postcode';

    /**
     * Error response keys.
    **/
    const ERROR = 'Error';
    const DESCRIPTION = 'Description';
    const CAUSE = 'Cause';
    const RESOLUTION = 'Resolution';

    /**
     * Creates a new instance of the API library.
     *
     * @param string           $apiKey The PostcodeAnywhere API key.
     * @param Zend_Http_Client $client Http client to use. Meant for testing.
    **/
    public function __construct($apiKey, Zend_Http_Client $client = null)
    {
        if (empty($apiKey)) {
            throw new Lookup_PostcodeAnywhere_CustomerProfiling_Exception_Interactive(
            	'The API key can\'t be empty'
            );
        }

        $this->_apiKey = $apiKey;

        $this->_client = $client ? $client : new Zend_Http_Client();

    }
    /**
     *  Lists the Demographic info
     *  @param: AcornType
     *  @param: (optional) IndicatorFilter
     *  @see:   http://www.postcodeanywhere.co.uk/support/webservices/CustomerProfiling/
     *              Interactive/ListDemographicInfo/v1.1/default.aspx
     *
     *  @return: Lookup_PostcodeAnywhere_CustomerProfiling_AcornData
    **/
    public function listDemographicInfo($intAcornType, $strIndicator = null)
    {
        if(!is_null($strIndicator))
            if(!isset(Lookup_PostcodeAnywhere_CustomerProfiling_Data_Demographic::$Indicators[$strIndicator]))
                throw new Lookup_PostcodeAnywhere_CustomerProfiling_Exception_Interactive(
                    sprintf("Indicator %s unknown",$strIndicator));
        
        $url = $this->_joinUrl(
            self::LIST_DEMOGRAPHIC_INFO,
            array( self::API_KEY_KEY => urlencode($this->_apiKey)
                 , self::ACORN_TYPE => urlencode($intAcornType)
                 , self::INDICATOR => urlencode($strIndicator)
            )
        );

        $this->_client->setUri($url);
        $data = Zend_Json::decode($this->_client->request()->getBody());
        if (isset($data[0][self::ERROR])) {
            $msg = $data[0][self::ERROR] . ' - ' . $data[0][self::DESCRIPTION]
                . ' - ' . $data[0][self::CAUSE] . ' - ' . $data[0][self::RESOLUTION];

            throw new Lookup_PostcodeAnywhere_CustomerProfiling_Exception_Interactive(
                $msg
            );
        }

        return new Lookup_PostcodeAnywhere_CustomerProfiling_Data_Demographic($data);
    }
    /**
     *  Lists the Lifestyle info
     *  @param: AcornType
     *  @param: (optional) IndicatorFilter
     *  @see:   http://www.postcodeanywhere.co.uk/support/webservices/CustomerProfiling/
     *              Interactive/ListDemographicInfo/v1.1/default.aspx
     *
     *  @return: Lookup_PostcodeAnywhere_CustomerProfiling_AcornData
    **/
    public function listLifestyleInfo($intAcornType, $strIndicator = null)
    {
        if(!is_null($strIndicator))
            if(!isset(Lookup_PostcodeAnywhere_CustomerProfiling_Data_Lifestyle::$Indicators[$strIndicator]))
                throw new Lookup_PostcodeAnywhere_CustomerProfiling_Exception_Interactive(
                    sprintf("Indicator %s unknown",$strIndicator));

        $url = $this->_joinUrl(
            self::LIST_LIFESTYLE_INFO,
            array( self::API_KEY_KEY => urlencode($this->_apiKey)
                 , self::ACORN_TYPE => urlencode($intAcornType)
                 , self::INDICATOR => urlencode($strIndicator)
            )
        );

        $this->_client->setUri($url);

        $data = Zend_Json::decode($this->_client->request()->getBody());

        if (isset($data[0][self::ERROR])) {
            $msg = $data[0][self::ERROR] . ' - ' . $data[0][self::DESCRIPTION]
                . ' - ' . $data[0][self::CAUSE] . ' - ' . $data[0][self::RESOLUTION];

            throw new Lookup_PostcodeAnywhere_CustomerProfiling_Exception_Interactive(
                $msg
            );
        }

        return new Lookup_PostcodeAnywhere_CustomerProfiling_Data_Lifestyle($data);
    }
    /**
     * Returns the ACORN data for the given postcode.
     *
     * @param string $postcode The postcode.
     * @see http://www.postcodeanywhere.co.uk/support/webservices/CustomerProfiling/Interactive/RetrieveByPostcode/v1/default.aspx
     *
     * @return Lookup_PostcodeAnywhere_CustomerProfiling_ACORN The ACORN record.
    **/
    public function retrieveByPostcode($postcode)
    {
        $url = $this->_joinUrl(
            self::RETRIEVE_BY_POSTCODE,
            array(
                self::API_KEY_KEY => urlencode($this->_apiKey),
                self::POSTCODE_KEY => urlencode($postcode)
            )
        );

        $this->_client->setUri($url);

        $data = Zend_Json::decode($this->_client->request()->getBody());
        $data = $data[0];

        if (isset($data[self::ERROR])) {
            $msg = $data[self::ERROR] . ' - ' . $data[self::DESCRIPTION]
                . ' - ' . $data[self::CAUSE] . ' - ' . $data[self::RESOLUTION];

            throw new Lookup_PostcodeAnywhere_CustomerProfiling_Exception_Interactive(
                $msg
            );
        }

        return new Lookup_PostcodeAnywhere_CustomerProfiling_Data_Acorn($data);
    }

    /**
     * Helper method to avoid future code duplication. Joins urls.
     *
     * @param string $base The base to add to the PostCodeanywhere url
     *                     (it should be relative)
     * @param array  $args The url arguments to use.
     *
     * @return string The formed url.
    **/
    private function _joinUrl($base, array $args)
    {
        $ret = self::BASE_URL . $base;

        /**
         * This will put a & at the begining of the "arg part" of the url, but
         * it doesn't matter.
        **/
        foreach ($args as $arg => $value):
            if(!is_null($value)):
                $ret .= '&' . $arg . '=' . $value;
            endif;
        endforeach;

        return $ret;
    }

}