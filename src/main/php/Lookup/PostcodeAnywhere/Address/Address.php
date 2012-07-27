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
    const LINE1 = 'line1';  
    const LINE2 = 'line2';  
    const LINE3 = 'line3';  
    const LINE4 = 'line4';  
    const LINE5 = 'line5';  
    const POSTTOWN = 'town';  
    const COUNTY = 'county';  

    private $_addressFields = array(
        self::ID => null,
        self::STREET => null,
        self::PLACE => null,
        self::POSTCODE => null,
        self::LINE1 => null,
        self::LINE2 => null,
        self::LINE3 => null,
        self::LINE4 => null,
        self::LINE5 => null,
        self::POSTTOWN => null,
        self::COUNTY => null
    );

	
    function __construct(array $address) {
	   if (!empty($address)) {
 	       $this->setAddressFromArray($address);
	   }
	   		
    }
     
    /** 
    * Set the address details from array.
    * 
    * 
    * @author Mark Hodgson
    **/
    public function setAddressFromArray(array $address) {
	   if (empty($address)) {
	       // throw new custom exception missing data.
	   }

           if(!empty($address['Id'])) {
		$this->_addressFields[self::ID] = $address['Id'];
	   }
           if(!empty($address['StreetAddress'])) {
		$this->_addressFields[self::STREET] = $address['StreetAddress'];
	   }
           if(!empty($address['Place'])) {
		$this->_addressFields[self::PLACE] = $address['Place'];
	   }
           if(!empty($address['Postcode'])) {
		$this->_addressFields[self::POSTCODE] = $address['Postcode'];
	   }
           if(!empty($address['Line1'])) {
		$this->_addressFields[self::LINE1] = $address['Line1'];
	   }
           if(!empty($address['Line2'])) {
		$this->_addressFields[self::LINE2] = $address['Line2'];
	   }
           if(!empty($address['Line3'])) {
		$this->_addressFields[self::LINE3] = $address['Line3'];
	   }
           if(!empty($address['PostTown'])) {
		$this->_addressFields[self::POSTTOWN] = $address['PostTown'];
	   }
           if(!empty($address['County'])) {
		$this->_addressFields[self::COUNTY] = $address['County'];
	   }
	   	   
    }
    
    /** 
    * Get the full address line
    * 
    * @return string address line
    * @author Mark Hodgson
    **/
    public function getAddressLine() {
        
        return $this->_addressFields[self::STREET]
        .", ". $this->_addressFields[self::PLACE]
        .", ". $this->_addressFields[self::POSTCODE];
    }

    /** 
    * Get the postcode anywhere address Id
    * 
    * @return string Id
    * @author Mark Hodgson
    **/
    public function getAddressId() {
   	    return $this->_addressFields[self::ID];
    }

    /** 
    * Get the stress address. 
    * Note. This may be an amalgamation of more detailed fields.
    * @return string street address
    * @author Mark Hodgson
    **/
    public function getStreetAddress() {
	   return $this->_addressFields[self::STREET];
    }

    /** 
    * Get the place
    * Note. This may be an amalgamation of more detailed fields.
    * @return string place
    * @author Mark Hodgson
    **/
    public function getPlace() {
        return $this->_addressFields[self::PLACE];
    }
 
    /** 
    * Get the Postcode.
    * 
    * @return string postcode
    * @author Mark Hodgson
    **/
    public function getPostcode() {
        return $this->_addressFields[self::POSTCODE];
    }

    /** 
    * Set the Postcode.
    * 
    * @params string $postcode
    * @author Mark Hodgson
    **/
    public function setPostcode($postcode) {
        $this->_addressFields[self::POSTCODE] = $postcode;
    }      
  
    /** 
    * Set the Address Id.
    * 
    * @params string address id
    * @author Mark Hodgson
    **/
    public function setAddressId($addressId) {
        $this->_addressFields[self::ID] = $addressId;
    }   

    /** 
    * Get the Town.
    * 
    * @return string town
    * @author Mark Hodgson
    **/
    public function getTown() {
        return $this->_addressFields[self::POSTTOWN];
    }

    /** 
    * Get the Address line 1.
    * 
    * @return string address line 1
    * @author Mark Hodgson
    **/
    public function getAddressLine1() {
        return $this->_addressFields[self::LINE1];
    }

    /** 
    * Get the County.
    * 
    * @return string county
    * @author Mark Hodgson
    **/
    public function getCounty() {
        return $this->_addressFields[self::COUNTY];
    }

    /** 
    * Get the Formatted second address line.
    * Note. This is a combination of Line2-5
    * @return string formatted address line 2
    * @author Mark Hodgson
    **/
    public function getFormattedAddressLine2() {
	 
	$addressLine2 = null;
	if (!empty($this->_addressFields[self::LINE2])) {
		$addressLine2 .= $this->_addressFields[self::LINE2];
	}
	if (!empty($this->_addressFields[self::LINE3])) {
		$addressLine2 .= ', '.$this->_addressFields[self::LINE3];
	}
	if (!empty($this->_addressFields[self::LINE4])) {
		$addressLine2 .= ', '.$this->_addressFields[self::LINE4];
	}
	if (!empty($this->_addressFields[self::LINE5])) {
		$addressLine2 .= ', '.$this->_addressFields[self::LINE5];
	}
	
	return $addressLine2;
    }
    
}
