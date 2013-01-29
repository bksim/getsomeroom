<?php

/**
 * This sample app is provided to kickstart your experience using Facebook's
 * resources for developers.  This sample app provides examples of several
 * key concepts, including authentication, the Graph API, and FQL (Facebook
 * Query Language). Please visit the docs at 'developers.facebook.com/docs'
 * to learn more about the resources available to you
 */

// Provides access to app specific values such as your app id and app secret.
// Defined in 'AppInfo.php'
require_once('AppInfo.php');

// Enforce https on production
if (substr(AppInfo::getUrl(), 0, 8) != 'https://' && $_SERVER['REMOTE_ADDR'] != '127.0.0.1') {
  header('Location: https://'. $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
  exit();
}

// This provides access to helper functions defined in 'utils.php'
require_once('utils.php');
require_once('sdk/src/facebook.php');

$facebook = new Facebook(array(
  'appId'  => AppInfo::appID(),
  'secret' => AppInfo::appSecret(),
  'sharedSession' => true,
  'trustForwarded' => true,
));

$user_id = $facebook->getUser();
if ($user_id) {
  try {
    // Fetch the viewer's basic information
    $basic = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    // If the call fails we check if we still have a user. The user will be
    // cleared if the error is because of an invalid accesstoken
    if (!$facebook->getUser()) {
      header('Location: '. AppInfo::getUrl($_SERVER['REQUEST_URI']));
      exit();
    }
  }
}
?>


<!DOCTYPE html>
<html xmlns:fb="http://ogp.me/ns/fb#" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0, user-scalable=yes" />

    <!--<title><?php echo he($app_name); ?></title>-->
    <link href='//fonts.googleapis.com/css?family=Didact+Gothic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="stylesheets/screen.css" media="Screen" type="text/css" />
    <link rel="stylesheet" href="stylesheets/mobile.css" media="handheld, only screen and (max-width: 480px), only screen and (max-device-width: 480px)" type="text/css" />
    <link rel="stylesheet" href="stylesheets/login.css" />
    <link href="stylesheets/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="stylesheets/bootstrap-responsive.min.css" />

    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    
    <!--[if IEMobile]>
    <link rel="stylesheet" href="mobile.css" media="screen" type="text/css"  />
    <![endif]-->

    <!-- These are Open Graph tags.  They add meta data to your  -->
    <!-- site that facebook uses when your content is shared     -->
    <!-- over facebook.  You should fill these tags in with      -->
    <!-- your data.  To learn more about Open Graph, visit       -->
    <!-- 'https://developers.facebook.com/docs/opengraph/'       -->
    <meta property="og:title" content="<?php echo he($app_name); ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?php echo AppInfo::getUrl(); ?>" />
    <meta property="og:image" content="<?php echo AppInfo::getUrl('/logo.png'); ?>" />
    <meta property="og:site_name" content="<?php echo he($app_name); ?>" />
    <meta property="og:description" content="My first app" />
    <meta property="fb:app_id" content="<?php echo AppInfo::appID(); ?>" />

    <script type="text/javascript" src="javascript/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="javascript/jquery.cycle.all.js"></script> 
    <script src="javascript/bootstrap.min.js"></script>

    <!-- testing cycle.js -->
    <script type="text/javascript">
    $(document).ready(function() {
        $('.slideshow').cycle({
            fx: 'fade' // choose your transition type, ex: fade, scrollUp, shuffle, etc...
        });
    });
    </script>
    <!--background slide change-->

    <!-- HANDLE NAV BAR NAVIGATION USING AJAX CALLS, HTML5-COMPLIANT-->
    <script type="text/javascript">                                         
      $(function(){
        $("a[rel='tab']").click(function(e){
          //e.preventDefault();
          //get clicked link location
          pageurl = $(this).attr('href');
          //alert(pageurl);
          //console.log("here");
          //update the div appropriately
          
          /*$.ajax({url:pageurl+'?rel=tab',success: function(data){
            $('#main').html(data);
          }});*/

$.ajax({url:pageurl,success: function(data){
            $('#main').html(data);
          }});
          //change browser URL to given link location
          /*if(pageurl!=window.location){
            alert(pageurl);

            window.history.pushState({path:pageurl},'',pageurl);
          }*/

          //stop refreshing to page   
          return false;
        });
      });

      //override back button to get ajax content
      /*$(window).bind('popstate', function(){
        $.ajax({url:location.pathname+'?rel=tab',success: function(data){
          $('#main').html(data);
        }});
      });*/                          
    </script>
    <!--END NAV BAR HANDLING-->

    <script type="text/javascript">
      function logResponse(response) {
        if (console && console.log) {
          console.log('The response was', response);
        }
      }

      $(function(){
        // Set up so we handle click on the buttons
        $('#postToWall').click(function() {
          FB.ui(
            {
              method : 'feed',
              link   : $(this).attr('data-url')
            },
            function (response) {
              // If response is null the user canceled the dialog
              if (response != null) {
                logResponse(response);
              }
            }
          );
        });

        $('#sendToFriends').click(function() {
          FB.ui(
            {
              method : 'send',
              link   : $(this).attr('data-url')
            },
            function (response) {
              // If response is null the user canceled the dialog
              if (response != null) {
                logResponse(response);
              }
            }
          );
        });

        $('#sendRequest').click(function() {
          FB.ui(
            {
              method  : 'apprequests',
              message : $(this).attr('data-message')
            },
            function (response) {
              // If response is null the user canceled the dialog
              if (response != null) {
                logResponse(response);
              }
            }
          );
        });
      });
    </script>

    <!--[if IE]>
      <script type="text/javascript">
        var tags = ['header', 'section'];
        while(tags.length)
          document.createElement(tags.pop());
      </script>
    <![endif]-->
  </head>

  <div></div>
  <body>

    <!--background slide change-->
    <div id="mt-bg" class="slideshow">
      <img src="images/sanfrancisco.jpg">
      <img src="images/newyork.jpg">
      <img src="images/hongkong.jpg">
    </div>
    <!--background slide change--> 

    <div id="fb-root"></div>
    <script type="text/javascript">
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '<?php echo AppInfo::appID(); ?>', // App ID
          channelUrl : '//<?php echo $_SERVER["HTTP_HOST"]; ?>/channel.html', // Channel File
          status     : true, // check login status
          cookie     : true, // enable cookies to allow the server to access the session
          xfbml      : true // parse XFBML
        });

        // Listen to the auth.login which will be called when the user logs in
        // using the Login button
        FB.Event.subscribe('auth.login', function(response) {
          // We want to reload the page now so PHP can read the cookie that the
          // Javascript SDK sat. But we don't want to use
          // window.location.reload() because if this is in a canvas there was a
          // post made to this page and a reload will trigger a message to the
          // user asking if they want to send data again.
          console.log(response);
          window.location = window.location;
        });

        FB.Canvas.setAutoGrow();
      };

      // Load the SDK Asynchronously
      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/all.js";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>

    <header class="clearfix">
    </header>

    <!-- IF USER IS LOGGED IN AND BASIC IS SET -->
    <?php if (isset($basic)) { ?>

    <!-- NAV BAR ONLY IF LOGGED IN -->
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container" style="padding-left:5%;padding-right:5%;width:auto;">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="/">get some room</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li><a href="matches.php"rel="tab">matches</a></li>
              <li><a href="survey.php" rel="tab">view/edit profile</a></li>
              <li><a href="about.php" rel="tab">about</a></li>
              <li><a href="faq.php" rel="tab">faq</a></li>
            </ul>


            <ul class="nav pull-right" style="width:15%;">
              <?php $pictureurl = 'https://graph.facebook.com/' . $basic['id'] . '/picture';?>
              <img src="<? echo $pictureurl; ?>" width="35" height="35">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $basic['name'];?><b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="survey.php" rel="tab">Profile</a></li>
                  <li><a href="logout.php" rel="tab">Logout</a></li>
                </ul>
              </li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>


       <div class="container" id="main" style="padding-top: 12px; margin-bottom: 20px; margin-top: 15px; margin-left: 90px; margin-right: 90px; 
       padding-bottom: 70px; padding-left: 20px; padding-right: 20px; width: auto; height: 500px; 
       z-index: 60; background-color: #000000; opacity:0.85; border-radius: 60px 60px 60px 60px / 60px 60px 60px 60px;">
       <br>
       <div id = "welcome">
       <h2 style="color:#FFFFFF; font-size: 28px; font-weight: bolder; "> Welcome to Get Some Room,  <?php echo $basic['name'];?>. </h2> 
       <h3 style="font-size: 22px; color: #463E3F;"> Follow these steps to set up/edit your profile and find potential roommates matches no matter what city you'll be interning in.</h3>
       <br>
       
       <h4>
          <dl style="color: #FFFFFF; font-size: 14px;"> 
            <dt style="color:#B23AEE;">Start searching by editing your profile.</dt>
            <dd>Click "view/edit profile" in the navigation bar to fill out some basic information about yourself. We'll use the information to search up the best matches for you.</dd>
              <br>
            <dt style="color:#B23AEE;"> After pressing submit, click "matches" to check out your matches! </dt>
            <dd> The matches page will list in order the best matches pertaining to info you filled out. Profiles with some basic info of the matches will be shown. To strike up a conversation with them, click on the message button on the side. </dd>
          <br>
            <dt style="color:#B23AEE;">Feel free to edit your profile anytime with updated information. </dt>
            <dd> Feel free to update your profile anytime should information change. Simply resubmit the information, and we will create new possible matches. </dd>
            <br>
          <dt style="color:#B23AEE;"> Questions? Concerns? </dt>
          <dd> Go to our about or FAQ pages to learn more about get some room. Shoot us a message if you have questions! </dd> 
          </dl>
        </h3>
      </div> <!--welcome-->
      </div> <!-- /container -->

    <!-- IF USER IS NOT LOGGED IN SHOW LOGIN PAGE -->
    <?php } else { ?>

      <div id="logincontainer" style="margin-right:300px;">
        <h2 id="aTitle" style="font-weight:bold;">welcome to getsomeroom.</h2>
        <p id="tagline">find roommates for the summer/winter wherever you intern. </p>  
        <div id="loginbox">
          <br>
          <!-- AddThis Button BEGIN -->
          <div id="login-flow" style="padding-left:30px;">
            <!-- <fb:login-button size="xlarge" perms="email,offline_access" show-faces="false" onlogin="Log.info('onlogin callback')" style="font-family:'Franklin Gothic Medium' background-color:#00009C;">
              Sign Up With Facebook</fb:login-button> -->
              <!-- <div class="fb-login-button" data-scope="user_likes,user_photos"></div> -->

              <div id='login'><a href="#" id='facebook-login' onclick='fblogin();'><img src="images/fblogin.jpg" /></a></div>
              </a>
              <script>
              function fblogin(){
                FB.login(function(response) {
                   if (response.session) {
                if (response.perms) {
                    // user is logged in and granted some permissions.
                    // perms is a comma separated list of granted permissions
                    window.location.reload();
                    /*$.ajax({url:'matches.php',success: function(data){
                      $('#main').html(data);
                    }});*/
                } else {
                    // user is logged in, but did not grant any permissions
                    window.location.reload();
                }
            } else {
                // user is not logged in
                window.location.reload();
            }
        }, {scope:'email, user_likes, user_photos'});
        return false;
    }
          </script>
              <!--<a href="#" onclick="oauth_login_url;"><img src="images/facebooklogin.jpg" border="0" alt=""></a> -->
          </div>
          <div class="addthis_toolbox addthis_default_style " style="margin:0 auto;margin-top:20px;width:155px;">
            <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
            <a class="addthis_button_tweet" style="width:69px;"></a>
          </div>
          <script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
          <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-50552bd1589c29ce"></script>

          <!-- AddThis Button END -->
        </div>
      </div>
    <?php } ?>
  </body>
  <?php include 'footer.php'?>
</html>
