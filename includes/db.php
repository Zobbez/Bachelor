<?php
// all the db login values are put into an array called $db, im using root as password because im on a mac.
    $db['db_host'] = "localhost";
    $db['db_user'] = "root";
    $db['db_pass'] = "root";
    $db['db_name'] = "cms";

// using a loop and converting the key value pairs of the $db array into constants and uppercase the key 
    foreach( $db as $key => $value ) {

    define(strtoupper($key), $value);


}

    $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

/* if($connection) {

echo "the db is connected";


} */