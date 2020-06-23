## Firebird database driver for Laravel 6 with role in dsn

Based on Package [KKSzymanowski/laravel-6-firebird](https://github.com/KKSzymanowski/laravel-6-firebird.git) but simplified, modernized and made compatible with Laravel 6.

### Installation
```
composer require "sozinov/laravel-6-firebird-role:*"
``` 
Add you database configuration in `config/database.php`
```php
'connections' => [
    'myFirebirdConnection' => [
        'driver'=> 'firebird',
        'host'=> env('DB_FIREBIRD_HOST', 'localhost'),
        'database' => env('DB_FIREBIRD_DATABASE', '/path_to/database.fdb'),
        'username' => env('DB_FIREBIRD_USERNAME', 'SYSDBA'),
        'password' => env('DB_FIREBIRD_PASSWORD', 'masterkey'),
        'charset'  => env('DB_FIREBIRD_CHARSET', 'UTF8'),
		'role'     => env('DB_FIREBIRD_ROLE', ''), 
    ],

    // ...
],
```
Add the `DB_FIREBIRD_*` environment variables to you `.env` file, for example:
```
DB_FIREBIRD_HOST=192.168.0.1
DB_FIREBIRD_DATABASE=C:/DB.FDB
DB_FIREBIRD_USERNAME=user
DB_FIREBIRD_PASSWORD=password
DB_FIREBIRD_CHARSET=ISO-8859-2
DB_FIREBIRD_ROLE='' 
```

### Usage
#### Eloquent as model
To override your default database connection define `$connection` name in your Eloquent Model
```php
/**
 * The connection name for the model.
 *
 * @var string
 */
protected $connection = 'myFirebirdConnection';
```
After defining connection name you can use it in normal way as you use Eloquent:
```php
$user = User::where('id', 1)->get();

$users = User::all();
```

#### DB Query
Each time you have to define connecion name (if it isn't your default one), for example:
```php
$sql = 'SELECT * FROM USERS WHERE id = :id';
$bindings = ['id' => 1];
$user = DB::connection('myFirebirdConnection')->select($sql, $bindings);

$users = DB::connection('myFirebirdConnection')->table('USERS')->select('*')->get();
```
