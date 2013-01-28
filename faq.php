    <!-- Le styles -->
    <style type="text/css">
      body {
        
      }

      /* Custom container */
      .container-narrow {
        margin: 0 auto;
        max-width: 700px;
      }
      .container-narrow > hr {
        margin: 10px 0;
      }

      .lead{
        font-size: 16px;
        font-style: bold;
        text-align: left;
      }

      .answer{
      	font-size: 14px;
        font-style:italic;
        text-align: left;
      }

      /* Main marketing message and sign up button */
      .jumbotron {
        margin: 60px 0;
        text-align: center;
      }
      .jumbotron h1 {
        font-size: 72px;
        line-height: 1;
      }
      .jumbotron .btn {
        font-size: 21px;
        padding: 14px 24px;
      }

    </style>

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
        <div style="padding-left: 200px; padding-right: 200px; font-weight: 900; overflow-y:auto; padding-top: 20px; width: auto; height: 500px; color:#FFFFFF;">

        <h2>FAQ</h2>
        <p class="lead">What is the purpose of Get A Room?</p>
        <p class="answer"> To meet new people who can possibly be your roomates for the summer! </p>
        
        <p class="lead">What types of features are considered when matching roomates?</p>
        <p class="answer">The city you will be interning in, gender and housing preferences, mutual friends, the specific parts of the city you would like to live in, as well as your interests. </p>
        
        <p class="lead">What mediums are there for contacting potential roomates?</p>
        <p class="answer"> We provide you with a limited profile of the other user. There is a messaging system on our site, should you be interested in contacting the person. </p>
        
        <p class="lead">How can I ensure this site is safe?</p>
        <p class="answer"> We include logins via Facebook to ensure authentication and also provide a limited portion of your profile for others to view. We do not include your internship activity or company. </p>
        
        <a href="#myModal" role="button" class="btn" data-toggle="modal">Questions?</a>
         
        <!-- Modal -->
        <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Modal header</h3>
          </div>
          <div class="modal-body">
            <p>One fine body…</p>
          </div>
          <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            <button class="btn btn-primary">Save changes</button>
          </div>
        </div>

        <form name="contactform" method="post" action="contact.php">
          <table width="450px">
            <tr>
          <td valign="top">
          <label for="first_name">First Name</label>
            </td>
            <td valign="top">
          <input  type="text" name="first_name" maxlength="50" size="30">
          </td>
        </tr>
        <tr>
        <td valign="top">
        <label for="last_name">Last Name</label>
        </td>
        <td valign="top">
        <input  type="text" name="last_name" maxlength="50" size="30">
        </td>
        </tr>
        <tr>
        <td valign="top">
          <label for="email">Email Address</label>
        </td>
        </tr>
        <tr>
    <td valign="top">
    <label for="comments">Comments *</label>
  </td>
  <td valign="top">
    <textarea  name="comments" maxlength="1000" cols="25" rows="6"></textarea>
  </td>
    </tr>
        </table>
        </form>
      </div>
