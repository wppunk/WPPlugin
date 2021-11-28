# WP Plugin

## Get Started

One-line install:
```
composer create-project wppunk/wpplugin your-plugin-directory
```

Or you can copy the archive or clone via Git and then run:
```
composer init-project
```

## Requirements

Make sure all dependencies have been installed before moving on:

- WordPress
- PHP >= 7.2.5 (You can easily downgrade it)
    - DOM extension
    - CURL extension
- Composer
- Node.js >= 14.8
- npm
- ChromeDriver (for acceptance tests)

## Structure

```
plugins/your-awesome-plugin/        # → Root of your plugin.
├── .codeception/                   # → Codeception additional directories.
│   ├── _config/                    # → Configs for DB connection.
│   ├── _data/                      # → Folder for SQL dump.
│   └── _support/                   # → Additional classes for the Codeception tests.
├── .github/                        # → GitHub additional directories.
│   └── workflows/                  # → Workflows.
│       ├── plugin-slug.conf        # → Config for the server.
│       └── plugin-slug.yml         # → Actions for GitHub.
├── .tests/                         # → Tests.
│   └── php                         # → PHP tests.
│       ├── acceptance              # → PHP Acceptance tests.
│       ├── unit                    # → PHP Unit tests.
│       │   └── _bootstrap.php      # → Bootstrap file for PHP unit tests.
│       ├── acceptance.suite.yml    # → Config file for the acceptance tests.
│       └── unit.suite.yml          # → Config file for the unit tests.
├── assets/                         # → Assets directory.
│   ├── build/                      # → Assets build directory.
│   └── src/                        # → Assets source directory.
├── node_modules/                   # → JS packages (never edit).
├── src/                            # → PHP directory. 
├── templates/                      # → Templates for plugin views.
├── vendor/                         # → Composer packages (never edit).
├── vendor_prefixes/                # → Prefixed composer packages for non-conflict mode (never edit).
├── .codeception.yml                # → Main codeception config.
├── .env.example                    # → Example for the .env.development and .env.production files
├── .eslintignore                   # → JS Coding Standards ignore file.
├── .eslintrc.js                    # → JS Coding Standards config.
├── .gitconfig                      # → Config for git.
├── .gitignore                      # → Git ignore file.
├── .phpcs.xml                      # → Custom PHP Coding Standards.
├── .scoper.inc.php                 # → Config for the PHP Scoper.
├── .stylelintrc                    # → Config for the style linter.
├── .webpack.mix.js                 # → Laravel Mix configuration file.
├── CHANGELOG.md                    # → Changelog file for GH.
├── composer.json                   # → Composer dependencies and scripts.
├── composer.lock                   # → Composer lock file (never edit).
├── LICENSE                         # → License file.
├── package.json                    # → JS dependencies and scripts.
├── package-lock.json               # → Package lock file (never edit).
├── plugin-slug.php                 # → Bootstrap plugin file.
├── README.md                       # → Readme MD for GitHub repository.
├── readme.txt                      # → Readme TXT for the wp.org repository.
└── uninstall.php                   # → Uninstall file.
```

## Autoload

We use PSR-4 and composer autoload for PSR-4. You can find it in `composer.json` in directive `autoload`. 

## Coding Standards

To check all coding standards:
```
npm run cs
```

### PHP Coding Standard (PHPCS)

We use a custom coding standard based on [WordPress Coding Standard](https://github.com/WordPress/WordPress-Coding-Standards). We disabled rules for the naming of WordPress files for using PSR-4 autoload. Also, we have a [feature](https://github.com/PHPCompatibility/PHPCompatibilityWP), which can allow testing your code using different PHP environments.

Custom PHPCS your can find in the `.phpcs.xml`.

Your can check PHPCS using a CLI:
```
composer cs
```
or
```
npm run cs:php
``` 

Pay attention, tests have a bit another coding standards because testing libraries all using camelCase format for methods, function, variables, and properties.

PHPCS checked before each commit, before the push, and in GH Actions.

### JS Coding Standard (JSCS)

We use a default WordPress JSCS, but you can modify it in the `.eslintrc` file. 

You can check JSCS using a CLI:

```
npm run cs:js
```

### SCSS Coding Standard (SCSSCS)

We use a default standards for SCSS, but you can modify it in the `.stylelintrc` file.

You can check SCSSCS using a CLI:

```
npm run cs:scss
```

## Environments

For any constants you can create the `.env.development` and `.env.production` files. For example, we use these constants from the `.env.example` file for the browserSync inside the Laravel Mix config and for acceptance tests.

## Frontend

All assets are located in `assets/src/*`.

All builds are located in `assets/build/*`.

CSS preprocessor is SCSS. 

We use [Laravel Mix](https://laravel-mix.com/) for the assets build. You can modify it in `.webpack.mix.js` file.

For run Laravel mix you can use the next commands depend on situation:
```
npm run build
npm run build:production
npm run start
```

## GitHub

### GH Actions
All steps for GH Actions you can find in `.github/workflows/plugin-slug.yml` file. Also, for wake up a webserver, we need to add `.github/workflows/plugin-slug.conf` 

### GH Hooks

Just make you GH repository clear. We use the [Husky](https://github.com/typicode/husky) library to add actions before commit, push, etc. This helps developers make their GH more clear.

### GH Templates

Basic GH templates for better security issues, support requests, bug reports, enhancements, feature requests, pull requests, and contributing templates.

## Dependency injection container

The lightweight [Dependency Injection](https://github.com/rdlowrey/auryn) component implements a PSR-11 compatible service container that allows you to standardize and centralize the way objects are constructed in your application.

Automatic load your dependencies using the type hinting.

You can disable plugin hooks very easily using a DIC. Just get the plugin object from the dependency injection container `$container_builder->get( PluginSlug\Front\Front::class )`. Example just disabling frontend assets:
```
function remove_plugin_slug_frontend_assets( $injector ) {
    $front = $injector->make( PluginSlug\Front\Front::class );
    if ( ! $front ) {
        return;
    }
    remove_action( 'wp_enqueue_scripts', [ $front, 'enqueue_styles' ] );
    remove_action( 'wp_enqueue_scripts', [ $front, 'enqueue_scripts' ] );
}

add_action( 'plugin_slug_init', 'remove_plugin_slug_frontend_assets' );
```

## PHP Scoper

You need to add prefixes for each outside dependency because other plugins or themes can use the same dependencies, and it can conflict between packages.

```
composer scoper
```

## Automated testing

We are using for automated testing a Codeception library runs all types of PHP tests.

### PHP unit tests

For running use a CLI command:
```
composer unit
```

- Main configuration file `.tests/php/unit.suite.yml`
- Unit tests inside `.tests/php/unit/*` folder.
- Bootstrap file `.tests/php/unit/_bootstrap.php`
- Each filename for test class must have a suffix on `*Test.php`.
- Each test class must extend a `PluginSlugUnitTests\TestCase` class.
- You can also add some code to `PluginSlugUnitTests\TestCase.php`
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

- Main configuration file `.tests/php/acceptance.suite.yml`
- Unit tests inside `.tests/php/acceptace/*` folder.
- Each filename for test class must have a suffix on `*Cest.php`.
- Each test method must have prefix `test_`
- Each test method must include `AcceptanceTester` as argument.
- You can add some methods to AcceptanceTester in `.codeception/_support/AcceptanceTests.php`.
- Additional files for autoload in tests running you can add to `.codeception/_support/*` folder.

### JS unit tests

For running use a CLI command:
```
npm run unit
```

- Main configuration inside `.tests/js/package.json` in directory `jest`
- Unit tests inside `.tests/js/unit/*` folder.
- Bootstrap file `.tests/js/setupTests.js`
- Each filename for test class must have a suffix on `*.test.js`.
- Just import your class for testing and write tests.

Also, unit tests will be checked on a push to repository action and inside the GH Actions pipeline.
