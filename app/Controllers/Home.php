<?php

namespace App\Controllers;



use CodeIgniter\HTTP\CURLRequest;
use Config\Services;
use voku\helper\HtmlDomParser;

class Home extends BaseController
{
    public function index()
    {
        return view("Stats/index");
    }

    public function currency()
    {

        $dom = HtmlDomParser::file_get_html('https://www.cbe.org.eg/ar/EconomicResearch/Statistics/Pages/ExchangeRatesListing.aspx');
        $element = $dom->getElementByClass('table')->innerHtml();

        return view('Stats/currency', [
            'data' => $element
        ]);
    }
}
