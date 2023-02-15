<?php if (!defined('DATATABLES')) exit(); // Ensure being used in DataTables env.


require_once '../connect.php';

// Enable error reporting for debugging (remove for production)
error_reporting(E_ALL);
ini_set('display_errors', '1');

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Database user / pass
 */
$sql_details = array(
	"type" => "Mysql",  // Database type: "Mysql", "Postgres", "Sqlserver", "Sqlite" or "Oracle"
	"user" => "root",       // Database user name
	"pass" => "wyGJjUpFOoD8FRzcWEk2",       // Database password
	"host" => "containers-us-west-193.railway.app",       // Database host
	"port" => "7728",       // Database connection port (can be left empty for default)
	"db"   => "railway",
	"dsn"  => ""        // PHP DSN extra information. Set as `charset=utf8` if you are using MySQL
);


