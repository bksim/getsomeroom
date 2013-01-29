<?php 
    # This function reads your DATABASE_URL configuration automatically set by Heroku
    # the return value is a string that will work with pg_connect
    function pg_connection_string() {
      return "dbname=daanlenp3al7n5 host=ec2-54-243-230-216.compute-1.amazonaws.com port=5432 user=cjykxetwjrzkrk password=jQ-kNfCjoVqqGbZi0NeM7GzurA sslmode=require";
    }

    # Establish db connection
    $db = pg_connect(pg_connection_string());

    # retrieves the city that the user is interning in
    $sqlquery = "SELECT * FROM users;";
    $result = pg_query($db, $sqlquery);

    while($row=pg_fetch_assoc($result))
    {
        $city = $row['cityintern'];
    }

    $resultstring = "";
    
    
    # if user had filled out the profile and had put a city...
    if (isset($city))
    {
        # match cities to names
        switch ($city) {
        case "BOS":
            $cityname = "Boston";

            break;
        case "CAM":
            $cityname = "Cambridge, MA";
            break;
        case "CHI":
            $cityname = "Chicago";
            break;
        case "HK":
            $cityname = "Hong Kong";
            break;
        case "LON":
            $cityname = "London";
            break;
        case "LA":
            $cityname = "Los Angeles";
            break;
        case "NY":
            $cityname = "New York";
            break;
        case "PA":
            $cityname = "Palo Alto";
            break;
        case "PHI":
            $cityname = "Philadelphia";
            break;
        case "SF":
            $cityname = "San Francisco";
            break;
        case "SEA":
            $cityname = "Seattle";
            break;
        case "SHG":
            $cityname = "Shanghai";
            break;
        case "other":
            $cityname = "your city";
            break;
        default:
            $cityname = "your city";
        }

        echo $resultstring;
    }

    else{
    }

    //close connection
    pg_close($db);
?>