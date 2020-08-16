```php
if ( 
    isset( $_SERVER['HTTP_X_TESTING'] )
    || ( isset( $_SERVER['HTTP_USER_AGENT'] ) && $_SERVER['HTTP_USER_AGENT'] === 'wp-browser' )
    || getenv( 'WPBROWSER_HOST_REQUEST' )
) {
    // Use the test database if the request comes from a test.
    define( 'DB_NAME', 'codeception' );
} else {
    // Else use the default one (insert your local DB name here).
    define( 'DB_NAME', 'local' );
}
```
