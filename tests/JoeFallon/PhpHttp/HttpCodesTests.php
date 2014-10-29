<?php
namespace tests\JoeFallon\PhpHttp;

use JoeFallon\KissTest\UnitTest;
use JoeFallon\PhpHttp\HttpCodes;

/**
 * @author    Joseph Fallon <joseph.t.fallon@gmail.com>
 * @copyright Copyright 2014 Joseph Fallon (All rights reserved)
 * @license   MIT
 */
class HttpCodesTests extends UnitTest
{
    /** @var  HttpCodes */
    private $_httpCodes;


    public function setUp()
    {
        parent::setUp();

        $this->_httpCodes = new HttpCodes();
    }


    public function tearDown()
    {
        parent::tearDown();

        $this->_httpCodes = null;
    }


    public function test_200_returns_correct_message()
    {
        $expected = '200 OK';
        $actual   = $this->_httpCodes->getCodeMessage(200);

        $this->assertEqual($expected, $actual);
    }


    public function test_301_returns_correct_message()
    {
        $expected = '301 Moved Permanently';
        $actual   = $this->_httpCodes->getCodeMessage(301);

        $this->assertEqual($expected, $actual);
    }


    public function test_404_returns_correct_message()
    {
        $expected = '404 Not Found';
        $actual   = $this->_httpCodes->getCodeMessage(404);

        $this->assertEqual($expected, $actual);
    }
}