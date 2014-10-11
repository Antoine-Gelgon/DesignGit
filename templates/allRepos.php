<?php

  function getRepos ($client, $repoOwner, $repoOwner2, $repoOwner3, $repoOwner4, $repoOwner5, $repoOwner6){

    $repos = $client->api('user')->repositories($repoOwner);
    $repos2 = $client->api('user')->repositories($repoOwner2);
    $repos3 = $client->api('user')->repositories($repoOwner3);
    $repos4 = $client->api('user')->repositories($repoOwner4);
    $repos5 = $client->api('user')->repositories($repoOwner5);
    $repos6 = $client->api('user')->repositories($repoOwner6);
    $allRepos = array_merge($repos, $repos2, $repos3, $repos4, $repos5, $repos6);

    function sort_by_name(&$arr, $col, $dir = SORT_ASC) {
      $sort_col = array();
      foreach ($arr as $key=> $row) {
        $sort_col[$key] = $row[$col];
      }
      array_multisort($sort_col, $dir, $arr);
    }

    sort_by_name($allRepos, 'name');

    echo '<div class="userRepos">';
      foreach ($allRepos as $repo){

        $name = $repo['name'];
        $owner = $repo['owner']['login'];
        $description = $repo['description'];
        $cloneUrl = $repo['clone_url'];

        echo '<div class="repo">';
          echo '<a href="repo.php?repoName=' .$name. '&repoOwner=' .$owner. '">' .$name. '</a>';
          echo ' by ' .$owner;
          echo '<div class="description">' .$description. '</div>';
          echo '<a class="download" href="https://github.com/' .$owner. '/' .$name. '/archive/master.zip">Download</a>';
          echo '<div class="cloneUrl">Clone url: ' .$cloneUrl. '</div>';
        echo '</div><br/>';
      }
    echo '</div>';
  }

  getRepos($client, 'Antoine-Gelgon', 'XavierKlein', 'baladurzgate', 'EtienneOz', 'ivangrozny', 'Boxon-');

?>
