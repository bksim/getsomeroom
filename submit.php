<?php
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $fbid = (int)$_POST['fbid'];
	$college = $_POST['inputCollege']; 
    $cityIntern = $_POST['inputCity'];
    $specificPartCity = $_POST['partCity']; 
    $genderPref = $_POST['inputGender']; 
    //$foundHousing = $_POST['inputFound'];
    $foundHousing = "f";
    $housingPref = $_POST['inputHousing']; //required
    $company = $_POST['inputCompany']; // required
    $internJob = $_POST['inputRole'];//required
    $moreInfo = $_POST['moreinfo']; //required
    /*$checkItemCook = $_POST['optionscheckboxs1']; // required
    $checkItemParty = $_POST['optionscheckboxs2'];//required
    $checkItemSmoke = $_POST['optionscheckboxs3'];*/

    $checkItemCook = 'f';
    $checkItemParty = 'f';
    $checkItemSmoke = 'f';
    $quiet = 'f'; //change later
    $nightowl = 'f';
    $morningbird = 'f';

    # This function reads your DATABASE_URL configuration automatically set by Heroku
    # the return value is a string that will work with pg_connect
    function pg_connection_string() {
      return "dbname=daanlenp3al7n5 host=ec2-54-243-230-216.compute-1.amazonaws.com port=5432 user=cjykxetwjrzkrk password=jQ-kNfCjoVqqGbZi0NeM7GzurA sslmode=require";
    }
    # Establish db connection
    $db = pg_connect(pg_connection_string());
    
    // NEED TO CHECK IF FBID ALREADY EXISTS IN DATABASE
    //IF SO USE UPDATE INSTEAD OF INSERT

        #NOTE: DIDN'T INSERT THEIR FIRST/LAST NAMES OR FBID
    $query_insert = "INSERT INTO users VALUES (" . $fbid . ",
    	'$lastname',
    	'$firstname',
    	'$college',
    	'$cityIntern',
    	'$specificPartCity',
    	'$genderPref',
    	'$foundHousing',
    	'$housingPref',
    	'$company',
    	'$internJob',
    	'$moreInfo', 
        '$checkItemCook',
    	'$checkItemParty', 
    	'$checkItemSmoke',
    	'$quiet',
    	'$nightowl',
    	'$morningbird')" . 

        "ON DUPLICATE KEY UPDATE
            college='$college',
            cityIntern='$cityIntern',
            specificPartCity='$specificPartCity',
            genderPref='$genderPref',
            foundHousing = '$foundHousing',
            housingPref = '$housingPref',
            company = '$company',
            internJob = '$internJob',
            moreInfo = '$moreInfo',
            checkItemCook = '$checkItemCook',
            checkItemParty = '$checkItemParty',
            checkItemSmoke = '$checkItemSmoke',
            checkItemQuiet = '$quiet',
            checkItemNightOwl = '$nightowl',
            checkItemMorningBird = '$morningbird'
            ";



    $result = pg_query($db, $query_insert);

    if (!$result) {
      die("Error in SQL query: " . pg_last_error());
    }
    // free memory
    pg_free_result($result);

    // close connection
    pg_close($db);
    header('Location: index.php'); 
?>