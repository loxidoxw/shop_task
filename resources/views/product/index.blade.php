
    <div>
    @foreach ($products as $product)
        <div>{{$product -> name }} - {{$product -> description}}</div>
    @endforeach
    </div>
