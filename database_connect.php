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

    # retrieves the city that the user is interning in
    $sqlquery = "SELECT * FROM users WHERE fbid=" . $id . ";";
    $result = pg_query($db, $sqlquery);

    while($row=pg_fetch_assoc($result))
    {
        $city = $row['cityintern'];
    }
    
    echo isset($city);
    # if user had filled out the profile and had put a city...
    /*if isset($city)
    {
        $resultstring = "<hr>";
        # gets everyone who put the same city except the user him/herself
        $query_samecity = "SELECT * FROM users WHERE cityintern = '$city' AND fbid <> " . $id . ";";
        $result_city = pg_query($db, $query_samecity);
        while ($row_samecity = pg_fetch_assoc($result_city))
        {
            $resultstring = $resultstring . $row_samecity['firstname'] . " " . 
            $row_samecity['lastname'] . " " . $row_samecity['college'] . "<hr>";
            $resultstring = $resultstring . $row_samecity['firstname'];
        }
        echo $resultstring;
    }

    else{
        echo "Please fill in your profile first so we can find you matches!";
    }*/

    //close connection
    pg_close($db);
?>