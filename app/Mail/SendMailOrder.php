<?php

namespace App\Mail;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use \Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;

class SendMailOrder
{
    /**
     * Structure and sending by email
     */
    public function mailSend($data_order)
    {
        $product = [];
        $total_order = 0;
        foreach ($data_order['product'] as $products) {
            $total_order += $products['price'];
            $product[] = $products;
        }

        $data = [
            'order' => $data_order['order'],
            'client_name' => $data_order['client']['name'],
            'product' =>  $product,
            'total_order' =>  'R$ ' . number_format($total_order, 2, ',', '.')
        ];

        try {
            Mail::send('emails.mail', $data, function (Message $message) {
                $message->to('devcarlosjrmca@gmail.com', 'Pastelaria Modelo')
                    ->from('devcarlosjrmca@gmail.com', 'Pastelaria Modelo')
                    ->subject('Pedido Cadastrado');
            });
        } catch (NotFoundHttpException $exception) {
            return $exception->getMessage();
        }
    }
}
