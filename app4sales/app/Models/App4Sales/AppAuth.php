<?php
namespace App\Models\App4Sales;

use Illuminate\Support\Facades\DB;

class AppAuth extends Base
{

    /**
     * Set rights
     *
     * @var string
     */
    private string $rights = '';

    /**
     * Base constructor
     */
    public function __construct() 
    {
        $this->setEndpoint('authenticate');
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
        $this->setUsername($username);
        $this->setPassword($password);
        $this->sendAuthRequest();
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

    /**
     * Send an auth request to check if the user is known
     * @return void
     */
    private function sendAuthRequest()
    {
        $request = $this->sendRequest();
        if(!$request['error'] && $request['code'] == 200){
            $this->setRights($this->username);
        }
        $this->storeRequest($this->username, $request);
    }

    /**
     * Retrieves the rights from the DB if they are present and sets them in the class. 
     *
     * @return void
     */
    private function setRights()
    {
        $user = $this->getUserRecordForUsername($this->username);
        if(!empty($user))
        {
            $this->rights = $user->rights;
        }
    }

    /**
     * Check if the username exists
     *
     * @param string $username
     * @return boolean True if exists, false if not
     */
    public function checkIfUserExists(string $username)
    {
        return !empty($this->getUserRecordForUsername($username));
    }

    /**
     * Get user record if exists
     *
     * @param [type] $username
     * @return void
     */
    private function getUserRecordForUsername($username)
    {
        return DB::table('users')->where('username', $username)->first();
    }

    /**
     * Assert admin rights
     *
     * @return void
     */
    public function assertAdminRights()
    {
        return $this->getRights() == 'all';
    }

    /**
     * Get Rights
     *
     * @return void
     */
    public function getRights()
    {
        return $this->rights;
    }

}