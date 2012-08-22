<?php

namespace Social;

require_once 'PHPUnit/Framework.php';

/**
 * Test class for Connection.
 * Generated by PHPUnit on 2012-08-07 at 03:27:36.
 */
class ConnectionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test httpError().
     */
    public function testHttpError()
    {
        $method = new \ReflectionMethod('Social\Connection', 'httpError'); 
        $method->setAccessible(true);
 
        $this->assertEquals("Some error (500)", $method->invoke(null, 500, '', 'Some error'));
        $this->assertEquals("(500)", $method->invoke(null, 500, 'text/html', '<html>Some error</html>'));
        $this->assertEquals("Some error (500)", $method->invoke(null, 500, 'text/plain', 'Some error'));
        
        $this->assertEquals("Some error", $method->invoke(null, 500, 'application/json', '"Some error"'));
        $this->assertEquals("Some error", $method->invoke(null, 500, 'application/json', '{ "error": "Some error" }'));
        $this->assertEquals("Some error", $method->invoke(null, 500, 'application/json', '{ "error": { "message": "Some error" } }'));
        $this->assertEquals("Some error", $method->invoke(null, 500, 'application/json', '{ "errors": [ "Some error" ] }'));
        $this->assertEquals("Some error", $method->invoke(null, 500, 'application/json', '{ "errors": [ { "message": "Some error" } ] }'));
        $this->assertEquals("Some error", $method->invoke(null, 500, 'application/json', '{ "error_msg": "Some error" }'));
        
        $this->assertEquals('{ "unexpected": "json" }', $method->invoke(null, 500, 'application/json', '{ "unexpected": "json" }'));
    }
    
    /**
     * Test extractParams().
     */
    public function testExtractParams()
    {
        $method = new \ReflectionMethod('Social\Connection', 'extractParams'); 
        $method->setAccessible(true);
 
        $this->assertEquals(array(), $method->invoke(null, 'http://www.example.com'));
        $this->assertEquals(array('foo'=>'bar', 'fox'=>'dog'), $method->invoke(null, 'http://www.example.com?foo=bar&fox=dog'));
    }
}
