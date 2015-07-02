# Form Extension for Twig

[![Build Status](https://travis-ci.org/hum2/twig-form.svg?branch=master)](https://travis-ci.org/hum2/twig-form)


## install
```php
composer require hum2/twig-form
```

## How To Use

### index.html.twig
```html
{% form action=post_url|e, method="POST", enctype="multipart/form-data" %}
<input type="text" name="keyword" />
{% endform %}
```

### index.php
```php
# validate
$factory   = new \Aura\Session\SessionFactory;
$session   = $factory->newInstance($_COOKIE);

$expectedToken = $session->getCsrfToken()->getValue();
$actualToken   = $_POST['__csrf_value'];

if ($expectedToken !== $actualToken) {
　// csrf token error
}
```


## dependency Package

- twig/twig
- aura/session
