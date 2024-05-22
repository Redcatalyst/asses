<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\App4Sales\AppAuth;

class TestAuth extends TestCase
{
    /**
     * A basic test example.
     */
    public function testLoginEventOnUnknowUserAndPass(): void
    {
        $app = new AppAuth();
        $app->authenticate('test','test');

        $this->assertTrue($app->endpoint == 'authenticate');
        $this->assertTrue($app->getRights() == '');
    }
}
