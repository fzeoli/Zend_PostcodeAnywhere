<?php
/**
 * PostcodeAnywhere
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://github.com/canddi/Zend_PostcodeAnywhere/blob/master/LICENSE.txt
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to hello@canddi.com so we can send you a copy immediately.
 *
 */

/**
 * Library class to interact with PostcodeAnywhere's customer profiling
 * interactive API.
 */

 /*
 * TODO: Add more methods. Currently FindByPostcode is the only search method
 * implemented.
 */
class Lookup_PostcodeAnywhere_Address_AddressLookup
{

    private $_apiKey;

    /**
     * @var Zend_Http_Client
     */
    private $_client;

    // @TODO option for http and https
    const BASE_URL = 'http://services.postcodeanywhere.co.uk/PostcodeAnywhere/Interactive/';

    const POSTCODE_URL = 'FindByPostcode/v1.00/json3.ws?';

    const RETRIEVE_BY_ID_URL = 'RetrieveById/v1.20/wsdlnew.ws?';

    private $_accountCode = null;
    private $_licenceCode = null;

    private $_postcodeData = array(
          "URL" => "FindByPostcode/v1.00/json3.ws?",
          "TYPE" => "&Postcode=");

    private $_IdData = array(
          "URL" => "RetrieveById/v1.20/json3.ws?",
          "TYPE" => "&Id=");


    function __construct(array $config) {
           $this->_accountCode = $config['accountCode'];
	   $this->_licenceCode = $config['licenceCode'];

	   if ($this->_accountCode == null) {
           //throw missing data error
	       throw new Lookup_PostcodeAnywhere_Address_AddressLookup_Exception ("Missing Data: Account Code");
	   }
	   if ($this->_licenceCode == null) {
	       //throw missing data error
	       throw new Lookup_PostcodeAnywhere_Address_AddressLookup_Exception ("Missing Data: Licence Code");
	   }
    }

    public function getAddressByPostcode($postcode){

	   $this->_postCode = $postcode;

       	   $url = $this->prepareUrl($this->_postcodeData, $postcode);

	   $addresses = $this->sendRequest($url);

	   if (false == $addresses) {
	      return false;
	   }
	   $returnAddresses = array();
	   foreach ($addresses as $address) {
	       $address->setPostcode($postcode);
	       $returnAddresses[] = $address;
	    }
        return $returnAddresses;
     }


    public function getAddressById($addressId){

           $url = $this->prepareUrl($this->_IdData, $addressId);

	   $addresses = $this->sendRequest($url);

	   if (false == $addresses) {
	      return false;
	   }
	   // There will be only one result as this is an primary key lookup.
	   $addresses[0]->setAddressId($addressId);
        return $addresses[0];
     }


	function prepareUrl($actionType, $actionValue) {
		$postUrl = self::BASE_URL;
        	$postUrl .= $actionType['URL'];
        	$postUrl .= "Key=" . urlencode($this->_licenceCode);
        	$postUrl .= $actionType['TYPE'] . urlencode($actionValue);
		return $postUrl;
	}


	function sendRequest($url, Zend_Http_Client $client = null) {

	    $this->_client = $client;
	    if ($client == null) {
		  $this->_client = new Zend_Http_Client();
		}
		$this->_client->setUri($url);

       		try {
		    $body = $this->_client->request()->getBody();
		} catch (Exception $e) {
		    throw new Lookup_PostcodeAnywhere_Address_AddressLookup_Exception
		    ($e->getMessage());
		}

		$addresses = Zend_Json::decode($body);

		$addressArr = array();
		$addresses = $addresses['Items'];
		foreach ($addresses as $address) {
		       $newAddressClass = new Lookup_PostcodeAnywhere_Address_Address($address);
		       $addressArr[] = $newAddressClass;
		}

        //return array of address classes
		return $addressArr;
	}


}
