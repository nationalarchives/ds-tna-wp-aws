<?php

use PHPUnit\Framework\TestCase;

final class FunctionTest extends TestCase
{
    public function testExample()
    {
        $this->assertTrue(true);
        $this->assertFalse(false);
    }

    public function test_exists_tna_styles()
    {
        $this->assertTrue(function_exists('add_redirect_hosts'));
    }
}