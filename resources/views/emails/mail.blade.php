<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="utf-8" />
</head>

<body>
    <h2>Um novo pedido foi cadastrado!</h2>
    <div>
        <b>Número do pedido: {{ $order }}</b><br>
        <b>Nome do cliente: {{ $client_name }}</b><br>
        <b>Itens do pedido: <br>
            @foreach ($product as $products)
                <ul>
                    <li>Nome: {{ $products['name'] }} -
                        Preço: {{ 'R$ ' . number_format($products['price'], 2, ',', '.') }}
                    </li>
                </ul>
            @endforeach

            <span style="color:#f00">Total do Pedido: {{ $total_order }}</span>
    </div>
</body>

</html>
