<?php

  $repos = $client->api('user')->repositories($repoOwner);

  echo '<div class="userRepos">';
    echo '<h1>Other repositories by '.$repoOwner.':</h1>';
    foreach ($repos as $repo) {
      echo '<div class="repo">';
        echo '<a href="repo.php?repoName=' .$repo['name']. '&repoOwner=' .$repoOwner. '">' .$repo['name'].'</a>';
      echo '</div>';
    }
  echo '</div>';


?>
