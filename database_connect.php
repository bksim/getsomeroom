<?php 
    $name = $_POST['name'];
    $id = $_POST['id'];
    $gender = $_POST['gender'];

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
    
    # given a POSTGRESQL result row, prints a line in matches.php
    # returns a string with HTML for one block in the matches results corresponding to that row
    function print_match_result($row){
        $fbid = $row['fbid'];
        $fb_url = "https://www.facebook.com/" . $fbid;
        $fb_profile_pic_url = "https://graph.facebook.com/" . $fbid . "/picture?type=square";

        //clickable picture
        $result_string = "<a href=" . $fb_url . "><img src=" . $fb_profile_pic_url . "></a>";

        //spacing
        $result_string .= "&nbsp;&nbsp;&nbsp;";

        //add link to profile from name
        $result_string .= "<a href=" . $fb_url . ">" . $row['firstname'] . " " . $row['lastname'] . "</a>";

        //add college info
        $result_string .= ", " . $row['college'];

        //add message button

        $result_string .= "<a href='https://www.facebook.com/dialog/send?to=" . $fbid . "&app_id=195569513923216&name=getsomeroom&link=https://getsomeroom.herokuapp.com&redirect_uri=https://getsomeroom.herokuapp.com'><img src='images/sendmessage.gif' align='right' style='height:35px;padding-right:30px;'></a>";

        return $result_string;
    }

    # if user had filled out the profile and had put a city...
    if (isset($city))
    {
        if ($gender == "female")
        {
            $query_samecity = "SELECT * FROM users WHERE cityintern = '$city' AND fbid <> " . $id . " ORDER BY genderpref ASC;";
        }

        else
        {
            $query_samecity = "SELECT * FROM users WHERE cityintern = '$city' AND fbid <> " . $id . " ORDER BY genderpref DESC;";
        }

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

        $resultstring = "Displaying all users interning in " . $cityname . " in order of compatibility: <hr>";
        # gets everyone who put the same city except the user him/herself
        //$query_samecity = "SELECT * FROM users WHERE cityintern = '$city' AND fbid <> " . $id . ";";
        $result_city = pg_query($db, $query_samecity);
        while ($row_samecity = pg_fetch_assoc($result_city))
        {
            $resultstring .= print_match_result($row_samecity);
            $resultstring .= "<hr>";
        }
        echo $resultstring;
    }

    else{
        echo "Please fill in your profile first so we can find you matches!";
    }

    //close connection
    pg_close($db);
?>