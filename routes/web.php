<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvestorProfileController;
use App\Http\Controllers\StartupProfileController;
use App\Http\Controllers\StartupDashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MessagesController;
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// Route::get('/make-admin', function () {
//     // Optional: delete existing one (if corrupted)
//     User::where('email', 'admin@starteval.com')->delete();

//     // Create fresh admin with hashed password
//     User::create([
//         'name' => 'Admin',
//         'email' => 'admin@starteval.com',
//         'password' => Hash::make('admin123'), // Must be hashed!
//         'account_type' => 'admin',
//     ]);

//     return '✅ Admin user recreated successfully!';
// });
use Illuminate\Support\Facades\Auth;
// Admin Dashboard routes 
Route::get('/admin-dashboard', function () {
    if (Auth::check() && Auth::user()->account_type === 'admin') {
        return app(\App\Http\Controllers\AdminController::class)->index();
    }
    abort(403, 'Unauthorized');
})->middleware('auth')->name('admin.dashboard');
Route::get('/admin/users/{id}', [UserController::class, 'show'])->name('admin.users.show');
Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
Route::get('/admin/totalusers', [AdminController::class, 'totalusers'])->name('admin.totalusers');
Route::get('/admin/entrepreneurs', [AdminController::class, 'showEntrepreneurs'])->name('admin.entrepreneurs');
Route::get('/admin/investors', [AdminController::class, 'showinvestors'])->name('admin.investors');
Route::post('/admin/send-dashboard-report', [AdminController::class, 'sendDashboardReport'])->name('admin.sendDashboardReport');
Route::get('/admin/products', [AdminController::class, 'productList'])->name('admin.products');
Route::get('/admin/products/{id}/edit', [AdminController::class, 'editProduct'])->name('admin.products.edit');
Route::post('/admin/products/{id}/update', [AdminController::class, 'updateProduct'])->name('admin.products.update');
Route::get('/blogsview', [BlogController::class, 'create'])->name('blog.view');
Route::get('/blogs/create', [BlogController::class, 'addblog'])->name('blog.create');
Route::post('/blogs', [BlogController::class, 'store'])->name('blog.store');
Route::get('/blogs/{blog}/edit', [BlogController::class, 'edit'])->name('blog.edit'); // Edit form
Route::put('/blogs/{blog}', [BlogController::class, 'update'])->name('blog.update'); // Update blog
Route::delete('/blogs/{blog}', [BlogController::class, 'destroy'])->name('blog.destroy');
Route::get('/admin/contacts', [AdminController::class, 'conindex'])->name('admin.contacts');
// dashboard routes end 
// frontend routes
Route::get('/', [FrontendController::class,'index'])->name('index');
Route::get('/blog/{slug}', [FrontendController::class, 'blogview'])->name('blog.show');
Route::get('/contact', function () {
    return view('frontend.contact');
});
Route::post('/contact-submit', [ContactController::class, 'store'])->name('contact.submit');
Route::get('/blog', [FrontendController::class, 'allBlogs'])->name('blogs.index');
// frontend routes 
// backendroutes 
Route::middleware(['auth'])->group(function () {
    
    // Show form pages
    Route::get('/investor-form', [InvestorProfileController::class, 'create'])->name('investor.form');
    Route::get('/startup-form', [StartupProfileController::class, 'create'])->name('startup.form');

    Route::post('/investor/store', [InvestorProfileController::class, 'store'])->name('investor.store');
    Route::post('/startup-form', [StartupProfileController::class, 'store'])->name('startup.store');
});
// backend dashboard 
Route::get('/investor/dashboard', [InvestorProfileController::class,'view'])->name('backend.investor_dashboard');
Route::get('/investor/edit-profile', [InvestorProfileController::class, 'edit'])->name('investor.profile.edit');
Route::post('/investor/update-profile', [InvestorProfileController::class, 'update'])->name('investor.profile.update');
Route::post('/favorite/toggle/{product}', [FavoriteController::class, 'toggle'])
     ->name('favorite.toggle')
     ->middleware('auth'); // ensure logged in
Route::get('/favorites', [FavoriteController::class, 'myFavorites'])->name('favorites.index');

// backend dashboard routes start here 
Route::get('/startup/dashboard', [StartupDashboardController::class, 'index'])->name('backend.startup_dashboard');
Route::get('/startup/edit-profile', [StartupDashboardController::class, 'edit'])->name('startup.profile.edit');
Route::post('/startup/update-profile', [StartupDashboardController::class, 'update'])->name('startup.profile.update');

// backendroutes end here 
// product controller start here 
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::get('/products/{id}/view', [ProductController::class, 'viewProduct'])->name('products_detail.view');
// Handle the form submission
Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

// product controller end here 
// chat 
Route::group(['middleware' => ['auth']], function () {
    Route::get('/chat', [MessagesController::class, 'index'])->name('chat');
    Route::get('/chatify', [MessagesController::class, 'index'])->name('chatify');
   Route::match(['get', 'post'], '/chat/search', [MessagesController::class, 'search'])->name('chat.search');
    Route::post('/chat/contacts', [MessagesController::class, 'getContacts'])->name('chat.contacts');
    Route::post('/chat/favorites', [MessagesController::class, 'getFavorites'])->name('chat.favorites');
    Route::post('/chatify/search', [MessagesController::class, 'search'])->name('chatify.search');
    Route::post('/chatify/contacts', [MessagesController::class, 'getContacts'])->name('chatify.contacts');
    Route::post('/chatify/favorites', [MessagesController::class, 'getFavorites'])->name('chatify.favorites');
});


Auth::routes();