<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clients;

class ClientsController extends Controller
{

    private $model;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Clients $clients)
    {
        $this->model = $clients;
    }

    public function getAll()
    {
        $clients = $this->model->all();
        return response()->json($clients);
    }

    public function get($id)
    {
        $client = $this->model->find($id);
        return response()->json($client);
    }

    public function store(Request $request)
    {
        $client = $this->model->create($request->all());
        return response()->json($client);
    }

    public function update($id, Request $request)
    {
        $client = $this->model->find($id)
            ->update($request->all());
        return response()->json($client);
    }

    public function destroy($id)
    {
        $this->model->find($id)
            ->delete();
        return response()->json(null);
    }
}
