<?php

namespace App\Models\App4Sales;

class Base
{

    /**
     * Base URL for the App
     *
     * @var string
     */
    protected string $base_url = 'https://api.app4sales.net/demo/api/app4sales/';

    /**
     * Username
     *
     * @var string
     */
    protected string $username = '';

    /**
     * Password
     *
     * @var string
     */
    private string $password = '';

    /**
     * Endpoint
     *
     * @var string
     */
    public string $endpoint = '';


    /**
     * Undocumented function
    *
    * @param string $type
    * @param array $post_data
    * @return void
    */
    protected function sendRequest(string $type = 'GET', array $post_data = [])
    {
        $ch = curl_init($this->base_url . $this->endpoint);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_USERPWD, $this->username . ":" . $this->password);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        if($type == 'POST')
        {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        }

        $response = curl_exec ($ch);
        $error = curl_error($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close ($ch);

        return ['response' => json_decode($response, true), 'error' => $error, 'code' => $httpcode];
    }

    /**
     * Set username
     *
     * @param string $username
     * @return void
     */
    protected function setUsername(string $username){
        $this->username = $username;
    }

    /**
     * Undocumented function
     *
     * @param string $password
     * @return void
     */
    protected function setPassword(string $password)
    {
        $this->password = $password;
    }
}