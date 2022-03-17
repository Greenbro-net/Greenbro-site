<?php

use PHPUnit\Framework\TestCase;

class SampleTest extends TestCase
{
    public function testTrueAssertsToTrue()
    {
        $this->assertTrue(true);         
    }

    public function testFalseAssertsToFalse()
    {
        $this->assertFalse(false);
    }
}