<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Report extends BaseController
{
    public function __construct()
    {
        helper([
            'form',
            'date',
            'size',
            'storage',
            'material',
            'type',
            'unit',
            'brand',
            'color',
            'meta',
            'client',
            'bookmark'
        ]);

    }
    public function index()
    {
        getTop5MaterialinQTY();
        return view("Reports/index");
    }
}
