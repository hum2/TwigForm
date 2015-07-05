# Form Extension for Twig

[![Build Status](https://travis-ci.org/hum2/twig-form.svg?branch=master)](https://travis-ci.org/hum2/twig-form)

[![Latest Stable Version](https://poser.pugx.org/hum2/twig-form/v/stable)](https://packagist.org/packages/hum2/twig-form)
[![Total Downloads](https://poser.pugx.org/hum2/twig-form/downloads)](https://packagist.org/packages/hum2/twig-form)
[![Latest Unstable Version](https://poser.pugx.org/hum2/twig-form/v/unstable)](https://packagist.org/packages/hum2/twig-form)
[![License](https://poser.pugx.org/hum2/twig-form/license)](https://packagist.org/packages/hum2/twig-form)


## install
```php
composer require hum2/twig-form
```

## How To Use

### index.html.twig
```html
{% form(action=post_url|e, method="POST", enctype="multipart/form-data") %}
<input type="text" name="keyword" />
{% endform %}
```

### index.php
```php
# validate
$factory   = new \Aura\Session\SessionFactory;
$session   = $factory->newInstance($_COOKIE);

$actualToken = $_POST['__csrf_value'];
if (!$session->getCsrfToken()->isValid($actualToken)) {
	// csrf token error
}
// regenerate token(should be onetime token)
$session->getCsrfToken()->regenerateValue();
```


## dependency Package

- twig/twig
- aura/session
