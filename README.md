# WP Plugin

## Get Started

```
git clone https://github.com/wppunk/WPPlugin your-plugin-name
cd your-plugin-name
composer install
yarn install
```

Make the following replacements throughout the project:
```
PLUGIN_NAME                                 => YOUR_AWESOME_PLUGIN
PluginName                                  => YourAwesomePlugin
plugin-name                                 => your-awesome-plugin
Plugin Name                                 => Your Awesome Plugin
plugin-name.php                             => your-awesome-plugin.php
.packages/composer/phpcs-ruleset/PluginName => .packages/composer/phpcs-ruleset/YourAwesomePlugin
.github/workflows/plugin-name.yml           => .github/workflows/your-awesome-plugin.yml
.github/workflows/plugin-name.conf          => .github/workflows/your-awesome-plugin.conf
```

## Requirements

Make sure all dependencies have been installed before moving on:

- WordPress >= 5.4
- PHP >= 7.4.0 (You can easy to downgrade it)
- Composer
- Node.js >= 14.8
- Yarn
- ChromeDriver

## Structure

```
plugins/your-awesome-plugin/        # → Root of your plugin.
├── .codeception/                   # → Codeception additional directories.
│   ├── _config/                    # → Configs for DB connection.
│   ├── _data/                      # → Folder for SQL dump.
│   └── _support/                   # → Additional classes for the Codeception tests.
├── .github/                        # → GitHub additional directories.
│   └── workflows/                  # → Workflows.
│       ├── plugin-name.conf        # → Config for the server.
│       └── plugin-name.yml         # → Actions for GitHub.
├── .vendor/                        # → Composer packages (never edit).
├── assets/                         # → Assets directory.
│   ├── build/                      # → Assets build directory.
│   └── src/                        # → Assets source directory.
├── node_modules/                   # → JS packages (never edit). 
├── templates/                      # → Templates for plugin views.
├── tests/                          # → Tests.
│   └── php                         # → PHP tests.
│       ├── acceptance              # → PHP Acceptance tests.
│       ├── unit                    # → PHP Unit tests.
│       │   └── _bootstrap.php      # → Bootstrap file for PHP unit tests.
│       ├── acceptance.suite.yml    # → Config file for the acceptance tests.
│       └── unit.suite.yml          # → Config file for the unit tests.
├── .eslintrc                       # → JS Coding Standards.
├── CHANGELOG.md                    # → Changelog file for GH.
├── codeception.yml                 # → Main codeception config.
├── composer.json                   # → Composer dependencies and scripts.
├── composer.lock                   # → Composer lock file (never edit).
├── LICENSE                         # → License file.
├── package.json                    # → JS dependencies and scripts.
├── phpcs.xml                       # → Custom PHP Coding Standards.
├── plugin-name.php                 # → Bootstrap plugin file.
├── postcss.config.js               # → PostCSS config file.
├── readme.txt                      # → Readme TXT for the wp.org repository.
├── uninstall.php                   # → Uninstall file.
├── webpack.config.js               # → Encore configuration file.
└── yarn.lock                       # → Yarn lock file (never edit).
```

## Autoload

We use PSR-4 and composer autoload for PSR-4. You can find it in `composer.json` in directive `autoload`. 

## Coding Standards

### PHP Coding Standard (PHPCS)

We use a custom coding standard based on [WordPress Coding Standard](https://github.com/WordPress/WordPress-Coding-Standards). We disabled rules for the naming of WordPress files for using PSR-4 autoload. Also, we have a [feature](https://github.com/PHPCompatibility/PHPCompatibilityWP), which can allow testing your code using different PHP environments.

Custom PHPCS your can find in the `.packages/composer/phpcs-ruleset/PluginName/ruleset.xml`.

Your can check PHPCS using a CLI:
```
composer cs
``` 

PHPCS checked before each commit, before the push, and in GH Actions.

### JS Coding Standard (JSCS)

We use a default WordPress JSCS, but you can modify it in the `.eslintrc` file. 

## Frontend

All assets are located in `assets/src/*`.

All builds are located in `assets/build/*`.

As CSS preprocessors we use PostCSS. You can add a some features in the `postcss.config.js` file. 

We use [Encore](https://symfony.com/doc/current/frontend.html) for the assets build. You can modify it in `webpack.config.js` file.

## GH Actions

All steps for GH Actions you can find in `.github/workflows/plugin-name.yml` file. Also, for wake up a webserver, we need to add `.github/workflows/plugin-name.conf` 

## Make your GH better

We use a [Husky](https://github.com/typicode/husky) and [Composer Git Hooks](https://github.com/BrainMaestro/composer-git-hooks) libraries to add actions before commit, push, etc. This helps developers make their GH more clear.

## Automated testing

We are using for automated testing a Codeception library runs all types of PHP tests.

### PHP unit tests

For running use a CLI command:
```
composer unit
```

- Main configuration file `tests/php/unit.suite.yml`
- Unit tests inside `tests/php/unit/*` folder.
- Bootstrap file `tests/php/unit/_bootstrap.php`
- Each filename for test class must have a suffix on `*Test.php`.
- Each test class must extend a `PluginNameUnitTests\TestCase` class.
- You can also add some code to `PluginNameUnitTests\TestCase.php`
- Each test method must have prefix `test_`
- Additional files for autoloading in tests running you can add to `.codeception/_support/*` folder.

Also, unit tests will be checked on a push to repository action and inside the GH Actions pipeline. 

### PHP acceptance tests

**Warning!** The acceptance tests make REAL actions on your site. Before running need to create another database and create a `dump.sql` file with fresh WP install.

Before running, you need to (It needs to make just one time. I hope you can do it):
1. Install a [ChromeDriver](https://chromedriver.chromium.org/downloads)
2. Create a new database. For example, I named a database `codeception_db`
3. Install a clear WordPress
4. Export database to `dump.sql`
5. Move a `dump.sql` file to the `.codeception/_data/` folder.
6. Copy a file `.codeception/_config/params.example.php` to `.codeception/_config/params.local.php`.
7. Update your connection information to the testing site connection in `.codeception/_config/params.local.php` file. 
8. Update your `wp-config.php` file:
```php
if ( 
    isset( $_SERVER['HTTP_X_TESTING'] )
    || ( isset( $_SERVER['HTTP_USER_AGENT'] ) && $_SERVER['HTTP_USER_AGENT'] === 'wp-browser' )
    || getenv( 'WPBROWSER_HOST_REQUEST' )
) {
    // Use the test database if the request comes from a test.
    define( 'DB_NAME', 'codeception_db' );
} else {
    // Else use the default one (insert your local DB name here).
    define( 'DB_NAME', 'local' );
}
```

For running use a CLI command:
```
composer acceptance
```

- Main configuration file `tests/php/acceptance.suite.yml`
- Unit tests inside `tests/php/acceptace/*` folder.
- Each filename for test class must have a suffix on `*Cest.php`.
- Each test method must have prefix `test_`
- Each test method must include `AcceptanceTester` as argument.
- You can add some methods to AcceptanceTester in `.codeception/_support/AcceptanceTests.php`.
- Additional files for autoloading in tests running you can add to `.codeception/_support/*` folder.
