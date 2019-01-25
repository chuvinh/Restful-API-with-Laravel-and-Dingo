<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServerController extends Controller
{
    /**
     * Checking API Health
     * @return mixed
     */
    public function ping()
    {
        return $this->success();
    }

    /**
     * Get the application version
     * @return mixed
     */
    public function version()
    {
        if(file_exists(base_path('version')))
        {
            return $this->success(file_get_contents(base_path('version')));
        }
        return $this->success('dev');
    }
}
