<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;

Route::get('/', [HomeController::class, 'test']);
Route::get('/hello-word', [HomeController::class, 'index']); // ⚠️ Chỉ giữ 1 lần
Route::get('/test', [HomeController::class, 'test']);
Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/listproduct', [ProductController::class, 'index']);
Route::get('/loai-san-pham/{idLoaiSanPham}', [HomeController::class, 'tinTrongLoai']); // Thêm route này

// Route DB: Lấy bản ghi đầu tiên
Route::get('/category-first', function () {
    $query = DB::table('categories')->select('id', 'name');
    $kq = $query->first();
    print_r($kq);
    echo "<h4>{$kq->name}</h4>";
});

// Route DB2: Lấy danh sách tất cả
Route::get('/db2', function () {
    $query = DB::table('categories')->select('id', 'name');
    $kq = $query->get();

    foreach ($kq as $item) {
        echo "<h4>{$item->name}</h4><hr>";
    }
});

// Route DB3: Hiển thị select option
Route::get('/db3', function() {
    $kq = DB::table('categories')->pluck('name', 'id');

    echo "<select>";
    foreach ($kq as $key => $option) {
        echo "<option value='$key'>$option</option>";
    }
    echo "</select>";
});

// Route DB4: Hiển thị select option theo status
Route::get('/db4', function() {
    $kq = DB::table('categories')
        ->select('id', 'name')
        ->where('status', 1)
        ->get();

    echo "<select>";
    foreach ($kq as $option) {
        echo "<option value='{$option->id}'>{$option->name}</option>";
    }
    echo "</select>";
});

// Route DB8: Join bảng sản phẩm & danh mục
Route::get('/db8', function(){
    $query = DB::table('products')
        ->join('categories', 'category_id', '=', 'products.category_id')
        ->select('products.title', 'categories.name');
    $kq = $query->get();

    foreach ($kq as $row) {
        echo "Sản phẩm {$row->title} thuộc danh mục {$row->name}<br>";
    }
});

// Route DB9: Kiểm tra tồn tại tên danh mục
Route::get('/db9/{name}', function($name){
    $kq = DB::table('categories')
        ->where('name', $name)
        ->exists();

    echo $kq ? 'Tồn tại' : 'Không tồn tại';
});

// Route DB10: Thêm mới danh mục với slug
Route::get('/db10', function(){
    $title = "Danh mục vừa thêm lúc " . date('d/m/Y H:i:s');

    DB::table('categories')->insert([
        'name' => $title,
        'slug' => Str::slug($title),
        'description' => 'Assumenda aut iusto asperiores et eos voluptatem voluptas...',
        'status' => 1
    ]);

    echo "✅ Đã thêm danh mục: $title";
});
