## Installed packages

Laravel:
- [GitHub](https://github.com/plutuss/stripe-laravel).

```shell
 composer require plutuss/stripe-laravel
```

```shell
php artisan vendor:publish --provider="Plutuss\Providers\StripeServiceProvider"
```

```shell
php artisan migrate
```


.env
```dotenv
STRIPE_KEY=pk_test_51KEqhFKdfdfgdfsfdsfggerg
STRIPE_SECRET=sk_test_51KEqhFdfregergregergeqrgreg
STRIPE_WEBHOOK_SECRET=
```

## Use
Use Facades Stripe:
```php
<?php

use Plutuss\Facades\Stripe;

class StripeController extends Controller
{
    public function index()
    {
        $payment_cart = Stripe::generateValidatePaymentToken();
    }
}

```

Use or StripeContract:

```php
<?php

use Plutuss\Stripe\Contracts\StripeContract;

class StripeController extends Controller
{
    public function index(StripeContract $stripeContract)
    {
        $payment_cart = $stripeContract->generateValidatePaymentToken();
    }
}

```
