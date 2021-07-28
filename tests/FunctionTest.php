<?php

use PHPUnit\Framework\TestCase;

final class FunctionTest extends TestCase
{
    public function testExample()
    {
        $this->assertTrue(true);
        $this->assertFalse(false);
    }

    public function test_add_redirect_hosts()
    {
        $this->assertTrue(function_exists('add_redirect_hosts'));
    }

    public function test_forwarded_attachments_url()
    {
        $returns = forwarded_attachments_url( 'http://internal.com' );
        $this->assertEquals($returns, 'https://editorial.com');
    }

    public function test_forwarded_site_url()
    {
        $returns = forwarded_site_url( 'http://internal.com' );
        $this->assertEquals($returns, 'https://editorial.com');
    }

    public function test_forwarded_network_domain()
    {
        $network = new stdClass();
        $network->domain = 'internal.com';
        $network->cookie_domain = 'internal.com';
        $returns = forwarded_network_domain( $network );
        $this->assertEquals($returns->domain, 'editorial.com');
    }

    public function test_forwarded_network_domain_cookie()
    {
        $network = new stdClass();
        $network->domain = 'internal.com';
        $network->cookie_domain = 'internal.com';
        $returns = forwarded_network_domain( $network );
        $this->assertEquals($returns->cookie_domain, 'editorial.com');
    }
}
