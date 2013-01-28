<?php 
    $name = $_POST['name'];
    $id = $_POST['id'];

    # This function reads your DATABASE_URL configuration automatically set by Heroku
    # the return value is a string that will work with pg_connect
    function pg_connection_string() {
      return "dbname=daanlenp3al7n5 host=ec2-54-243-230-216.compute-1.amazonaws.com port=5432 user=cjykxetwjrzkrk password=jQ-kNfCjoVqqGbZi0NeM7GzurA sslmode=require";
    }

    # Establish db connection
    $db = pg_connect(pg_connection_string());

    $sqlquery = "SELECT * FROM users WHERE fbid=" . $id;
    $result = pg_query($db, $sqlquery);
    echo $result['fbid'] . $result['college'];

    //close connection
    pg_close($db);
?>