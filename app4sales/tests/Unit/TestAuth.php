<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\App4Sales\AppAuth;
use Illuminate\Support\Facades\DB;

class TestAuth extends TestCase
{
    /**
     * A basic test to validate if unknow/unauthorized logins are handled correctly 
     */
    public function testLoginEventOnUnknowUserAndPass(): void
    {
        $username = 'test';
        $password = 'test';
        $app = new AppAuth();
        $app->authenticate($username, $password);

        $this->assertTrue($app->endpoint == 'authenticate');
        $this->assertFalse($app->checkIfUserExists($username));
        $this->assertTrue($app->assertAdminRights() == false);
    }
}
