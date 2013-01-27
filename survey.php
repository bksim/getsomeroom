	 <?php
	$college = $_POST['inputCollege']; 
    $cityIntern = $_POST['inputCity'];
    $specificPartCity = $_POST['partCity'] 
    $genderPref = $_POST['inputGender']; 
    /*$foundHousing = $_POST['inputFound'];*/
    $foundHousing = 0;
    /*
    $housingPref = $_POST['inputHousing']; //required
    $company = $_POST['inputCompany']; // required
    $internJob = $_POST['inputRole'];//required
    $moreInfo = $_POST['moreinfo']; //required
    $checkItemCook = $_POST['optionscheckboxs1']; // required
    $checkItemParty = $_POST['optionscheckboxs2'];//required
    $checkItemSmoke = $_POST['optionscheckboxs3'];
    $quiet = FALSE; //change later
    $nightowl = FALSE;
    $morningbird = FALSE;*/
/*
    if ($cityIntern == "yes") {
    	$cityIntern = TRUE;
    }
    else{
    	$cityIntern = FALSE;
    }*/


    # This function reads your DATABASE_URL configuration automatically set by Heroku
    # the return value is a string that will work with pg_connect
    /*function pg_connection_string() {
      return "dbname=daanlenp3al7n5 host=ec2-54-243-230-216.compute-1.amazonaws.com port=5432 user=cjykxetwjrzkrk password=jQ-kNfCjoVqqGbZi0NeM7GzurA sslmode=require";
    }*/
    # Establish db connection
    //$db = pg_connect(pg_connection_string());
    
    /*$dbc = pg_connect("dbname=daanlenp3al7n5 host=ec2-54-243-230-216.compute-1.amazonaws.com port=5432 user=cjykxetwjrzkrk password=jQ-kNfCjoVqqGbZi0NeM7GzurA sslmode=require");
    #NOTE: DIDN'T INSERT THEIR FIRST/LAST NAMES OR FBID

    $query_insert = "INSERT INTO users VALUES (1,
    	'Chang',
    	'Ava',
    	'$college',
    	'$cityIntern',
    	'$specificPartCity',
    	'$genderPref',
    	$foundHousing,
    	'$housingPref',
    	'$company',
    	'$internJob',
    	'$moreInfo',
    	$checkItemParty,
    	$checkItemSmoke,
    	$quiet,
    	$nightowl,
    	$morningbird)";

	 $rq = "SELECT * FROM users";

	 var_dump($query_insert);

    $result = pg_query($dbc, $rq);

    if (!$result) {
      die("Error in SQL query: " . pg_last_error());
    }
    // free memory
    pg_free_result($result);

    // close connection
    pg_close($dbc);*/

    ?>

	<form action="<?php $_SERVER["PHP_SELF"]?>" method=post class="form-horizontal">
	  <div class="control-group">
	    <label class="control-label" for="inputCollege">college/university attending:</label>
	    <div class="controls">
	      <input type="text" name="inputCollege" placeholder="">
	    </div>
	  </div
	  <div class="control-group">
	    <label class="control-label" for="inputCity">city interning in:</label>
	    <div class="controls">
	      <input type="text" name="inputCity" placeholder="">
	    </div>
	  </div>

	  <div class="control-group">
	    <label class="control-label" for="partCity">part of city (for ex: Uptown)</label>
	    <div class="controls">
	      <input type="text" name="partCity" placeholder="">
	    </div>
	  </div>

	  <div class="control-group">
	    <label class="control-label" for="inputGender">gender roomate preference?</label>
	    <div class="controls">
	      <input type="text" name="inputGender" placeholder="female/male/I don't care">
	    </div>
		</div>
		<div class="control-group">
	    <label class="control-label" for="inputFound">have you already found housing?</label>
	    <div class="controls">
	      <input type="text" name="inputFound" placeholder="yes/no">
	    </div>
		</div>
	    <div class="control-group">
	    <label class="control-label" for="inputHousing">type of housing you prefer?</label>
	    <div class="controls">
	      <input type="text" name="inputHousing" placeholder="apartment/mansion/hostel/dgaf">
	    </div>
	  </div>
	  <div class="control-group">
	    <label class="control-label" for="inputCompany">what company are you working for?</label>
	    <div class="controls">
	      <input type="text" name="inputCompany" placeholder="">
	    </div>
	  </div>
	  <div class="control-group">
	    <label class="control-label" for="inputRole">specific internship role?</label>
	    <div class="controls">
	      <input type="text" name="inputRole" placeholder="">
	    </div>
	  </div>

	  <div class="control-group">
	    <label class="control-label" for="moreinfo">More Info</label>
	    <div class="controls">
	      <input type="text" name="moreinfo" placeholder="">
	    </div>
	  </div>


	  <br>Check the items you agree with
	  <br>
	  <div class="control-group">

 
	<label class="checkbox" style="margin-left: 170px">
  <input type="checkbox" name="optionscheckboxs1" id="optionscheckboxs1" value="option1" checked>
  I love people who cook
	</label>
	<label class="checkbox" style="margin-left: 170px">
  <input type="checkbox" name="optionscheckboxs2" id="optionscheckboxs2" value="option2">
  Brandon sucks
	</label>
	<label class="checkbox" style="margin-left: 170px">
  <input type="checkbox" name="optionscheckboxs3" id="optionscheckboxs2" value="option2">
  Ava is awesome
	</label>
	  <div class="control-group">
	    <div class="controls">
	      <button type="submit" class="btn">submit</button>
	    </div>
	  </div>
	</form>