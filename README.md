# Ghoul
Ghoul makes it easy to execute PHP scripts with Composer support without having to configure Composer's autoloader. Focus on the task at hand and freely use Composer dependencies 🎃

## Usage
```
$ ghoul <path>
```

You may pass a script directly to Ghoul or a directory path. If you pass a directory path, Ghoul will look for either `index.php` or `main.php` and execute it.

1. Create a `composer.json` file using `composer init` within your project.
2. Require any composer packages as needed.
3. Write your code.
4. Execute it!

## Example
```
$ mkdir my-simple-script
```

**./my-simple-script/composer.json**
```json
{
    "name": "ghoul/test",
    "require": {
        "webmozart/assert": "^1.9",
        "symfony/var-dumper": "^5.1"
    }
}
```

**./my-simple-script/index.php**
```php
<?php

use Webmozart\Assert\Assert;

dump('I\'m coming from the Symfony VarDumper component.');

Assert::boolean('ghoul', 'The value must be a boolean. Got: %s');
```

```
$ ghoul ./my-simple-script
```