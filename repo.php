<?php

  include ('index.php');

  if (isset($_GET["repoOwner"])) {
    $repoOwner = $_GET['repoOwner'];
  }
  if (isset($_GET["repoName"])) {
    $repoName = $_GET['repoName'];
  }

  $repo = $client->api('repo')->show($repoOwner, $repoName);

  $name = $repo['name'];
  $owner = $repo['owner']['login'];
  $ownerUrl = $repo['owner']['html_url'];
  $avatar = $repo['owner']['avatar_url'];
  $description = $repo['description'];
  $clone_url = $repo ['clone_url'];

  echo '<div class="repo">';
    echo '<h1>'.$name.' <sup><a class="download" href="https://github.com/' .$owner. '/' .$name. '/archive/master.zip">Download</a></sup></h1>';
    echo '<h2>by <a href="'.$ownerUrl.'">'.$owner.'</a></h2>';
    echo '<p>'.$description.'</p>';

    include ('templates/tree.php');
    include ('templates/readme.php');
    include ('templates/commits.php');
    include ('templates/issues.php');
    include ('templates/userRepo.php');
    echo '</div>';

?>
