<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Notification extends BaseController
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
        //
    }
}
