<?php
namespace tests\JoeFallon\PhpHttp;

use JoeFallon\KissTest\UnitTest;
use JoeFallon\PhpHttp\Agent;

/**
 * @author    Joseph Fallon <joseph.t.fallon@gmail.com>
 * @copyright Copyright 2014 Joseph Fallon (All rights reserved)
 * @license   MIT
 */
class AgentTests extends UnitTest
{
    public function test_a_visitor_type_is_detected()
    {
        $agent = new Agent();

        //Debug::dump('$agent->isBrowser()', $agent->isBrowser());
        //Debug::dump('$agent->isMobile()', $agent->isMobile());
        //Debug::dump('$agent->isRobot()', $agent->isRobot());

        if($agent->isBrowser() && !$agent->isMobile() && !$agent->isRobot())
        {
            //die('is browser');
            $this->testPass();

            return;
        }

        if(!$agent->isBrowser() && $agent->isMobile() && !$agent->isRobot())
        {
            //die('is mobile');
            $this->testPass();

            return;
        }

        if(!$agent->isBrowser() && !$agent->isMobile() && $agent->isRobot())
        {
            //die('is robot');
            $this->testPass();

            return;
        }

        $this->testFail();
    }


    public function test_a_platform_is_detected()
    {
        $agent = new Agent();
        $len   = strlen($agent->getPlatformName());

        //Debug::dump('$agent->getPlatformName()', $agent->getPlatformName());

        $this->assertFirstGreaterThanSecond($len, 0);
    }
}
