<?php

use App\Http\Controllers\backend\BannerController;
use App\Http\Controllers\backend\BlogController;
use App\Http\Controllers\backend\BrandController;
use App\Http\Controllers\backend\CategoryBlogController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\CategoryGalleryController;
use App\Http\Controllers\backend\ContactController;
use App\Http\Controllers\backend\CouponController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\DeliveryController;
use App\Http\Controllers\backend\FarmerController;
use App\Http\Controllers\backend\FreeShipController;
use App\Http\Controllers\backend\GalleryController;
use App\Http\Controllers\backend\InfoShopController;
use App\Http\Controllers\backend\OrderController as BackendOrderController;
use App\Http\Controllers\backend\PaymentController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\frontend\BlogCusController;
use App\Http\Controllers\frontend\CartController as FrontendCartController;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\OrderController;
use App\Http\Controllers\frontend\ReviewProductController;
use App\Http\Controllers\frontend\ShopController;
use App\Http\Controllers\frontend\WishlistController;
use Illuminate\Support\Facades\Route;



Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {

    Route::get('ckeditor', [HomeController::class, 'index_cke'])->name('ckeditor.browse');

    Route::post('ckeditor/upload', [HomeController::class, 'index_upload'])->name('ckeditor.upload');

    Route::get('/', [DashboardController::class, 'index'])->name('admin.home');
    Route::get('/unactive-category/{slug}', [CategoryController::class, 'unactive'])->name('admin.category.unactive');
    Route::get('/active-category/{slug}', [CategoryController::class, 'active'])->name('admin.category.active');
    Route::get('/unactive-info/{slug}', [InfoShopController::class, 'unactive'])->name('admin.info.unactive');
    Route::get('/active-info/{slug}', [InfoShopController::class, 'active'])->name('admin.info.active');
    Route::get('/unactive-categoryBlog/{slug}', [CategoryBlogController::class, 'unactive'])->name('admin.categoryBlog.unactive');
    Route::get('/active-categoryBlog/{slug}', [CategoryBlogController::class, 'active'])->name('admin.categoryBlog.active');
    Route::get('/unactive-product/{slug}', [ProductController::class, 'unactive'])->name('admin.product.unactive');
    Route::get('/active-product/{slug}', [ProductController::class, 'active'])->name('admin.product.active');
    Route::get('/unhot-product/{slug}', [ProductController::class, 'unhot'])->name('admin.product.unhot');
    Route::get('/hot-product/{slug}', [ProductController::class, 'hot'])->name('admin.product.hot');
    Route::get('/unactive-brand/{slug}', [BrandController::class, 'unactive'])->name('admin.brand.unactive');
    Route::get('/active-brand/{slug}', [BrandController::class, 'active'])->name('admin.brand.active');
    Route::get('/unactive-blog/{slug}', [BlogController::class, 'unactive'])->name('admin.blog.unactive');
    Route::get('/active-blog/{slug}', [blogController::class, 'active'])->name('admin.blog.active');
    Route::get('/unactive-banner/{slug}', [BannerController::class, 'unactive'])->name('admin.banner.unactive');
    Route::get('/active-banner/{slug}', [BannerController::class, 'active'])->name('admin.banner.active');
    Route::get('/unactive-user/{slug}', [UserController::class, 'unactive'])->name('admin.user.unactive');
    Route::get('/active-user/{slug}', [UserController::class, 'active'])->name('admin.user.active');
    Route::get('/unactive-coupon/{slug}', [CouponController::class, 'unactive'])->name('admin.coupon.unactive');
    Route::get('/active-coupon/{slug}', [CouponController::class, 'active'])->name('admin.coupon.active');
    Route::get('/unactive-farmer/{id}', [FarmerController::class, 'unactive'])->name('admin.farmer.unactive');
    Route::get('/active-farmer/{id}', [FarmerController::class, 'active'])->name('admin.farmer.active');
    Route::get('/ma-giam-gia/sendMail/{slug}', [CouponController::class, 'sendmail'])->name('admin.coupon.sendmail');
    Route::get('/unactive-freeShip/{slug}', [FreeShipController::class, 'unactive'])->name('admin.freeShip.unactive');
    Route::get('/active-freeShip/{slug}', [FreeShipController::class, 'active'])->name('admin.freeShip.active');
    Route::get('/unactive-category_gallery/{slug}', [CategoryGalleryController::class, 'unactive'])->name('admin.category_gallery.unactive');
    Route::get('/active-category_gallery/{slug}', [CategoryGalleryController::class, 'active'])->name('admin.category_gallery.active');
    Route::get('/unactive-gallery/{id}', [GalleryController::class, 'unactive'])->name('admin.gallery.unactive');
    Route::get('/active-gallery/{id}', [GalleryController::class, 'active'])->name('admin.gallery.active');
    Route::get('/unactive-payment/{slug}', [PaymentController::class, 'unactive'])->name('admin.payment.unactive');
    Route::get('/unactive-review/{id}', [DashboardController::class, 'unactive'])->name('admin.review.unactive');
    Route::get('/active-review/{id}', [DashboardController::class, 'active'])->name('admin.review.active');
    Route::get('/active-payment/{slug}', [PaymentController::class, 'active'])->name('admin.payment.active');
    Route::resource('danh-muc', CategoryController::class)->parameters([
        'danh-muc' => 'category:slug',
    ]);
    Route::get('/sort', [CategoryController::class, 'sort'])->name('sort');
    Route::get('/search', [CategoryController::class, 'search'])->name('search');
    Route::resource('nha-cung-cap', BrandController::class)->parameters([
        'nha-cung-cap' => 'brand:slug',
    ]);
    Route::resource('san-pham', ProductController::class)->parameters([
        'san-pham' => 'product:slug',
    ]);
    Route::resource('danh-muc-bai-viet', CategoryBlogController::class)->parameters([
        'danh-muc-bai-viet' => 'category_blog:slug',
    ]);
    Route::resource('bai-viet', BlogController::class)->parameters([
        'bai-viet' => 'blog:slug',
    ]);
    Route::resource('banner', BannerController::class)->parameters([
        'banner' => 'banner:slug',
    ]);
    Route::resource('ma-giam-gia', CouponController::class)->parameters([
        'ma-giam-gia' => 'coupon:slug',
    ]);
    Route::resource('ma-free-ship', FreeShipController::class)->parameters([
        'ma-free-ship' => 'free_ship:slug',
    ]);
    Route::resource('nhan-vien', FarmerController::class)->parameters([
        'nhan-vien' => 'farmer:id',
    ]);
    Route::resource('phan-hoi-contact', ContactController::class)->parameters([
        'phan-hoi-contact' => 'contact:id',
    ]);
    Route::resource('danh-muc-bo-suu-tap', CategoryGalleryController::class)->parameters([
        'danh-muc-bo-suu-tap' => 'category_gallery:slug',
    ]);
    Route::resource('bo-suu-tap', GalleryController::class)->parameters([
        'bo-suu-tap' => 'gallery:id',
    ]);
    Route::resource('phuong-thuc-thanh-toan', PaymentController::class)->parameters([
        'phuong-thuc-thanh-toan' => 'payment:slug',
    ]);
    Route::resource('ma-ship', DeliveryController::class);
    Route::post('/select_ship', [DeliveryController::class, 'select_ship'])->name('admin.select.ship');
    Route::post('/phan-hoi-contact/send', [ContactController::class, 'sendMail'])->name('admin.reply.contact');
    Route::resource('thong-tin-shop', InfoShopController::class);
    Route::resource('don-hang', BackendOrderController::class);
    Route::get('don-hang/in-don-hang/{id}', [BackendOrderController::class, 'pdfl'])->name('pdff');
    Route::resource('user', UserController::class);
    Route::get('thong-tin-ca-nhan-admin', [UserController::class, 'profile'])->name('admin.profile');
    Route::post('thong-tin-ca-nhan-admin', [UserController::class, 'saveImage']);
    Route::get('/danh-sach-feedback',[DashboardController::class, 'feedback'])->name('admin.feedback');
    Route::post('/reply/store', [BlogController::class, 'replycmt'])->name('reply.add');

});
//ROUTE LOGIN, REGISTER , LOGOUT OF ADMIN
Route::post('/login_admin', [DashBoardController::class, 'login_post']);
Route::get('/login_admin', [DashBoardController::class, 'login'])->name('admin.login');
Route::get('/logout_admin', [DashBoardController::class, 'logout'])->name('admin.logout');
Route::get('/register_admin', [DashBoardController::class, 'register'])->name('admin.register');
Route::post('/register_admin', [DashBoardController::class, 'register_post']);


Route::group(['prefix' => 'customer'], function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/trang-chu', [HomeController::class, 'index'])->name('customer.home');
    Route::get('/thong-tin-tai-khoan', [HomeController::class, 'profile'])->name('customer.profile');
    Route::post('/thong-tin-tai-khoan', [HomeController::class, 'saveImage']);
    Route::resource('danh-sach-san-pham', ShopController::class)->parameters([
        'danh-sach-san-pham' => 'product:slug',
    ]);
    Route::get('danh-sach-san-pham/danh-muc/{id}', [ShopController::class, 'getProductByCate'])->name('customer.product.category');
    Route::get('danh-sach-san-pham/nhan-hang/{id}', [ShopController::class, 'getProductByBrand'])->name('customer.product.brand');
    Route::resource('gio-hang', FrontendCartController::class);
    Route::resource('san-pham-yeu-thich', WishlistController::class);
    Route::get('gio-hang/plus/{id}', [FrontendCartController::class, 'plusCart'])->name('gio-hang.cart.plus');
    Route::get('gio-hang/minus/{id}', [FrontendCartController::class, 'minusCart'])->name('gio-hang.cart.minus');
    Route::delete('/xoa-gio-hang', [FrontendCartController::class, 'multipledelete'])->name('gio-hang.cart.del_select');
    Route::get('/getCountCart', [FrontendCartController::class, 'getCountCart'])->name('getCountCart');
    Route::get('/getCart', [FrontendCartController::class, 'getCart'])->name('getCart');
    Route::get('/getTotalCart', [FrontendCartController::class, 'getTotalCart'])->name('getTotalCart');
    Route::get('/getTotalPrice', [FrontendCartController::class, 'getTotalPrice'])->name('getTotalPrice');
    Route::get('/getPrice/{id}', [FrontendCartController::class, 'getPrice'])->name('getPrice');
    Route::get('getProInCart', [FrontendCartController::class, 'getProInCart'])->name('gio-hang.getProInCart');
    Route::post('getShipping', [FrontendCartController::class, 'getShipping'])->name('gio-hang.getShipping');
    Route::get('/getTotalWishlist', [WishlistController::class, 'getTotalWishlist'])->name('getTotalWishlist');
    Route::resource('danh-sach-bai-viet', BlogCusController::class)->parameters([
        'danh-sach-bai-viet' => 'blog:slug',
    ]);
    Route::get('danh-sach-bai-viet/danh-muc/{id}', [BlogCusController::class, 'getBlogByCate'])->name('customer.blog.category');
    Route::post('danh-sach-bai-viet/binh-luan/store', [BlogCusController::class, 'storecmt'])->name('blog.comment.store');
    Route::get('/lien-he', [HomeController::class, 'contact'])->name('customer.contact');
    Route::post('/lien-he', [HomeController::class, 'storeContactForm'])->name('customer.contact.store');
    Route::get('/gioi-thieu', [HomeController::class, 'about'])->name('customer.about');
    Route::post('/check-coupon', [FrontendCartController::class, 'check_coupon'])->name('customer.check_coupon');
    Route::get('/get-coupon', [FrontendCartController::class, 'get_coupon'])->name('customer.get_coupon');
    Route::get('/get-condition-coupon', [FrontendCartController::class, 'get_condition_coupon'])->name('customer.get_condition_coupon');
    Route::post('/select_shipping', [FrontendCartController::class, 'select_ship'])->name('customer.select_shipping');
    Route::resource('dat-hang', OrderController::class);
    Route::post('getShippingDetail', [OrderController::class, 'getShippingDetail'])->name('gio-hang.getShippingDetail');
    Route::get('dat-hang-thanh-cong', [OrderController::class, 'success_order'])->name('success_order');
    Route::post('/check-freeship', [OrderController::class, 'check_freeship'])->name('customer.check_freeship');
    Route::get('/getTotalPriceInOrder', [OrderController::class, 'getTotalPrice'])->name('customer.order.getTotalPrice');
    Route::post('/getOrder', [OrderController::class, 'getOrder'])->name('customer.getOrder');

    Route::get('/bo-suu-tap-anh', [HomeController::class, 'gallery'])->name('customer.gallery');
    Route::resource('lich-su-mua-hang', ReviewProductController::class);
    Route::post('/huy-don-hang/{id}', [OrderController::class, 'cancel_order'])->name('customer.cancel_order');
    Route::post('/search_product', [HomeController::class, 'search_product'])->name('customer.search_product');
    Route::get('/nhan-hang/{slug}', [HomeController::class, 'brand'])->name('customer.brand_info');

});

//ROUTE LOGIN, REGISTER , LOGOUT CUSTOMER
Route::get('/login_customer', [HomeController::class, 'login'])->name('customer.login');
Route::post('/login_customer', [HomeController::class, 'login_post']);
Route::get('/logout_customer', [HomeController::class, 'logout'])->name('customer.logout');
Route::get('/register_customer', [HomeController::class, 'create'])->name('customer.register');
Route::post('/register_customer', [HomeController::class, 'store']);
Route::get('/forgot-password', [HomeController::class, 'view_forgot'])->name('customer.view_forgot');
Route::post('/forgot-password_post', [HomeController::class, 'forgot_pass'])->name('customer.forgot_password');
Route::post('/update_password', [HomeController::class, 'update_password']);
Route::get('/update_password', [HomeController::class, 'update_password_view']);
