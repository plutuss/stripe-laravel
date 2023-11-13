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
        $payment_cart = Stripe::faker()->generateValidatePaymentToken();
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
        $payment_cart = $stripeContract->faker()->generateValidatePaymentToken();
    }
}

```

```php
   dd($payment_cart)
   
    Plutuss\Stripe\PaymentMethod\PaymentMethod {#298 ▼ // app/Http/Controllers/StripeController.php:14
    -parameters: array:2 [▼
    "id" => "pm_1OCKuHrRXLL6stefstxmYJka6"
    "data" => Stripe\PaymentMethod {#306 ▼
    #_opts: Stripe\Util\RequestOptions {#310 ▶}
    #_originalValues: array:9 [▶]
    #_values: array:9 [▶]
    #_unsavedValues: Stripe\Util\Set {#308 ▶}
    #_transientValues: Stripe\Util\Set {#309 ▶}
    #_retrieveOptions: []
    #_lastResponse: Stripe\ApiResponse {#305 ▶}
    +saveWithParent: false
    id: "pm_1OC0HNKuHrRXLL6stxmYJka6"
    object: "payment_method"
    billing_details: Stripe\StripeObject {#311 ▶}
    card: Stripe\StripeObject {#312 ▶}
    created: 1699882457
    customer: null
    livemode: false
    metadata: Stripe\StripeObject {#317 ▶}
    type: "card"
    }
    ]
    }
```

```php
<?php

use Plutuss\Stripe\Contracts\StripeContract;

class StripeController extends Controller
{
    public function index(StripeContract $stripeContract)
    {
        $payment_cart = $stripeContract->faker()->generateValidatePaymentToken();
        $payment_cart->card;
        $payment_cart->type;
        $payment_cart->created;
    }
}

```