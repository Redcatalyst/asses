<?php
namespace App\Models\App4Sales;

use Illuminate\Support\Facades\DB;

class AppData extends Base
{

    /**
     * Setup basic data request class
     *
     * @param string $username
     * @param string $password
     * @param string $type
     */
    public function __construct(string $username, string $password, string $type) 
    {
        $this->setUsername($username);
        $this->setPassword($password);
        if($type == 'items')
        {   
            $this->setItemsEndpoint();
        }
    }

    /**
     * Set endpoint for items
     *
     * @return void
     */
    private function setItemsEndpoint()
    {
        $this->endpoint = 'items?skip=0';
    }

    /**
     * Return data from API or an empty array
     *
     * @return array
     */
    public function retrieveData()
    {
        $request = $this->sendRequest();
        $this->storeRequest($this->username, $request);
        dd($request);
        return $request['response'] ?? [];
    }

}