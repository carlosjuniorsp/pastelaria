<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;

class ProductsController extends Controller
{

    private $model;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Products $products)
    {
        $this->model = $products;
    }

    /**
     * Show all customers
     * @param integer $id
     * @param Request $request
     * @return json
     */
    public function index()
    {
        $products = $this->model->all();
        if (count($products) <= 0) {
            return [
                'message' => 'Nenhum produto foi encontrado!',
                'status' => 200
            ];
        }
        return response()->json($products);
    }

    /**
     * Shows a single customer
     * @param integer $id
     * @return json
     */
    public function show($id)
    {
        $product = $this->model->find($id);
        if (empty($product)) {
            return [
                'message' => 'Nenhum produto foi encontrado com o parâmetro: ' . $id,
                'status' => 200
            ];
        }
        return response()->json($product);
    }

    /**
     * Create the product
     * @param integer $id
     * @param Request $request
     * @return json
     */
    public function store(Request $request)
    {
        $this->validateForm($request);
        $this->model->name = $request->name;
        $this->model->price = $request->price;
        $this->model->photo = $request->file('photo')->store('photos', 'public');
        $this->model->save();
        return response()->json($this->model);
    }

    /**
     * Update the product
     * @param integer $id
     * @param Request $request
     * @return json
     */
    public function update($id, Request $request)
    {
        $product = $this->model->find($id);
        if (empty($product)) {
            return [
                'message' => 'Não foi possível atualizar os dados, o produto (' . $id . ') não existe!',
                'status' => 200
            ];
        }

        $this->validateForm($request);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->photo = $request->file('photo')->store('photos', 'public');
        $product->save();
        return response()->json($product);
    }

    /**
     * Create a softdeleted with the product
     * @param integer $id
     * @return json
     */
    public function destroy($id)
    {
        $product = $this->model->find($id);

        if (empty($product)) {
            return [
                'message' => 'Não foi possível deletar os dados, o produto (' . $id . ') não existe!',
                'status' => 200
            ];
        }
        $product->delete();
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
            'price' => 'required',
            'photo' =>  'image|mimes:jpeg,png|required',

        ], [
            'required' => ":attribute é obrigatório",
            "min" => "O :attribute deve ter no mínimo :min caracteretes",
            "max" => "O :attribute deve ter no máximo :max caracteretes",
            "mimes" => "Formato de imagem inválido",
            "photo" => "O arquivo deve ser uma imagem"
        ]);
    }
}
