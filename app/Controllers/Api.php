<?php

namespace App\Controllers;

use App\Models\ProductModel;
use CodeIgniter\RESTful\ResourceController;

class Api extends ResourceController
{

    protected $format = 'json';


    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $model = new ProductModel();

        return $this->respond($model->paginate(), 200, 'API Connected');
    }

    public function getTopProducts()
    {
        $model = new ProductModel();

        if ($this->request->getGet('limit') === null){
            $limit = 5;
        } else {
            $limit = $this->request->getGet('limit');
        }

        switch ($this->request->getGet("type")):
            case 'price':
                return $this->respond($model->orderBy('price', 'DESC')->findAll($limit), 200, 'API Connected');

            case 'qty':
                return $this->respond($model->orderBy('QTY', 'DESC')->findAll($limit), 200, 'API Connected');

            case null:
                return $this->fail('You need to submit a type');

            endswitch;
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        //
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        //
    }
}
