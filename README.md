## Installed packages

Laravel:
- composer require plutuss/stripe-laravel
-  php artisan vendor:publish --provider="Plutuss\Providers\StripeServiceProvider"
- [GitHub](https://github.com/plutuss/stripe-laravel).

app.php ->  providers
 \Plutuss\Providers\StripeServiceProvider::class,