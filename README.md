# Meta

[IN PROGRESS]

Small package to generate meta tags easily in your Laravel app

## Installation

First, pull in the package through Composer.

```js
"require": {
    "foxted/meta": "~1.0"
}
```

Then include the service provider within `app/config/app.php`.

```php
'providers' => [
    'Foxted\Meta\MetaServiceProvider'
];
```

Add a facade alias to this same file at the bottom:

```php
'aliases' => [
    'Meta' => 'Foxted\Meta\Facades\Meta'
];
```

And finally publish the view:

```
php artisan view:publish foxted/meta
```

## Usage

Within your controllers, before rendering your view, generate your tags:

```php
public function index()
{
    Meta::title("My amazing website"); // <title>My amazing website</title>
    Meta::name("keywords", "awesome, keywords"); // <meta name="keywords" content="awesome, keywords">
    Meta::name("description", "The best website you've ever seen"); // <meta name="description" content="The best website you've ever seen">
    Meta::equiv("content-type", "text/html; charset=UTF-8"); // <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    return View::make("index");
}
```

To show your meta block in your view, just use the following Blade directive:

```
@meta
```

## Contribution

Any ideas are welcome. Feel free the submit any issues or pull requests.

Enjoy ;)