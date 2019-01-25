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
}
