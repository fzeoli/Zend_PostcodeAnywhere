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

class Lookup_PostcodeAnywhere_CustomerProfiling_InteractiveTest
    extends PHPUnit_Framework_TestCase
{
    const TEST_BY_POSTCODE_RESPONSE = '[{"AcornType":"7","AcornTypeName":"Old people, detached homes","AcornGroup":"B","AcornGroupName":"Affluent Greys","AcornCategory":"1","AcornCategoryName":"Wealthy Achievers"}]';
    const TEST_DEMOGRAPHIC_RESPONSE = '[{"Indicator":"Age","Segmentation":"Under 5","UKPopulation":"10","Variation":"-5"}]';
    const TEST_LIFESTYLE_RESPONSE = '[{"Indicator":"Prefered charities","Segmentation":"Animal welfare","UKPopulation":"10","Variation":"-5"},
    {"Indicator":"Prefered charities","Segmentation":"Children","UKPopulation":"10","Variation":"28"}]';
    const TEST_ERROR_RESPONSE = '[{"Error": "1", "Description":"test","Cause":"test","Resolution":"test"}]';

    /**
     * Tests the constructor method.
     *
     * @return void
    **/
    public function testConstructor()
    {
        $caught = false;
        
        try {
            $foo = new Lookup_PostcodeAnywhere_CustomerProfiling_Interactive(null);
        } catch (Lookup_PostcodeAnywhere_CustomerProfiling_Exception_Interactive $e) {
            $this->assertEquals(
                $e->getMessage(),
                'The API key can\'t be empty'
            );

            $caught = true;
        }

        $this->assertTrue($caught, 'Exception wasn\'t rised');
    }

    /**
     * Tests the retrieveByPostcode method.
     *
     * @return void
    **/
    public function testRetrieveByPostcode()
    {
        $key = '1232313123';

        $adapter = new Zend_Http_Client_Adapter_Test();

        $response = new Zend_Http_Response(200, array(), self::TEST_BY_POSTCODE_RESPONSE);
        $adapter->setResponse($response);

        $client = new Zend_Http_Client(
            null,
            array(
            	'adapter' => $adapter
            )
        );

        $api = new Lookup_PostcodeAnywhere_CustomerProfiling_Interactive($key, $client);
        $ret = $api->retrieveByPostcode('FOOBAR');

        $uri = 'http://services.postcodeanywhere.co.uk:80/CustomerProfiling/Interactive'
        	. '/RetrieveByPostcode/v1.00/json.ws?&Key=' . $key . '&Postcode=FOOBAR';

    	$this->assertEquals($uri, $client->getUri()->getUri());

    	$this->assertTrue($ret instanceof Lookup_PostcodeAnywhere_CustomerProfiling_Data_Acorn);

    	$this->assertEquals($ret->getType(), 7);
        $this->assertEquals($ret->getTypeName(), 'Old people, detached homes');
        $this->assertEquals($ret->getGroup(), 'B');
        $this->assertEquals($ret->getGroupName(), 'Affluent Greys');
        $this->assertEquals($ret->getCategory(), 1);
        $this->assertEquals($ret->getCategoryName(), 'Wealthy Achievers');

        $response = new Zend_Http_Response(200, array(), self::TEST_ERROR_RESPONSE);
        $adapter->setResponse($response);

        $caught = false;

        try {
            $api->retrieveByPostcode('FOOBAR');
        } catch (Lookup_PostcodeAnywhere_CustomerProfiling_Exception_Interactive $e) {

            $this->assertEquals('1 - test - test - test', $e->getMessage());

            $caught = true;
        }

        $this->assertTrue($caught, 'The exception didn\'t rise.');
    }

    /**
     *
    **/
    public function testListDemographic()
    {
        $key = '1232313123';

        $adapter = new Zend_Http_Client_Adapter_Test();

        $response = new Zend_Http_Response(200, array(), self::TEST_DEMOGRAPHIC_RESPONSE);
        $adapter->setResponse($response);

        $client = new Zend_Http_Client(
            null,
            array(
            	'adapter' => $adapter
            )
        );
        
        $api        = new Lookup_PostcodeAnywhere_CustomerProfiling_Interactive($key, $client);
        $demoData   = $api->listDemographicInfo(10);
        $itemAge    = $demoData->getAge();
        $itemAge    = $itemAge[0];
        
        $this->assertTrue($itemAge instanceof Lookup_PostcodeAnywhere_CustomerProfiling_Data_ListItem);

    	$this->assertEquals($itemAge->getSegmentation(), "Under 5");
        $this->assertEquals($itemAge->getUKPopulation(), 10);
        $this->assertEquals($itemAge->getVariation(), -5);
        
    }
    
    /**
     *
    **/
    public function testListLifestyle()
    {
        $key = '1232313123';

        $adapter = new Zend_Http_Client_Adapter_Test();

        $response = new Zend_Http_Response(200, array(), self::TEST_LIFESTYLE_RESPONSE);
        $adapter->setResponse($response);

        $client = new Zend_Http_Client(
            null,
            array(
            	'adapter' => $adapter
            )
        );
        
        $api        = new Lookup_PostcodeAnywhere_CustomerProfiling_Interactive($key, $client);
        $demoData   = $api->listLifestyleInfo(10);
        $arrData    = $demoData->getCharities();
        
        $itemCharity= $arrData[0];
        
        $this->assertTrue($itemCharity instanceof Lookup_PostcodeAnywhere_CustomerProfiling_Data_ListItem);

    	$this->assertEquals($itemCharity->getSegmentation(), "Animal welfare");
        $this->assertEquals($itemCharity->getVariation(), -5);
    }
}
