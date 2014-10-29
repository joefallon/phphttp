<?php
use JoeFallon\KissTest\UnitTest;

require('config/main.php');


new \tests\JoeFallon\PhpHttp\AgentTests();
new \tests\JoeFallon\PhpHttp\HttpCodesTests();
new \tests\JoeFallon\PhpHttp\MimeTypeTests();
new \tests\JoeFallon\PhpHttp\PageRedirectTests();
new \tests\JoeFallon\PhpHttp\UrlTests();

UnitTest::getAllUnitTestsSummary();
