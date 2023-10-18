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

    /**
     * Show all customers
     * @param integer $id
     * @param Request $request
     * @return json
     */
    public function index()
    {
        $clients = $this->model->all();
        if (count($clients) <= 0) {
            return [
                'message' => 'Nenhum cliente foi encontrado!',
                'status' => 200
            ];
        }
        return response()->json($clients);
    }

    /**
     * Shows a single customer
     * @param integer $id
     * @return json
     */
    public function show($id)
    {
        $client = $this->model->find($id);
        if (empty($client)) {
            return [
                'message' => 'Nenhum cliente foi encontrado com o parâmetro: ' . $id,
                'status' => 200
            ];
        }
        return response()->json($client);
    }

    /**
     * Create the client
     * @param integer $id
     * @param Request $request
     * @return json
     */
    public function store(Request $request)
    {
        $this->validateForm($request);
        $client = $this->model->create($request->all());
        return response()->json($client);
    }

    /**
     * Update the client
     * @param integer $id
     * @param Request $request
     * @return json
     */
    public function update($id, Request $request)
    {
        $client = $this->model->find($id);
        if (empty($client)) {
            return [
                'message' => 'Não foi possível atualizar os dados, o cliente não existe!',
                'status' => 200
            ];
        }

        $this->validateForm($request);
        $client->update($request->all());
        return response()->json($client);
    }

    /**
     * Create a softdeleted with the client
     * @param integer $id
     * @return json
     */
    public function destroy($id)
    {
        $client = $this->model->find($id);
        if (empty($client)) {
            return [
                'message' => 'Não foi possível deletar os dados, o cliente não existe!',
                'status' => 200
            ];
        }
        $client->delete();
        return response()->json([
            'message' => 'Os dados foram deletados com sucesso!',
            'status' => 200
        ]);
    }

    /**
     * Validate form data
     * @param Request $request
     * @return json
     */
    private function validateForm($request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:100',
            'email' => 'required|unique:clients,email,' . $request->id,
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
