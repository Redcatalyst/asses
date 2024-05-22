<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\App4Sales\AppAuth;
 
class LoginController extends Controller
{
    /**
     * Handle authentication
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
        
        $app = new AppAuth();
        $app->authenticate($credentials['username'], $credentials['password']);

        if($app->assertAdminRights())
        {
            // Show special content
        } 

        dd($app->assertAdminRights());

        return back();
    }
}