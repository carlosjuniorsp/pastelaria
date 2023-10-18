<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\Products;

class OrdersController extends Controller
{

    private $model;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Orders $orders)
    {
        $this->model = $orders;
    }

    /**
     * Show all customers
     * @param integer $id
     * @param Request $request
     * @return json
     */
    public function index()
    {
        $orders = $this->model->all();
        if (count($orders) <= 0) {
            return [
                'message' => 'Nenhum pedido foi encontrado!',
                'status' => 200
            ];
        }
        return response()->json($orders);
    }

    /**
     * Shows a single customer
     * @param integer $id
     * @return json
     */
    public function show($id)
    {
        $order = $this->model->find($id);
        if (empty($order)) {
            return [
                'message' => 'Nenhum pedido foi encontrado com o parâmetro: ' . $id,
                'status' => 200
            ];
        }
        $client = $order->client()->first();

        $products = new Products();
        $result = [];
        foreach ($order->product_id as $product_id) {
            $products = $products->find($product_id);
            $result[] = [
                'name' => $products->name,
                'price' => $products->price
            ];
        }

        if ($client) {
            return response()->json(
                [
                    'orders' => $order->id,
                    'client' => [
                        'id' => $client->id,
                        'name' => $client->name,
                        'phone' => $client->phone,
                    ],
                    'products' => $result
                ]
            );
        }
    }

    /**
     * Create the order
     * @param integer $id
     * @param Request $request
     * @return json
     */
    public function store(Request $request)
    {
        $this->validateForm($request);
        $order = $this->model->create($request->all());
        return response()->json($order);
    }

    /**
     * Update the order
     * @param integer $id
     * @param Request $request
     * @return json
     */
    public function update($id, Request $request)
    {
        $order = $this->model->find($id);
        if (empty($order)) {
            return [
                'message' => 'Não foi possível atualizar os dados, o pedido não existe!',
                'status' => 200
            ];
        }

        $this->validateForm($request);
        $order->update($request->all());
        return response()->json($order);
    }

    /**
     * Create a softdeleted with the order
     * @param integer $id
     * @return json
     */
    public function destroy($id)
    {
        $order = $this->model->find($id);
        if (empty($order)) {
            return [
                'message' => 'Não foi possível deletar os dados, o pedido não existe!',
                'status' => 200
            ];
        }
        $order->delete();
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
            'client_id' => 'required',
            'product_id' => 'required',
        ], [
            'required' => "O :attribute é obrigatório",
        ]);
    }
}
