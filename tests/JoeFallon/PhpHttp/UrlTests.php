<?php
namespace tests\JoeFallon\PhpHttp;

use JoeFallon\KissTest\UnitTest;
use JoeFallon\PhpHttp\Url;

/**
 * @author    Joseph Fallon <joseph.t.fallon@gmail.com>
 * @copyright Copyright 2014 Joseph Fallon (All rights reserved)
 * @license   MIT
 */
class UrlTests extends UnitTest
{
    public function test_http_scheme_is_detected_properly()
    {
        $testUrl  = "http://localhost:8080/Projects/Jtf-Library/tests/";
        $urlArray = Url::deconstructUrl($testUrl);
        $scheme   = $urlArray['scheme'];

        $this->assertEqual($scheme, 'http', 'http test');
    }


    public function test_ftp_scheme_is_detected_properly()
    {
        $testUrl  = "ftp://localhost:8080/Projects/Jtf-Library/tests/";
        $urlArray = Url::deconstructUrl($testUrl);
        $scheme   = $urlArray['scheme'];

        $this->assertEqual($scheme, 'ftp', 'ftp test');
    }


    public function test_file_scheme_is_detected_properly()
    {
        $testUrl  = "file://localhost:8080/Projects/Jtf-Library/tests/";
        $urlArray = Url::deconstructUrl($testUrl);
        $scheme   = $urlArray['scheme'];

        $this->assertEqual($scheme, 'file', 'file test');
    }


    public function test_telnet_scheme_is_detected_properly()
    {
        $testUrl  = "telnet://localhost:8080/Projects/Jtf-Library/tests/";
        $urlArray = Url::deconstructUrl($testUrl);
        $scheme   = $urlArray['scheme'];

        $this->assertEqual($scheme, 'telnet', 'telnet test');
    }


    public function test_news_scheme_is_detected_properly()
    {
        $testUrl  = "news://localhost:8080/Projects/Jtf-Library/tests/";
        $urlArray = Url::deconstructUrl($testUrl);
        $scheme   = $urlArray['scheme'];

        $this->assertEqual($scheme, 'news', 'news test');
    }


    public function test_mailto_scheme_is_detected_properly()
    {
        $testUrl  = "mailto://localhost:8080/Projects/Jtf-Library/tests/";
        $urlArray = Url::deconstructUrl($testUrl);
        $scheme   = $urlArray['scheme'];

        $this->assertEqual($scheme, 'mailto', 'mailto test');
    }


    public function test_user_is_detected_properly()
    {
        $testUrl  = "http://username@password:localhost:8080/Projects/Jtf-Library/tests/";
        $urlArray = Url::deconstructUrl($testUrl);
        $user     = $urlArray['user'];

        $this->assertEqual($user, 'username');
    }


    public function test_password_is_detected_properly()
    {
        $testUrl  = "http://username:pw@localhost:8080/Projects/Jtf-Library/tests/";
        $urlArray = Url::deconstructUrl($testUrl);
        $pass     = $urlArray['pass'];

        $this->assertEqual($pass, 'pw');
    }


    public function test_host_is_detected_properly()
    {
        $testUrl  = "http://username:pw@localhost:8080/Projects/Jtf-Library/tests/";
        $urlArray = Url::deconstructUrl($testUrl);
        $host     = $urlArray['host'];

        $this->assertEqual($host, 'localhost');
    }


    public function test_port_is_detected_properly()
    {
        $testUrl  = "http://username:pw@localhost:8080/Projects/Jtf-Library/tests";
        $urlArray = Url::deconstructUrl($testUrl);
        $port     = strval($urlArray['port']);

        $this->assertEqual($port, '8080');
    }


    public function test_path_is_detected_properly()
    {
        $testUrl  = "http://username:pw@localhost:8080/Projects/Jtf-Library/tests";
        $urlArray = Url::deconstructUrl($testUrl);
        $path     = $urlArray['path'];

        $this->assertEqual($path, '/Projects/Jtf-Library/tests');
    }


    public function test_query_is_detected_properly()
    {
        $testUrl  = "http://username:pw@localhost:8080/test?param1=1&param2=two";
        $urlArray = Url::deconstructUrl($testUrl);
        $query    = $urlArray['query'];

        $this->assertEqual($query, 'param1=1&param2=two');
    }


    public function test_fragment_is_detected_properly()
    {
        $testUrl  = "http://username:pw@localhost:8080/test.php#foo";
        $urlArray = Url::deconstructUrl($testUrl);
        $fragment = $urlArray['fragment'];

        $this->assertEqual($fragment, 'foo');
    }


    public function test_query_params_are_detected_properly()
    {
        $testUrl  = "http://username:pw@localhost:8080/test?param1=1&param2=two";
        $urlArray = Url::deconstructUrl($testUrl);

        $this->assertTrue(array_key_exists('param1', $urlArray['query_params']),
                          'param1 exists');
        $this->assertEqual($urlArray['query_params']['param1'], '1', 'param1 is correct');

        $this->assertTrue(array_key_exists('param2', $urlArray['query_params']),
                          'param2 exists');
        $this->assertEqual($urlArray['query_params']['param2'], 'two', 'param2 is correct');
    }


    public function test_url_with_fragment_is_constructed_properly()
    {
        $testUrl  = "http://username:pw@localhost:8080/test.php#foo";
        $urlArray = Url::deconstructUrl($testUrl);
        $result   = Url::constructUrl($urlArray);

        $this->assertEqual($testUrl, $result);
    }


    public function test_url_with_query_parameters_is_constructed_properly()
    {
        $testUrl  = "http://username:pw@localhost:8080/test?param1=1&param2=two";
        $urlArray = Url::deconstructUrl($testUrl);
        $result   = Url::constructUrl($urlArray);

        $this->assertEqual($testUrl, $result);
    }


    public function test_getQueryParameters_returns_correct_value()
    {
        $testUrl     = "http://username:pw@localhost:8080/test?param1=1&param2=two";
        $queryParams = Url::getQueryParameters($testUrl);

        $this->assertTrue(array_key_exists('param1', $queryParams),
                          'param1 key exists check');
        $this->assertTrue(array_key_exists('param2', $queryParams),
                          'param2 key exists check');
        $this->assertEqual('1', $queryParams['param1'], 'param1 value check');
        $this->assertEqual('two', $queryParams['param2'], 'param2 value check');
    }


    public function test_setQueryParameters_returns_correct_value()
    {
        $url             = 'http://username:pw@localhost:8080/test';
        $queryParameters = array(
          'param1' => 1,
          'param2' => 'two'
        );

        $actual   = Url::setQueryParameters($url, $queryParameters);
        $expected = "http://username:pw@localhost:8080/test?param1=1&param2=two";

        $this->assertEqual($actual, $expected);
    }


    public function test_updateQueryParameters_returns_correct_value()
    {
        $url             = "http://username:pw@localhost:8080/test?param1=1&param2=two";
        $queryParameters = array(
          'param1' => 3,
          'param2' => 'four'
        );

        $actual   = Url::setQueryParameters($url, $queryParameters);
        $expected = "http://username:pw@localhost:8080/test?param1=3&param2=four";

        $this->assertEqual($actual, $expected);
    }


    public function test_cleanUrl_returns_correct_value()
    {
        $testUrl  = "localhost:8080/test?param1=1&param2=two";
        $actual   = Url::cleanUrl($testUrl);
        $expected = "http://localhost:8080/test?param1=1&param2=two";

        $this->assertEqual($actual, $expected);
    }
}