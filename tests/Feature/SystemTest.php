<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SystemTest extends TestCase
{

    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testPing()
    {
        $response = $this->get('/api/status/ping');
        $response->assertStatus(200);
    }
}
