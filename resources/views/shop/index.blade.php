<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Tickets</h1>
    @foreach ($products as $product)
        <div>
            <h2>{{ $product['name'] }}</h2>
            <p>€{{ number_format($product['price'], 2) }}</p>
            <a href="{{ route('payment.prepare', ['id' => $product['id']]) }}">Buy Now</a>
        </div>
    @endforeach
</body>
</html>