<?php

namespace App\Models\App4Sales;

class AppAuth extends Base
{

    public string $endpoint = '';

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
        $return = curl_exec($ch);
        curl_close($ch);
    }

}