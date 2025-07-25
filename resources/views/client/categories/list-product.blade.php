@extends('client.layout.master')

@section('meta-title')
    Trang tin loại
@endsection

@section('content')
    <h2>Danh sách sản phẩm</h2>

    @foreach ($products as $pro)
        <p>
            <a href="/chi-tiet-san-pham/{{ $pro->id }}">{{ $pro->title }}</a>
        </p>
    @endforeach
@endsection
