# Meta

[![Build Status](https://travis-ci.org/foxted/Meta.svg?branch=master)](https://travis-ci.org/foxted/Meta)
[![Latest Stable Version](https://poser.pugx.org/foxted/meta/v/stable.svg)](https://packagist.org/packages/foxted/meta)
[![Total Downloads](https://poser.pugx.org/foxted/meta/downloads.svg)](https://packagist.org/packages/foxted/meta)
[![Latest Unstable Version](https://poser.pugx.org/foxted/meta/v/unstable.svg)](https://packagist.org/packages/foxted/meta)
[![License](https://poser.pugx.org/foxted/meta/license.svg)](https://packagist.org/packages/foxted/meta)

Small package to generate meta tags easily in your Laravel app

## Installation

First, pull in the package through Composer.

### Laravel 4.2

```js
"require": {
    "foxted/meta": "~1.0"
}
```

### Laravel 5.0

```js
"require": {
    "foxted/meta":"1.1.*"
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
    'Meta' => 'Foxted\Meta\Facades\MetaFacade'
];
```

And finally publish the view & config files:

```
php artisan view:publish foxted/meta
php artisan config:publish foxted/meta
```

## Defaults

Defaults values are set in the config file, to override them, after you ran the `php artisan config:publish foxted/meta` command, navigate to `app/config/packages/foxted/config.php` and change the values as you want.

You can also delete them entirely if you do not want any defaults values, just be sure to keep the `app/config/packages/foxted/config.php` file and return an empty array, like so:

```php
<?php

return [];
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
