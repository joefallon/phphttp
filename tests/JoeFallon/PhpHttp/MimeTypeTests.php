<?php
namespace tests\JoeFallon\PhpHttp;

use JoeFallon\KissTest\UnitTest;
use JoeFallon\PhpHttp\MimeType;

/**
 * @author    Joseph Fallon <joseph.t.fallon@gmail.com>
 * @copyright Copyright 2014 Joseph Fallon (All rights reserved)
 * @license   MIT
 */
class MimeTypeTests extends UnitTest
{

    public function test_retrieves_correct_mimetype_when_no_spaces_in_filename1()
    {
        $mimeType = new MimeType();
        $expected = "application/pdf";
        $actual   = $mimeType->getMimeTypeFromFileName("myfile.pdf");


        return $this->assertEqual($expected, $actual);
    }

    public function test_retrieves_correct_mimetype_when_no_spaces_in_filename2()
    {
        $mimeType = new MimeType();
        $expected = "image/jpeg";
        $actual   = $mimeType->getMimeTypeFromFileName("myfile.jpg");

        return $this->assertEqual($expected, $actual);
    }

    public function test_retrieves_correct_mimetype_when_no_spaces_in_filename3()
    {
        $mimeType = new MimeType();
        $expected = "image/gif";
        $actual   = $mimeType->getMimeTypeFromFileName("myfile.gif");

        return $this->assertEqual($expected, $actual);
    }

    public function test_retrieves_correct_mimetype_when_no_spaces_in_filename4()
    {
        $mimeType = new MimeType();
        $expected = "application/x-sh";
        $actual   = $mimeType->getMimeTypeFromFileName("myfile.sh");

        return $this->assertEqual($expected, $actual);
    }

    public function test_retrieves_correct_mimetype_when_spaces_exist_in_filename1()
    {
        $mimeType = new MimeType();
        $expected = "application/pdf";
        $actual   = $mimeType->getMimeTypeFromFileName("my file.pdf");


        return $this->assertEqual($expected, $actual);
    }

    public function test_retrieves_correct_mimetype_when_spaces_exist_in_filename2()
    {
        $mimeType = new MimeType();
        $expected = "image/jpeg";
        $actual   = $mimeType->getMimeTypeFromFileName(" myfile.jpg");

        return $this->assertEqual($expected, $actual);
    }

    public function test_retrieves_correct_mimetype_when_spaces_exist_in_filename3()
    {
        $mimeType = new MimeType();
        $expected = "image/gif";
        $actual   = $mimeType->getMimeTypeFromFileName("myfile .gif");

        return $this->assertEqual($expected, $actual);
    }

    public function test_retrieves_correct_mimetype_when_spaces_exist_in_filename4()
    {
        $mimeType = new MimeType();
        $expected = "application/x-sh";
        $actual   = $mimeType->getMimeTypeFromFileName(" my file.sh ");

        return $this->assertEqual($expected, $actual);
    }

    public function test_retrieves_mimetype_when_path_seperators_exist_in_filename1()
    {
        $mimeType = new MimeType();
        $expected = "application/pdf";
        $actual   = $mimeType->getMimeTypeFromFileName("C:\\my\file.pdf");


        return $this->assertEqual($expected, $actual);
    }

    public function test_retrieves_mimetype_when_path_seperators_exist_in_filename2()
    {
        $mimeType = new MimeType();
        $expected = "image/jpeg";
        $actual   = $mimeType->getMimeTypeFromFileName("/var/www/myfile.jpg");

        return $this->assertEqual($expected, $actual);
    }

    public function test_retrieves_mimetype_when_path_seperators_exist_in_filename3()
    {
        $mimeType = new MimeType();
        $expected = "image/gif";
        $actual   = $mimeType->getMimeTypeFromFileName("var/myfile .gif");

        return $this->assertEqual($expected, $actual);
    }

    public function test_retrieves_mimetype_when_path_seperators_exist_in_filename4()
    {
        $mimeType = new MimeType();
        $expected = "application/x-sh";
        $actual   = $mimeType->getMimeTypeFromFileName("c:\\var\my file.sh ");

        return $this->assertEqual($expected, $actual);
    }

    public function test_retrieves_correct_mimetype_from_extension_only()
    {
        $mimeType = new MimeType();
        $expected = "application/x-sh";
        $actual   = $mimeType->getMimeTypeFromFileExtension("sh");

        return $this->assertEqual($expected, $actual);
    }

    public function test_retrieves_correct_mimetype_from_extension_only_with_spaces()
    {
        $mimeType = new MimeType();
        $expected = "application/x-sh";
        $actual   = $mimeType->getMimeTypeFromFileExtension(" sh ");

        return $this->assertEqual($expected, $actual);
    }

    public function test_retrieves_correct_mimetype_from_extension_only_with_period()
    {
        $mimeType = new MimeType();
        $expected = "application/x-sh";
        $actual   = $mimeType->getMimeTypeFromFileExtension(".sh");

        return $this->assertEqual($expected, $actual);
    }

    public function test_retrieves_correct_mimetype_from_extension_only_with_period_and_spaces()
    {
        $mimeType = new MimeType();
        $expected = "application/x-sh";
        $actual   = $mimeType->getMimeTypeFromFileExtension(" .sh ");

        return $this->assertEqual($expected, $actual);
    }

    public function test_retrieves_correct_default_mimetype()
    {
        $mimeType = new MimeType();
        $expected = "application/octet-stream";
        $actual   = $mimeType->getMimeTypeFromFileExtension("bad-mime-type");

        return $this->assertEqual($expected, $actual);
    }

}