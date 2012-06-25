<?php

/**
 * Library class to interact with PostcodeAnywhere's address lookup results
 * interactive API.
 */
class PostcodeAnywhere_Address_Address
{
    
    const ID = 'id';
    const PLACE = 'place';
    const STREET = 'streetAddress';
    const POSTCODE = 'postcode';       

    private $_addressFields = array(
        self::ID => null,
        self::STREET => null,
        self::PLACE => null,
        self::POSTCODE => null
    );


    private $_id;

    private $_streetAddress;

    private $_place;
	
    function __construct(array $address) {
	   if (!empty($address)) {
	       $this->_addressFields[self::ID] = $address['Id'];
	       $this->_addressFields[self::STREET] = $address['StreetAddress'];
	       $this->_addressFields[self::PLACE] = $address['Place'];
	       if (array_key_exists('Postcode', $address)) {
	           $this->_addressFields[self::POSTCODE] = $address['Postcode'];
	       }
	   }
	   		
    }
    
        
    public function setAddressFromArray(array $address) {
	   if (empty($address)) {
	       // throw new custom exception missing data.
	   }
	   $this->_addressFields[self::ID] = $address['Id'];
	   $this->_addressFields[self::STREET] = $address['StreetAddress'];
	   $this->_addressFields[self::PLACE] = $address['Place'];
	   $this->_addressFields[self::POSTCODE] = $address['Postcode'];
	   
    }
    
    
    public function getAddressLine() {
        
        return $this->_addressFields[self::STREET]
        .", ". $this->_addressFields[self::PLACE]
        .", ". $this->_addressFields[self::POSTCODE];
    }

    public function getAddressId() {
   	    return $this->_addressFields[self::ID];
    }


    public function getStreetAddress() {
	   return $this->_addressFields[self::STREET];
    }

	
    public function getPlace() {
        return $this->_addressFields[self::PLACE];
    }
 
    public function getPostcode() {
        return $this->_addressFields[self::POSTCODE];
    }
    
    public function setPostcode($postcode) {
        $this->_addressFields[self::POSTCODE] = $postcode;
    }      
    
    public function serialize() {
        return base64_encode(serialize(
            $this->_addressFields
        ));
    }
    
    public function encode() {
        return base64_encode(
            $this->_addressFields
        );
    }
    
    public function decode() {
        return base64_decode(
            $this->_addressFields
        );
    }
        
    public function unserialize($serializeAddress) {
        $this->_addressFields = base64_decode(unserialize($serializeAddress));
    }   
    
}
