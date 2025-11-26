protected $routeMiddleware = [
    // ... другие middleware
    'admin' => \App\Http\Middleware\Admin::class,
    'seller' => \App\Http\Middleware\Seller::class,
];