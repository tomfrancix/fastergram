<?php 

//Saving connection variables in arrays
$db['db_host'] = 'localhost';
$db['db_user'] = 'root';
$db['db_pass'] = '';
$db['db_name'] = 'Vortex';

//$db['db_host'] = 'mysql6003.site4now.net';
//$db['db_user'] = 'a663af_fastdb';
//$db['db_pass'] = 'Manage3software4';
//$db['db_name'] = 'db_a663af_fastdb';

//Saving connection variables as constants
foreach($db as $key => $value) {
    
    define(strtoupper($key), $value);

}
//Connect to the database
$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);

//Confirm connection
if($connection) {
//echo "We are connected";
}

?>