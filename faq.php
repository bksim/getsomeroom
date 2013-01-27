<!DOCTYPE html>
<html lang="en">
  <head>

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
    <link href="../assets/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="../assets/ico/favicon.png">
  </head>

  <body>

    <div class="container-narrow">
      <div class="jumbotron">
        <h2>FAQ</h2>
        <p class="lead">What is the purpose of Get A Room?</p>
        <p class="answer"> To meet new people who can possibly be your roomates for the summer! </p>
        
        <p class="lead">What types of features are considered when matching roomates?</p>
        <p class="answer">The city you will be interning in, gender and housing preferences, mutual friends, the specific parts of the city you would like to live in, as well as your interests. </p>
        
        <p class="lead">What mediums are there for contacting potential roomates?</p>
        <p class="answer"> We provide you with a limited profile of the other user. There is a messaging system on our site, should you be interested in contacting the person. </p>
        
        <p class="lead">How can I ensure this site is safe?</p>
        <p class="answer"> We include logins via Facebook to ensure authentication and also provide a limited portion of your profile for others to view. We do not include your internship activity or company. </p>
        
        <a class="btn btn-large btn-success" href="#">questions?</a>

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

    </div> <!-- /container -->