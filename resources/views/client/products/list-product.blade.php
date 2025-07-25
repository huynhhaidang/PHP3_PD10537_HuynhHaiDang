@extends('client.layout.master')
@extends('content')
    @foreach ($products as $pro)
        <p><a href="/chi-tiet-san-pham/{{$pro->$id}}">{{$pro->$title}}</a></p>
    @endforeach
@section('meta-title')
    Trang tin loại
@endsection