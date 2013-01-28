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
			<label class = "control-label" for="inputCollege"> What college do you attend?</label>

			<div class="controls">
				<input type="text" name="inputCollege" placeholder="">
			</div>
		</div>

	<div class="control-group">
	  <label class="control-label">Select the city you'll be interning in</label>
	   <div class="controls">
		<select name="formCity">
			<option value="BOS">Boston, MA</option>
			<option value="CAM">Cambridge, MA</option>
			<option value="CHI">Chicago, IL</option>
			<option value="HK">Hong Kong, HK</option>
			<option value="LON">London, UK</option>
			<option value="NY">New York, NY</option>
			<option value="PA">Palo Alto, CA</option>
			<option value="PHI">Philadelphia, PA</option>
			<option value="SF">San Francisco, CA</option>
			<option value="SEA">Seattle, WA</option>
			<option value="SHG">Shanghai, China</option>
			<option value="other">Other</option>
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
	  <label class="control-label">Gender preference?</label>
	   <div class="controls">
		<select name="inputGender">
  			<option value="F">Female</option>
  			<option value="M">Male</option>
  			<option value="O">Don't care</option>
		</select>
		</div>
	</div>

		
	<div class="control-group">
	  <label class="control-label">Have you already found housing?</label>
	   <div class="controls">
		<select name="inputFound">
  			<option value="t">Yes, now I just need roommates</option>
  			<option value="f">Nope.</option>
			</select>
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


	  <br>Check all items that apply:
	  <br>
	  <div class="control-group">

 
		<label class="checkbox" style="margin-left: 170px">
	  		<input type="checkbox" name="checkBox1" value="t" checked>
	  I enjoy cooking. 
		</label>
		<label class="checkbox" style="margin-left: 170px">
	  		<input type="checkbox" name="checkBox2" value="t">
	  I like to party.
		</label>
		<label class="checkbox" style="margin-left: 170px">
	  		<input type="checkbox" name="checkBox3" value="t">
	   I like to smoke. 
		</label>
		<label class="checkbox" style="margin-left: 170px">
	  		<input type="checkbox" name="checkBox4" value="t" checked>
	  I prefer a quiet roomate. 
		</label>
		<label class="checkbox" style="margin-left: 170px">
	  		<input type="checkbox" name="checkBox5" value="t" checked>
	  I am a night owl. 
		</label>
		<label class="checkbox" style="margin-left: 170px">
	  		<input type="checkbox" name="checkBox6" value="t" checked>
	  I am a morning bird. 
		</label>
		  <div class="control-group">
		    <div class="controls">
		      <button type="submit" class="btn">submit</button>
		    </div>
		  </div>
		</form>