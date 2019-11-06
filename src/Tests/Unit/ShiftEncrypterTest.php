<?php


namespace Crypto\Tests;


use Crypto\Encrypter\ShiftEncrypter;
use PHPUnit\Framework\TestCase;

class ShiftEncrypterTest extends TestCase
{
    public function testShiftEncryptSuccess()
    {
        $result = (new ShiftEncrypter())->encrypt("Hello World");
        $this->assertArrayHasKey("success", $result);
        $this->assertArrayHasKey("data", $result['success']);
        $this->assertEquals("Khoor Zruog", $result['success']['data']);
    }

    // 1- assert encrypt success response
    // 2- assert decrypt success response
    // 3- assert encrypt fail if $word empty
    // 4- assert decrypt fail if $word empty
    // 5- assert correct encrypted values
    // 6- assert correct decrypted values

    public function testShiftEncryptWithEmptyDataFails()
    {
        $result = (new ShiftEncrypter())->encrypt("    ");
        $this->assertArrayHasKey("error", $result);
        $this->assertArrayHasKey("message", $result['error']);
        $this->assertEquals(400, $result['error']['code']);
        $this->assertEquals("Empty string can not be encrypted", $result['error']['message']);
    }

    public function testShiftDecryptSuccess()
    {
        $result = (new ShiftEncrypter())->decrypt("Khoor Zruog");
        $this->assertArrayHasKey("success", $result);
        $this->assertArrayHasKey("data", $result['success']);
        $this->assertEquals("Hello World", $result['success']['data']);
    }


    public function testShiftDecryptWithEmptyDataFails()
    {
        $result = (new ShiftEncrypter())->decrypt("    ");
        $this->assertArrayHasKey("error", $result);
        $this->assertArrayHasKey("message", $result['error']);
        $this->assertEquals(400, $result['error']['code']);
        $this->assertEquals("Empty string can not be encrypted", $result['error']['message']);
    }


}