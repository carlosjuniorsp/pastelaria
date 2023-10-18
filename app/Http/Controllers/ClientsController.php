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

    public function index()
    {
        $clients = $this->model->all();
        return response()->json($clients);
    }

    public function show($id)
    {
        $client = $this->model->findOrFail($id);
        return response()->json($client);
    }

    public function store(Request $request)
    {

        $this->validateForm($request);
        $client = $this->model->create($request->all());
        return response()->json($client);
    }

    public function update($id, Request $request)
    {
        $this->validateForm($request);
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


    private function validateForm($request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:100',
            'email' => 'email|unique:clients|max:100|required',
            'phone' => 'required|min:12|max:12',
            'date_of_birth' => 'required',
            'address' => 'required|min:3|max:100',
            'complement' => 'required|min:3|max:50',
            'district' => 'required|min:3|max:100',
            'zip_code' => 'required|min:3|max:9',

        ], [
            'required' => "O :attribute é obrigatório",
            'email' => "Informe um :attribute válido",
            "min" => "O :attribute deve ter no mínimo :min caracteretes",
            "max" => "O :attribute deve ter no máximo :max caracteretes",
            "email.unique" => "Já existe um :attribute igual cadastrado, tente outro!"

        ]);
    }
}
