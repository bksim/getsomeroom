


<script> 
  // GET STUFF FROM FACEBOOK, MAKE AJAX CALL TO DATABASE
  FB.api('/me', function(response) {
    $('#title').html("<h1>Time for you to getsomeroom, " + response.name + "</h1>");

    $.post(
      "database_connect.php",
      { "name": response.name, "id": response.id},
      function(data){
        if (data){
          //if data is not null
          if (data === "<hr>")
          {
            data = "<hr>you have no matches :( #foreveralone";
          }
          $('#matches').html(data);
        }
      }
    );
  });
</script>

<div id="match-container" style="color:#FFFFFF;">
  <div id="title"></div>
  <div id="matches" style="width: auto; height: 500px; overflow-y:auto;">
    we're looking for your matches...
  <div id="matches">
    <img src="images/ajax_loader.gif" style="padding-left:50%;">
  </div>
</div>
