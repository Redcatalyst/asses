<?php
namespace App\Models\App4Sales;

use Illuminate\Support\Facades\DB;

class AppData extends Base
{

    /**
     * Base constructor
     */
    public function __construct(string $type) 
    {
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

}