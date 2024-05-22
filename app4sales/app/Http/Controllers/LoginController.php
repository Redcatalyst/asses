<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\App4Sales\AppAuth;
use App\Models\App4Sales\AppData;
 
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
        if($app->checkIfUserExists($credentials['username']))
        {
            if(!empty($app->getRights()))
            {
                $data = new AppData($credentials['username'], $credentials['password'], 'items');
                $content = $data->retrieveData();
                // Todo:: Process front-end and proper rights handling for showing items. 
            } else {
                // Todo:: Send proper response back (No rights or API validation failed)
                return back();
            }

        } else {
            // Todo:: Send proper response back (invalid login credentials, unknown to app)
            return back();
        }
        
    }
}