<?php
namespace tests\JoeFallon\PhpHttp;

use JoeFallon\KissTest\UnitTest;
use JoeFallon\PhpHttp\PageRedirect;

/**
 * @author    Joseph Fallon <joseph.t.fallon@gmail.com>
 * @copyright Copyright 2014 Joseph Fallon (All rights reserved)
 * @license   MIT
 */
class PageRedirectTests extends UnitTest
{
    public function test_redirectDestination_getter_setter()
    {
        $redirector  = new PageRedirect();
        $destination = 'http://www.example.com';
        $redirector->setRedirectDestination($destination);

        $expected = $destination;
        $actual   = $redirector->getRedirectDestination();
        $this->assertEqual($actual, $expected);
    }


    public function test_initial_redirect_is_set_to_forward_slash()
    {
        $redirector = new PageRedirect();

        $expected = '/';
        $actual   = $redirector->getRedirectDestination();
        $this->assertEqual($actual, $expected);
    }
}