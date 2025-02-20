<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <form action="{{route('products.store')}}" method="POST">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="product_name" id="name">
        <br>
        <label for="price">Price</label>
        <input type="text" name="price" id="price">
        <br>
        <button type="submit">Submit</button>
    </form>
    
</body>
</html>