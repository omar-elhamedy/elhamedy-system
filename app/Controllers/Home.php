<?php

namespace App\Controllers;



use CodeIgniter\HTTP\CURLRequest;

class Home extends BaseController
{
    public function index()
    {
        return view("Stats/index");
    }

    public function currency()
    {
        $app_id = '64a0e30b9e6d4623806fe4a5d3d42e19';
        $oxr_url = "https://openexchangerates.org/api/latest.json?app_id=" . $app_id . "&base=USD&symbols=EGP";

        $options = [
            'baseURI' => 'https://openexchangerates.org/api/latest.json',
            'timeout'  => 3,
        ];
        $curl = new curlRequest(
            new \Config\App(),
            new \CodeIgniter\HTTP\URI(),
            new \CodeIgniter\HTTP\Response(new \Config\App()),
            $options
        );
        $response = $curl->request('GET', $oxr_url);


        return view('Stats/currency', [
            'data' => json_decode($response->getBody())
        ]);
    }
}
