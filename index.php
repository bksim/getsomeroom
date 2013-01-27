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


/*****************************************************************************
 *
 * The content below provides examples of how to fetch Facebook data using the
 * Graph API and FQL.  It uses the helper functions defined in 'utils.php' to
 * do so.  You should change this section so that it prepares all of the
 * information that you want to display to the user.
 *
 ****************************************************************************/

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

  // This fetches some things that you like . 'limit=*" only returns * values.
  // To see the format of the data you are retrieving, use the "Graph API
  // Explorer" which is at https://developers.facebook.com/tools/explorer/
  $likes = idx($facebook->api('/me/likes?limit=4'), 'data', array());

  // This fetches 4 of your friends.
  $friends = idx($facebook->api('/me/friends?limit=4'), 'data', array());

  // And this returns 16 of your photos.
  $photos = idx($facebook->api('/me/photos?limit=16'), 'data', array());

  // Here is an example of a FQL call that fetches all of your friends that are
  // using this app
  $app_using_friends = $facebook->api(array(
    'method' => 'fql.query',
    'query' => 'SELECT uid, name FROM user WHERE uid IN(SELECT uid2 FROM friend WHERE uid1 = me()) AND is_app_user = 1'
  ));
}

// Fetch the basic info of the app that they are using
$app_info = $facebook->api('/'. AppInfo::appID());

$app_name = idx($app_info, 'name', '');

?>
<!DOCTYPE html>
<html xmlns:fb="http://ogp.me/ns/fb#" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0, user-scalable=yes" />

    <!--<title><?php echo he($app_name); ?></title>-->
    <link href='http://fonts.googleapis.com/css?family=Didact+Gothic' rel='stylesheet' type='text/css'>
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

    <script type="text/javascript" src="/javascript/jquery-1.7.1.min.js"></script>
    <script src="javascript/bootstrap.min.js"></script>

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
          $.ajax({url:pageurl+'?rel=tab',success: function(data){
            $('#main').html(data);
          }});

          //change browser URL to given link location
          if(pageurl!=window.location){
            window.history.pushState({path:pageurl},'',pageurl);
          }

          //stop refreshing to page   
          return false;
        });
      });

      //override back button to get ajax content
      $(window).bind('popstate', function(){
        $.ajax({url:location.pathname+'?rel=tab',success: function(data){
          $('#main').html(data);
        }});
      });                          
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

  <body>
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

    <?php
    #foreach ($basic as $value){
    #  echo $value;
    #  echo "<br/>";
    #}

    # This function reads your DATABASE_URL configuration automatically set by Heroku
    # the return value is a string that will work with pg_connect
    function pg_connection_string() {
      return "dbname=daanlenp3al7n5 host=ec2-54-243-230-216.compute-1.amazonaws.com port=5432 user=cjykxetwjrzkrk password=jQ-kNfCjoVqqGbZi0NeM7GzurA sslmode=require";
    }
    # Establish db connection
    $db = pg_connect(pg_connection_string());

    $sqlcommand = "SELECT * FROM users";
    $result = pg_query($db, $sqlcommand);
    if (!$result) {
      die("Error in SQL query: " . pg_last_error());
    }

    // iterate over result set
    // print each row
    /*while ($row = pg_fetch_array($result)) {
       echo "FBID: " . $row[0] . "<br />";
       echo "email: " . $row[1] . "<p />";
    }

    // free memory
    pg_free_result($result);*/      

    // close connection
    pg_close($db);

    ?>

    <!-- NAV BAR ONLY IF LOGGED IN -->
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container" style="padding-left:5%;padding-right:5%;width:auto;">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="/">get a room</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li><a href="matches.php" rel="tab">matches</a></li>
              <li><a href="survey.php" rel="tab">view/edit profile</a></li>
              <li><a href="about.html" rel="tab">about</a></li>
              <li><a href="faq.html" rel="tab">faq</a></li>
            </ul>


            <ul class="nav pull-right" style="width:15%;">
              <?php $pictureurl = 'http://graph.facebook.com/' . $basic['id'] . '/picture';?>
              <img src="<? echo $pictureurl; ?>" width="35" height="35">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $basic['name'];?><b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Profile</a></li>
                  <li><a href="#">Logout</a></li>
                </ul>
              </li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <!-- IF USER IS NOT LOGGED IN SHOW LOGIN PAGE -->
    <?php } else { ?>
    <div>
      <!-- added -->
      <div id="logincontainer">
        <div id="loginbox">
          <h1 id="aTitle">get some room.</h1>
          <br>
          <h2 id="caption">find an awesome internship but need roommates?</h2>
          <p id="tagline">Enter to find your best roommate matches.</p>
          <!-- AddThis Button BEGIN -->
          <div id="login-flow" style="padding-left:30px;">
            <!-- <fb:login-button size="xlarge" perms="email,offline_access" show-faces="false" onlogin="Log.info('onlogin callback')" style="font-family:'Franklin Gothic Medium' background-color:#00009C;">
              Sign Up With Facebook</fb:login-button> -->
              <div class="fb-login-button" data-scope="user_likes,user_photos"></div>
              <!--<a href="#" onclick="oauth_login_url;"><img src="images/facebooklogin.jpg" border="0" alt=""></a> -->
          </div>
          <div class="addthis_toolbox addthis_default_style " style="margin:0 auto;margin-top:20px;width:155px;">
            <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
            <a class="addthis_button_tweet" style="width:69px;"></a>
          </div>
          <script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
          <script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-50552bd1589c29ce"></script>
          <!-- AddThis Button END -->
        </div>
      </div>
    </div>
    <?php } ?>

    <!--USER ID EXISTS -->

    <?php
      if ($user_id) {
    ?>


    <div id="main">
      <section id="samples" class="clearfix">
        <h1>Time for you to getsomeroom, <?php echo $basic['name'];?></h1>

        <div class="list">
          <h3>A few of your friends</h3>
          <ul class="friends">
            <?php
              foreach ($friends as $friend) {
                // Extract the pieces of info we need from the requests above
                $id = idx($friend, 'id');
                $name = idx($friend, 'name');
            ?>
            <li>
              <a href="https://www.facebook.com/<?php echo he($id); ?>" target="_top">
                <img src="https://graph.facebook.com/<?php echo he($id) ?>/picture?type=square" alt="<?php echo he($name); ?>">
                <?php echo he($name); ?>
              </a>
            </li>
            <?php
              }
            ?>
          </ul>
        </div>

        <div class="list inline">
          <h3>Recent photos</h3>
          <ul class="photos">
            <?php
              $i = 0;
              foreach ($photos as $photo) {
                // Extract the pieces of info we need from the requests above
                $id = idx($photo, 'id');
                $picture = idx($photo, 'picture');
                $link = idx($photo, 'link');

                $class = ($i++ % 4 === 0) ? 'first-column' : '';
            ?>
            <li style="background-image: url(<?php echo he($picture); ?>);" class="<?php echo $class; ?>">
              <a href="<?php echo he($link); ?>" target="_top"></a>
            </li>
            <?php
              }
            ?>
          </ul>
        </div>

        <div class="list">
          <h3>Things you like</h3>
          <ul class="things">
            <?php
              foreach ($likes as $like) {
                // Extract the pieces of info we need from the requests above
                $id = idx($like, 'id');
                $item = idx($like, 'name');

                // This display's the object that the user liked as a link to
                // that object's page.
            ?>
            <li>
              <a href="https://www.facebook.com/<?php echo he($id); ?>" target="_top">
                <img src="https://graph.facebook.com/<?php echo he($id) ?>/picture?type=square" alt="<?php echo he($item); ?>">
                <?php echo he($item); ?>
              </a>
            </li>
            <?php
              }
            ?>
          </ul>
        </div>

        <div class="list">
          <h3>Friends using this app</h3>
          <ul class="friends">
            <?php
              foreach ($app_using_friends as $auf) {
                // Extract the pieces of info we need from the requests above
                $id = idx($auf, 'uid');
                $name = idx($auf, 'name');
            ?>
            <li>
              <a href="https://www.facebook.com/<?php echo he($id); ?>" target="_top">
                <img src="https://graph.facebook.com/<?php echo he($id) ?>/picture?type=square" alt="<?php echo he($name); ?>">
                <?php echo he($name); ?>
              </a>
            </li>
            <?php
              }
            ?>
          </ul>
        </div>
      </section>
    </div>

    <?php
      }
    ?>

    <!--
    <section id="guides" class="clearfix">
      <h1>Learn More About Heroku &amp; Facebook Apps</h1>
      <ul>
        <li>
          <a href="https://www.heroku.com/?utm_source=facebook&utm_medium=app&utm_campaign=fb_integration" target="_top" class="icon heroku">Heroku</a>
          <p>Learn more about <a href="https://www.heroku.com/?utm_source=facebook&utm_medium=app&utm_campaign=fb_integration" target="_top">Heroku</a>, or read developer docs in the Heroku <a href="https://devcenter.heroku.com/" target="_top">Dev Center</a>.</p>
        </li>
        <li>
          <a href="https://developers.facebook.com/docs/guides/web/" target="_top" class="icon websites">Websites</a>
          <p>
            Drive growth and engagement on your site with
            Facebook Login and Social Plugins.
          </p>
        </li>
        <li>
          <a href="https://developers.facebook.com/docs/guides/mobile/" target="_top" class="icon mobile-apps">Mobile Apps</a>
          <p>
            Integrate with our core experience by building apps
            that operate within Facebook.
          </p>
        </li>
        <li>
          <a href="https://developers.facebook.com/docs/guides/canvas/" target="_top" class="icon apps-on-facebook">Apps on Facebook</a>
          <p>Let users find and connect to their friends in mobile apps and games.</p>
        </li>
      </ul>
    </section>-->
  </body>
</html>
