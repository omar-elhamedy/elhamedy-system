<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Report extends BaseController
{

    public function index()
    {
        getTop5MaterialinQTY();
        return view("Reports/index");
    }
}
