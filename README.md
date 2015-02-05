# phphttp

By [Joe Fallon](http://blog.joefallon.net)

A simple library of useful HTTP utilities. It has the following features:

*   Full suite of unit tests.
*   It can be integrated into any existing project.
*   Can be fully understood in just a few moments.

## Installation

The easiest way to install PhpDatabase is with
[Composer](https://getcomposer.org/). Create the following `composer.json` file
and run the `php composer.phar install` command to install it.

```json
{
    "require": {
        "joefallon/phphttp": "*"
    }
}
```

## Usage

There are four main classes contained in this library: 

*   `Agent`
*   `HttpCodes`
*   `MimeType`
*   `PageRedirect`

### Agent

```
isBrowser()
isMobile()
isRobot()
isReferral()
getBrowserName()
getBrowserVersion()
getMobileDeviceName()
getRobotName()
getPlatformName()
getReferrer()
getAgentString()
getLanguages()
getCharsets()
acceptsLang($lang = 'en')
acceptsCharset($charset = 'utf-8')
```

### HttpCodes

```
getCodeMessage($code)
```

### MimeType

```
getMimeTypeFromFileName($filename = '')
getMimeTypeFromFileExtension($extension = '')
```

### PageRedirect

```
getRedirectDestination()
setRedirectDestination($destination)
redirect()
```
