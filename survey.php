<script>FB.api('/me', function(response) {
  document.getElementById("fbid").value=response.id;
  var temp = response.name.split(" ");
  document.getElementById("lastname").value=temp[1];
  document.getElementById("firstname").value=temp[0];
});</script>

	<form action="submit.php" method=post class="form-horizontal">
		<input type="hidden" id="fbid" name="fbid" value="">
		<input type="hidden" id="lastname" name="lastname" value="">
		<input type="hidden" id="firstname" name="firstname" value="">
	  <div class="control-group">
	    <label class="control-label" for="inputCollege">college/university attending:</label>
	    <div class="controls">
	      <input type="text" name="inputCollege" placeholder="">
	    </div>
	  </div
 
	  <div class="control-group">
 		<label class="control-label" for="inputCity">Select the city you will be interning in. If the city isn't there, please select "other":</label>
 	<div class="controls">
	  <select>
  		<option id="NY">New York, NY</option>
  		<option id="SF">San Francisco, CA</option>
  		<option id="Paly">Palo Alto, CA</option>
  		<option id="CBRIDGE">Cambridge, MA</option>
  		<option id="BOS">Boston, MA</option>
  		<option id="Philly">Philadelphia, PA</option>
  		<option id="Chic">Chicago, IL</option>
  		<option id="Shang">Shanghai, China</option>
  		<option id="HK">Hong Kong, HK</option>
  		<option id="other">Other</option>
			</select>
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