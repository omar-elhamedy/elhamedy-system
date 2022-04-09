<?php

namespace App\Controllers;



use App\Models\BookmarkModel;
use CodeIgniter\HTTP\CURLRequest;
use Config\Services;
use voku\helper\HtmlDomParser;

class Home extends BaseController
{

    public function index()
    {
        return view("Stats/index");
    }

    public function addBookmark()
    {
        $uri = $this->request->getPost('uri');
        $title = $this->request->getPost('title');
        $model = new BookmarkModel();
        $result = $model->insert([
            'uri' => $uri,
            'uri_title' => $title
        ]);
        if (!$result){
            return redirect()
                ->to($uri)
                ->with('warning', 'لم يتم حفظ الرابط');
        } else {
            return redirect()
                ->to($uri)
                ->with('info', 'تم حفظ الرابط');
        }
    }

    public function removeBookmark()
    {
        $uri = $this->request->getPost('uri');

        $model = new BookmarkModel();
        $bookmarkID = $model->where('uri', $uri)->first()->id;
        $result = $model->delete($bookmarkID);
        if (!$result){
            return redirect()
                ->to($uri)
                ->with('warning', 'لم يتم حذف الرابط');
        } else {
            return redirect()
                ->to($uri)
                ->with('info', 'تم حذف الرابط');
        }
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
