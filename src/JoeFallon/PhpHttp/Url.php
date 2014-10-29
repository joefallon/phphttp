<?php
namespace JoeFallon\PhpHttp;

/**
 * @author    Joseph Fallon <joseph.t.fallon@gmail.com>
 * @copyright Copyright 2014 Joseph Fallon (All rights reserved)
 * @license   MIT
 *
 * Example:
 *
 *  Original URL: http://username:pw@localhost:8080/test?param1=1&param2=two
 *
 *  Deconstructed URL:
 *
 *  Array
 *  (
 *    [scheme] => http
 *    [host]   => localhost
 *    [port]   => 8080
 *    [user]   => username
 *    [pass]   => pw
 *    [path]   => /test
 *    [query]  => param1=1&param2=two
 *    [query_params] => Array
 *    (
 *       [paramName1] => 1
 *       [paramName2] => two
 *    )
 *  )
 *
 */
class Url
{
    /**
     * This function parses the URL and returns an array of key-value
     * pairs that consists of the key-value pairs.
     *
     * @param  string $url
     *
     * @return string[]
     */
    public static function getQueryParameters($url)
    {
        $urlArray = self::deconstructUrl($url);

        return $urlArray['query_params'];
    }


    /**
     * This function deconstructs a url into an associative array as
     * follows:
     *
     * [scheme]://[user]:[pass]@[host]:[port]/[path]?[query]#[fragment]
     *
     * Additionally, it adds a 'query_params' key which contains array of
     * url-decoded key-value pairs
     *
     * @param  string $url Input URL
     *
     * @return string[] Deconstructed URL
     */
    public static function deconstructUrl($url)
    {
        $urlArray                 = parse_url($url);
        $urlArray['query_params'] = array();
        $queryArguments           = array();

        // Parse the GET query parameters.
        if(array_key_exists('query', $urlArray))
        {
            $query          = $urlArray['query'];
            $queryArguments = explode('&', $query);
        }

        foreach($queryArguments as $queryArgument)
        {
            $queryArgument = trim($queryArgument);

            if(strlen($queryArgument) === 0)
            {
                continue;
            }

            $keyAndValue = explode('=', $queryArgument);
            $key         = $keyAndValue[0];
            $value       = $keyAndValue[1];

            $urlArray['query_params'][$key] = urldecode($value);
        }

        return $urlArray;
    }


    /**
     * Removes existing url params and sets them to those specified
     * in $queryParameters
     *
     * @param String $url             - Url
     *
     * @param array  $queryParameters - Array of Key-Value pairs to set
     *                                url params to
     *
     * @return  string Newly compiled url
     */
    public static function setQueryParameters($url, $queryParameters)
    {
        $urlArray                 = self::deconstructUrl($url);
        $urlArray['query']        = '';
        $urlArray['query_params'] = $queryParameters;
        $url                      = self::constructUrl($urlArray);

        return $url;
    }


    /**
     * This function constructs a URL string from an associative array
     * as follows:
     *
     * [scheme]://[user]:[pass]@[host]:[port]/[path]?[query]#[fragment]
     *
     * If the key 'query_params' is present, then the key 'query' is ignored.
     *
     * @param string[] $urlArray Associative Array of URL Components
     *
     * @return string
     */
    public static function constructUrl($urlArray)
    {
        $query = '';

        // Compile The Query
        if(isset($urlArray['query_params']))
        {
            $queryArguments = array();

            if(is_array($urlArray['query_params']))
            {
                foreach($urlArray['query_params'] as $key => $value)
                {
                    $encodedValue     = urlencode($value);
                    $queryArguments[] = $key . '=' . $encodedValue;
                }
            }

            $query = implode('&', $queryArguments);
        }
        else
        {
            $query = $urlArray['query'];
        }

        if(!isset($urlArray['scheme']) || strlen($urlArray['scheme']) === 0)
        {
            // Assume the scheme is http.
            $urlArray['scheme'] = 'http';
        }

        // Compile The URL
        $url = $urlArray['scheme'] . '://';

        if(isset($urlArray['user']) && strlen($urlArray['user']) > 0)
        {
            if(isset($urlArray['pass']) && strlen($urlArray['pass']) > 0)
            {
                $url .= $urlArray['user'] . ':' . $urlArray['pass'] . '@';
            }

        }

        $url .= $urlArray['host'];

        if(isset($urlArray['port']) && strlen($urlArray['port']) > 0)
        {
            $url .= ':' . $urlArray['port'];
        }

        if(isset($urlArray['path']) && strlen($urlArray['path']) > 0)
        {
            $url .= $urlArray['path'];
        }

        if(strlen($query) > 0)
        {
            $url .= '?' . $query;
        }

        if(isset($urlArray['fragment']) && strlen($urlArray['fragment']) > 0)
        {
            $url .= '#' . $urlArray['fragment'];
        }

        return $url;
    }


    /**
     * Updates values of existing url params and/or adds (if not set)
     * those specified in $queryParameters
     *
     * @param string $url Url
     *
     * @param array $queryParams Array of Key-Value pairs to set url params to.
     *
     * @return string Returns the newly compiled url.
     */
    public static function updateQueryParameters($url, $queryParams)
    {
        $arr                 = self::deconstructUrl($url);
        $arr['query']        = '';
        $arr['query_params'] = array_merge($arr['query_params'], $queryParams);

        return self::constructUrl($arr);
    }


    /**
     * This function creates a well-formed url given a url that
     * has minor issues (e.g. missing scheme).
     *
     * @param string $url
     *
     * @return String
     */
    public static function cleanUrl($url)
    {
        $urlArray = self::deconstructUrl($url);
        $url      = self::constructUrl($urlArray);

        return $url;
    }
}
