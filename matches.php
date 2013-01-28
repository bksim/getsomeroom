<?php


// Provides access to app specific values such as your app id and app secret.
// Defined in 'AppInfo.php'
require('AppInfo.php');
// This provides access to helper functions defined in 'utils.php'
require('utils.php');

// Enforce https on production
if (substr(AppInfo::getUrl(), 0, 8) != 'https://' && $_SERVER['REMOTE_ADDR'] != '127.0.0.1') {
  header('Location: https://'. $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
  exit();
}

/*****************************************************************************
 *
 * The content below provides examples of how to fetch Facebook data using the
 * Graph API and FQL.  It uses the helper functions defined in 'utils.php' to
 * do so.  You should change this section so that it prepares all of the
 * information that you want to display to the user.
 *
 ****************************************************************************/

require('sdk/src/facebook.php');

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

<section id="samples" class="clearfix">
  <div id="matches">
    bla bla bla stuff here
      <script> 
      // GET STUFF FROM FACEBOOK, MAKE AJAX CALL TO DATABASE
      FB.api('/me', function(response) {
        $.post(
          "database_connect.php",
          { "name": response.name, "id": response.id},
          function(data){
            if (!data){
              //if data is not null
              document.write(data);
            }
          }
        );
      });
    </script>
  </div>
</section>
