<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Products</title>
</head>
<body>


    <div style="display: flex; gap:3">
        @foreach ($products as $product)
            <div style="width: 100%; height:200px; border:1px solid black; background: #ddd;padding:10px; margin:5px;">
                <img src="{{ $product->image }}" alt="">
                <h3>{{ $product->name }}</h3>
                <p>{{ $product->description }}</p>
                <p>{{ $product->price }}</p>
            </div>
        @endforeach
    </div>

    <div class="div" style="display: flex; gap:3; margin:5px;">
        <form action="{{ route('checkout') }}" method="POST">
            @csrf
            <input type="submit" value="Checkout">
        </form>
    </div>

</body>
</html>
