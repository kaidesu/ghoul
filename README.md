# Ghoul
Ghoul makes it easy to execute PHP scripts with Composer support without having to configure Composer's autoloader. Focus on the task at hand and freely use Composer dependencies 🎃

## Installing
Ghoul can be installed globally using Composer:

```
$ composer global require kaidesu/ghoul
```

Make sure to place Composer's system-wide vendor bin directory in your $PATH so the ghoul executable can be located by your system. This directory exists in different locations based on your operating system; however, some common locations include:

- macOS: `$HOME/.composer/vendor/bin`
- Windows: `%USERPROFILE%\AppData\Roaming\Composer\vendor\bin`
- GNU / Linux Distributions: `$HOME/.config/composer/vendor/bin` or `$HOME/.composer/vendor/bin`

You can also find the composer's global installation path by running `composer global about` and looking up from the first line.

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