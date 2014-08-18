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

In progress

## Contribution

Any ideas are welcome. Feel free the submit any issues or pull requests.

Enjoy ;)