<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InterfaceController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Feature;
use App\Models\Gallery;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductComment;
use App\Models\Review;
use App\Models\Slide;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        'title' => 'Homepage',
        'slides' => Slide::orderBy('id', 'desc')->get(),
        'features' => Feature::orderBy('id', 'desc')->get(),
        'galleries' => Gallery::orderBy('id', 'desc')->get(),
        'brands' => Brand::orderBy('id', 'desc')->get(),
        'products' => Product::latest()->paginate(8),
    ]);
});

Route::get('/products', function () {
    return view('products', [
        'title' => 'Products',
        'products' => Product::latest()->filter(request(['search']))->paginate(12),
        'categories' => Category::all(),
        'colors' => ['Black', 'White', 'Brown', 'Gray', 'Blue', 'Red', 'Green', 'Yellow', 'Pink', 'Purple'],
        'sizes' => ['32', '33', '34', '35', '36', '37', '38', '39', '40', '41', '42', '43', '44', '45', 'S', 'M', 'L', 'XL', 'XXL']
    ]);
});

Route::get('/product/{product:slug}', function (Product $product) {
    return view('product', [
        'title' => 'Product Detail',
        'product' => $product,
        'productComments' => ProductComment::where('product_id', $product->id)->get(),
        'reviews' => Review::where('product_id', $product->id)->get(),
    ]);
});

Route::get('/filter-products', [ProductController::class, 'filter']);
Route::get('/sort-products', [ProductController::class, 'sort']);
Route::get('/filter-range', [ProductController::class, 'filterRange']);

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
        'lblogs' => Blog::orderBy('id', 'desc')->get(),
        'blogComments' => BlogComment::where('blog_id', $blog->id)->get()
    ]);
});

Route::get('/contact', function () {
    return view('contact', [
        'title' => 'Contact',
        'contacts' => Contact::all()
    ]);
});
Route::middleware(['guest'])->group(function() {
    Route::get('/login', [AuthController::class, 'login']);
    Route::post('/login', [AuthController::class, 'auth']);
    Route::get('/register', [AuthController::class, 'register']);
    Route::post('/register', [AuthController::class, 'store']);
});

Route::middleware('auth')->group(function() {
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::put('/update_profile', [AuthController::class, 'update_profile']);
    Route::post('/update_password', [AuthController::class, 'update_password']);
});

Route::post('/addReview', [ReviewController::class, 'addReview']);
Route::post('/addProductComment', [ProductController::class, 'addComment']);
Route::post('/addMessage', [MessageController::class, 'addMessage']);
Route::post('/addComment', [BlogController::class, 'addComment']);
Route::post('/add_cart/{product:slug}', [CartController::class, 'add_cart']);
Route::get('/show_cart', [CartController::class, 'show_cart']);
Route::delete('/remove_cart/{cart:id}', [CartController::class, 'remove_cart']);
Route::put('/update_cart/{id}', [CartController::class, 'update_cart']);
Route::get('/checkout', [OrderController::class, 'show_checkout']);
Route::post('/checkout/getRegencies', [OrderController::class, 'getRegencies']);
Route::post('/checkout/getDistricts', [OrderController::class, 'getDistricts']);
Route::post('/checkout/cost', [OrderController::class, 'cost']);

Route::middleware('auth')->group(function() {
    Route::post('/doCheckout', [OrderController::class, 'doCheckout']);
    Route::get('/invoice/{id}', [PaymentController::class, 'invoice']);
    Route::get('/transaction', [PaymentController::class, 'transaction']);
    Route::put('/itemsArrived', [PaymentController::class, 'itemsArrived']);
});

Route::middleware(['auth', 'admin'])->prefix('dashboard')->group(function () {
    Route::get('/', function () {
        $orderData = Order::whereIn('status', ['paid', 'process', 'finished'])
            ->select(DB::raw('DATE_FORMAT(updated_at, "%M") AS date'), DB::raw('COUNT(*) AS count'))
            ->groupBy(DB::raw('DATE_FORMAT(updated_at, "%M")'))
            ->orderBy(DB::raw('DATE_FORMAT(updated_at, "%M")'))
            ->get();

        $thisMonth = Order::where('status', 'finished')
            ->whereYear('updated_at', now()->year)
            ->whereMonth('updated_at', now()->month)
            ->sum('total');

        $lastMonth = Order::where('status', 'finished')
            ->whereYear('updated_at', now()->subMonth()->year)
            ->whereMonth('updated_at', now()->subMonth()->month)
            ->sum('total');

        return view('dashboard.index', [
            'orderData' => $orderData,
            'thisMonth' => $thisMonth,
            'lastMonth' => $lastMonth
        ]);
    });
    Route::get('/products/categories/checkSlug', [CategoryController::class, 'checkSlug']);
    Route::resource('/products/categories', CategoryController::class)->except('show');
    Route::get('/products/checkSlug', [ProductController::class, 'checkSlug']);
    Route::delete('/products/reviews/{review:id}', [ReviewController::class, 'removeReview']);
    Route::get('/products/reviews', [ReviewController::class, 'review']);
    Route::delete('/products/comments/{productComment:id}', [ProductController::class, 'removeComment']);
    Route::get('/products/comments', [ProductController::class, 'comment']);
    Route::resource('/products', ProductController::class)->except('show');
    Route::get('/blogs/categories/checkSlug', [BlogCategoryController::class, 'checkSlug']);
    Route::resource('/blogs/categories', BlogCategoryController::class);
    Route::get('/blogs/checkSlug', [BlogController::class, 'checkSlug']);
    Route::delete('/blogs/comments/{blogComment:id}', [BlogController::class, 'removeComment']);
    Route::get('/blogs/comments', [BlogController::class, 'comment']);
    Route::resource('/blogs', BlogController::class);
    Route::get('/messages', [MessageController::class, 'index']);
    Route::get('/messages/{message:id}/show', [MessageController::class, 'show']);
    Route::delete('/messages/{message:id}', [MessageController::class, 'removeMessage']);
    Route::put('/orderProcess', [PaymentController::class, 'orderProcess']);
    Route::get('/orders', function() {
        return view('dashboard.orders.index', [
            'orders' => Order::latest()->paginate(20)
        ]);
    });
    Route::get('/order/{id}', function($id) {
        $url = Crypt::decryptString($id);
        $order = Order::findOrFail($url);
        
        return view('dashboard.orders.show', [
            'order' => $order
        ]);
    });
    Route::get('profile', function() {
        return view('dashboard.profile', [
            'users' => Auth::user()
        ]);
    });

    //interface slide
    Route::get('/slides', [InterfaceController::class, 'slide']);
    Route::get('/slides/create', [InterfaceController::class, 'createSlide']);
    Route::post('/slides/store', [InterfaceController::class, 'storeSlide']);
    Route::get('/slides/{slide:id}/edit', [InterfaceController::class, 'editSlide']);
    Route::put('/slides/{slide:id}', [InterfaceController::class, 'updateSlide']);
    Route::delete('/slides/{slide:id}', [InterfaceController::class, 'destroySlide']);

    //interface feature
    Route::get('/features', [InterfaceController::class, 'feature']);
    Route::get('/features/create', [InterfaceController::class, 'createFeature']);
    Route::post('/features/store', [InterfaceController::class, 'storeFeature']);
    Route::get('/features/{feature:id}/edit', [InterfaceController::class, 'editFeature']);
    Route::put('/features/{feature:id}', [InterfaceController::class, 'updateFeature']);
    Route::delete('/features/{feature:id}', [InterfaceController::class, 'destroyFeature']);

    //interface gallery
    Route::get('/galleries', [InterfaceController::class, 'gallery']);
    Route::get('/galleries/create', [InterfaceController::class, 'createGallery']);
    Route::post('/galleries/store', [InterfaceController::class, 'storeGallery']);
    Route::get('/galleries/{gallery:id}/edit', [InterfaceController::class, 'editGallery']);
    Route::put('/galleries/{gallery:id}', [InterfaceController::class, 'updateGallery']);
    Route::delete('/galleries/{gallery:id}', [InterfaceController::class, 'destroyGallery']);

    //interface brand
    Route::get('/brands', [InterfaceController::class, 'brand']);
    Route::get('/brands/create', [InterfaceController::class, 'createBrand']);
    Route::post('/brands/store', [InterfaceController::class, 'storeBrand']);
    Route::get('/brands/{brand:id}/edit', [InterfaceController::class, 'editBrand']);
    Route::put('/brands/{brand:id}', [InterfaceController::class, 'updateBrand']);
    Route::delete('/brands/{brand:id}', [InterfaceController::class, 'destroyBrand']);

    // interface contact
    Route::get('/contacts', [InterfaceController::class, 'contact']);
    Route::get('/contacts/{contact:id}/edit', [InterfaceController::class, 'editContact']);
    Route::put('/contacts/{contact:id}', [InterfaceController::class, 'updateContact']);

    //interface feature
    Route::get('/sosmeds', [InterfaceController::class, 'sosmed']);
    Route::get('/sosmeds/create', [InterfaceController::class, 'createSosmed']);
    Route::post('/sosmeds/store', [InterfaceController::class, 'storeSosmed']);
    Route::get('/sosmeds/{sosmed:id}/edit', [InterfaceController::class, 'editSosmed']);
    Route::put('/sosmeds/{sosmed:id}', [InterfaceController::class, 'updateSosmed']);
    Route::delete('/sosmeds/{sosmed:id}', [InterfaceController::class, 'destroySosmed']);

    // interface footer
    Route::get('/footer', [InterfaceController::class, 'footer']);
    Route::get('/footer/{footer:id}/edit', [InterfaceController::class, 'editFooter']);
    Route::put('/footer/{footer:id}', [InterfaceController::class, 'updateFooter']);
}); 

