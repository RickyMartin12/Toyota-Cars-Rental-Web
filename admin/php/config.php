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
	"user" => $username,       // Database user name
	"pass" => $password,       // Database password
	"host" => $servername,       // Database host
	"port" => "",       // Database connection port (can be left empty for default)
	"db"   => $dbname,
	"dsn"  => ""        // PHP DSN extra information. Set as `charset=utf8` if you are using MySQL
);


