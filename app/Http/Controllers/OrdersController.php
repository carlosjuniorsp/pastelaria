<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\Products;
use App\Mail\SendMailOrder;

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
     * Show all orders
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
     * Displays an order
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
        return $this->orderStructure($client, $order);
    }

    /**
     * Create the order
     * @param integer $id
     * @param Request $request
     * @return json
     */
    public function store(Request $request)
    {
        $data_client = $this->validateClient($request['client_id']);
        if (!$data_client) {
            return [
                "message" => "O client (" . $request['client_id'] . ") Não existe, portanto o pedido não pode ser feito!",
                'status' => 200
            ];
        }

        $products = new Products();
        foreach ($request['product_id'] as $product_id) {
            $products = $products->find($product_id);
            if (empty($products)) {
                return [
                    "message" => "O produto (" . $product_id . ") Não existe, portanto o pedido não pode ser feito!",
                ];
            }
        }

        $this->validateForm($request);
        $orders = $this->model->create($request->all());
        if ($orders) {
            $client = $orders->client()->first();
            $data_email = $this->orderStructure($client, $orders);
            $sendMailOrder = new SendMailOrder();
            $sendMailOrder->mailSend($data_email);
        }
        return response()->json($orders);
    }

    /**
     * Update the order
     * @param integer $ids
     * @param Request $request
     * @return json
     */
    public function update($id, Request $request)
    {
        $order = $this->model->find($id);
        if (empty($order)) {
            return [
                'message' => 'Não foi possível atualizar os dados, o pedido (' . $id . ') não existe!',
                'status' => 200
            ];
        }

        $data_client = $this->validateClient($request['client_id']);
        if (!$data_client) {
            return [
                'message' => 'O pedido não ser atualizado, o cliente (' . $request['client_id'] . ') não existe!',
                'status' => 200
            ];
        }

        $products = new Products();
        foreach ($request['product_id'] as $product_id) {
            $products = $products->find($product_id);
            if (empty($products)) {
                return [
                    "message" => "O produto (" . $product_id . ") Não existe, portanto o pedido não pode ser atualizado!",
                ];
            }
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
                'message' => 'Não foi possível deletar os dados, o pedido (' . $id . ') não existe!',
                'status' => 200
            ];
        }
        $order->delete();
        return response()->json([
            'message' => 'O pedido (' . $id . ') foi deletado com sucesso!',
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

    /**
     * Get client by id
     * @return Client
     * @param integer $client_id
     */
    private function validateClient($client_id)
    {
        $client = new Clients();
        return $client->find($client_id);
    }

    /**
     * Assemble the order structure
     * @param Client $client
     * @param Order $order
     * @return json
     */
    private function orderStructure($client, $orders)
    {
        $products = new Products();
        $result = [];
        foreach ($orders->product_id as $product_id) {
            $products = $products->find($product_id);
            $result[] = [
                'name' => $products->name,
                'price' => $products->price
            ];
        }

        if ($client && $result) {
            return
                [
                    'order' => $orders->id,
                    'client' => [
                        'id' => $client->id,
                        'name' => $client->name,
                        'phone' => $client->phone,
                    ],
                    'product' => $result
                ];
        }
    }
}
