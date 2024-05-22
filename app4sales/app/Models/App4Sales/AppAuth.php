<?php
namespace App\Models\App4Sales;

use Illuminate\Support\Facades\DB;

class AppAuth extends Base
{

    public string $endpoint = '';
    private string $rights = '';

    /**
     * Base constructor
     */
    public function __construct() 
    {
        //
    }

    /**
     * Authenticate using a username and password
     *
     * @param string $username
     * @param string $password
     * @return void
     */
    public function authenticate(string $username, string $password)
    {
        $this->setEndpoint('authenticate');
        $this->sendAuthRequest($username, $password);
    }

    /**
     * Sets the endpoint
     *
     * @param string $endpoint
     * @return void
     */
    private function setEndpoint(string $endpoint)
    {
        $this->endpoint = $endpoint;
    }

    private function sendAuthRequest($username, $password)
    {
        $ch = curl_init($this->base_url . $this->endpoint);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec ($ch);
        $err = curl_error($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if(!$err && $httpcode == 200){
            $this->setRights($username);
        }

        curl_close ($ch);
    }

    /**
     * Retrieves the rights from the DB if they are present and sets them in the class. 
     *
     * @param string $username
     * @return void
     */
    private function setRights(string $username)
    {
        $user = DB::table('users')->where('usename', $username)->first();
        if($user->rights)
        {
            $this->rights = $user->rights;
        }
    }

}