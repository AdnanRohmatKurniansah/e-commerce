<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome', [
        'title' => 'Homepage'
    ]);
});

Route::get('/products', function () {
    return view('products', [
        'title' => 'Products',
        'products' => Product::orderBy('id', 'desc')->filter(request(['search']))->paginate(6),
        'categories' => Category::all(),
        'colors' => ['Black', 'White', 'Brown', 'Gray', 'Blue', 'Red', 'Green', 'Yellow', 'Pink', 'Purple'],
        'sizes' => ['32', '33', '34', '35', '36', '37', '38', '39', '40', '41', '42', '43', '44', '45', 'S', 'M', 'L', 'XL', 'XXL']
    ]);
});

Route::get('/product/{product:slug}', function (Product $product) {
    return view('product', [
        'title' => 'Product Detail',
        'product' => $product
    ]);
});

Route::get('/filter-products', [ProductController::class, 'filter']);

Route::get('/blog', function () {
    return view('blog', [
        'title' => 'Blog',
        'blogCategories' => BlogCategory::all(),
        'blogs' => Blog::filter(request(['search', 'blogCategory']))->paginate(3),
        'lblogs' => Blog::orderBy('id', 'desc')->get()
    ]);
});

Route::get('/blogDetail/{blog:slug}', function(Blog $blog) {
    return view('blogDetail', [
        'title' => 'Blog Detail',
        'blog' => $blog,
        'blogCategories' => BlogCategory::all(),
        'lblogs' => Blog::orderBy('id', 'desc')->get()
    ]);
});

Route::get('/contact', function () {
    return view('contact', [
        'title' => 'Contact'
    ]);
});
Route::middleware(['guest'])->group(function() {
    Route::get('/login', [AuthController::class, 'login']);
    Route::post('/login', [AuthController::class, 'auth']);
    Route::get('/register', [AuthController::class, 'register']);
    Route::post('/register', [AuthController::class, 'store']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::post('/add_cart/{product:slug}', [CartController::class, 'add_cart']);
Route::get('/show_cart', [CartController::class, 'show_cart']);
Route::delete('/remove_cart/{cart:id}', [CartController::class, 'remove_cart']);
Route::put('/update_cart/{id}', [CartController::class, 'update_cart']);
Route::get('/checkout', [OrderController::class, 'show_checkout']);
Route::post('/checkout/getRegencies', [OrderController::class, 'getRegencies']);
Route::post('/checkout/getDistricts', [OrderController::class, 'getDistricts']);
Route::post('/checkout/getVillages', [OrderController::class, 'getVillages']);
Route::post('/checkout/cost', [OrderController::class, 'cost']);


Route::middleware(['auth', 'admin'])->prefix('dashboard')->group(function () {
    Route::get('/', function () {
        return view('dashboard.index');
    });
    Route::get('/products/categories/checkSlug', [CategoryController::class, 'checkSlug']);
    Route::resource('/products/categories', CategoryController::class)->except('show');
    Route::get('/products/checkSlug', [ProductController::class, 'checkSlug']);
    Route::resource('/products', ProductController::class)->except('show');
    Route::get('/blogs/categories/checkSlug', [BlogCategoryController::class, 'checkSlug']);
    Route::resource('/blogs/categories', BlogCategoryController::class);
    Route::get('/blogs/checkSlug', [BlogController::class, 'checkSlug']);
    Route::resource('/blogs', BlogController::class);
});
