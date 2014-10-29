<?php
namespace JoeFallon\PhpHttp;

/**
 * @author    Joseph Fallon <joseph.t.fallon@gmail.com>
 * @copyright Copyright 2014 Joseph Fallon (All rights reserved)
 * @license   MIT
 */
class PageRedirect
{
    /** @var string */
    private $_redirectDestination;


    /**
     * __construct
     */
    public function __construct()
    {
        $this->_redirectDestination = '/';
    }


    /**
     * get Redirect Destination
     *
     * @return string
     */
    public function getRedirectDestination()
    {
        return $this->_redirectDestination;
    }


    /**
     * set Redirect Destination
     *
     * @param string $destination
     */
    public function setRedirectDestination($destination)
    {
        $destination                = strval($destination);
        $this->_redirectDestination = $destination;
    }


    /**
     * redirect - This function performs the redirect.
     */
    public function redirect()
    {
        header('Location: ' . $this->_redirectDestination);
        exit;
    }
}
