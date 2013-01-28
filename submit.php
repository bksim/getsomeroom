<?php

/*added to database*/
/*

CREATE FUNCTION merge_db(fb_id BIGINT, last_name TEXT, first_name TEXT, college_v TEXT, cityintern_v TEXT, speccity TEXT, gender TEXT, 
found_housing BOOLEAN, housing_pref TEXT, comp TEXT, intern_job TEXT, more_info TEXT, cook BOOLEAN, party BOOLEAN, smoke BOOLEAN, 
quiet BOOLEAN, night BOOLEAN, morning BOOLEAN) RETURNS VOID AS
$$
BEGIN
    LOOP
        -- first try to update the key
        UPDATE users SET lastname = last_name, 
        firstname = first_name,
        college = college_v,
        cityintern = cityintern_v,
        specificpartcity = speccity,
        genderpref = gender,
        foundhousing = found_housing,
        housingpref = housing_pref,
        company = comp,
        internjob = intern_job,
        moreinfo = more_info,
        checkitemcook = cook,
        checkitemsmoke = smoke,
        checkitemquiet = quiet,
        checkitemnightowl = night,
        checkitemmorningbird = morning 
        WHERE fbid = fb_id;
        IF found THEN
            RETURN;
        END IF;
        -- not there, so try to insert the key
        -- if someone else inserts the same key concurrently,
        -- we could get a unique-key failure
        BEGIN
            INSERT INTO users(fbid,lastname,firstname,college,cityintern,specificpartcity,genderpref,
            foundhousing,housingpref,company,internjob,moreinfo,checkitemcook,checkitemsmoke,
            checkitemquiet,checkitemnightowl,checkitemmorningbird) 
            VALUES (fb_id, last_name, first_name, college_v, cityintern_v, speccity, gender, found_housing, housing_pref, comp,
            intern_job, more_info, cook, smoke, quiet, night, morning);
            RETURN;
        EXCEPTION WHEN unique_violation THEN
            -- Do nothing, and loop to try the UPDATE again.
        END;
    END LOOP;
END;
$$
LANGUAGE plpgsql;
*/

    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $fbid = (int)$_POST['fbid'];
    $college = $_POST['inputCollege']; 
    $cityIntern = $_POST['formCity'];
    $specificPartCity = $_POST['partCity']; 
    $genderPref = $_POST['inputGender']; 
    $foundHousing = $_POST['inputFound'];
    $housingPref = $_POST['inputHousing']; //required
    $company = $_POST['inputCompany']; // required
    $internJob = $_POST['inputRole'];//required
    $moreInfo = $_POST['moreinfo']; //required
    $checkItemCook = $_POST['checkBox1']; // required
    if (!isset($checkItemCook)) $checkItemCook = "f";
    
    $checkItemParty = $_POST['checkBox2'];//required
    if (!isset($checkItemParty)) $checkItemParty = "f";

    $checkItemSmoke = $_POST['checkBox3'];
    if (!isset($checkItemSmoke)) $checkItemSmoke = "f";

    $checkItemQuiet = $_POST['checkBox4'];
    if (!isset($checkItemQuiet)) $checkItemQuiet = "f";

    $checkItemNightOwl = $_POST['checkBox5'];
    if (!isset($checkItemNightOwl)) $checkItemNightOwl = "f";

    $checkItemMorningBird = $_POST['checkBox6'];
    if (!isset($checkItemMorningBird)) $checkItemMorningBird = "f";

    # This function reads your DATABASE_URL configuration automatically set by Heroku
    # the return value is a string that will work with pg_connect
    function pg_connection_string() {
      return "dbname=daanlenp3al7n5 host=ec2-54-243-230-216.compute-1.amazonaws.com port=5432 user=cjykxetwjrzkrk password=jQ-kNfCjoVqqGbZi0NeM7GzurA sslmode=require";

      # Establish db connection
    $db = pg_connect(pg_connection_string());
    
    // FUNCTION ABOVE CHECKS IF FBID ALREADY EXISTS IN DATABASE
    //IF SO USE UPDATE INSTEAD OF INSERT

 $query_insert = "SELECT merge_db(" . $fbid . ",
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
        '$checkItemQuiet',
        '$checkItemNightOwl',
        '$checkItemMorningBird');";

    /*
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
    	'$checkItemQuiet',
    	'$checkItemNightOwl',
    	'$checkItemMorningBird')";*/

    $result = pg_query($db, $query_insert);

    /*if (!$result) {
      die("Error in SQL query: " . pg_last_error());
    }*/
    // free memory
    pg_free_result($result);

    // close connection
    pg_close($db);
    header('Location: index.php'); 
?>