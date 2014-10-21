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

    # Exclude specifics repos
    # print_r ($allRepos);    # Print the whole array and search for the specific key number
      unset($allRepos[0]);    # --8239-
      unset($allRepos[16]);   # Boxon

?>

  <div class="userRepos">

<?php

      foreach ($allRepos as $repo){

        $repoName = $repo['name'];
        $repoOwner = $repo['owner']['login'];
        $description = $repo['description'];
        $cloneUrl = $repo['clone_url'];

        echo '<div class="repo">';
          echo '<a class="title" href="repo.php?repoName=' .$repoName. '&repoOwner=' .$repoOwner. '"><span>' .$repoName. '</span></a>';
          echo ' <span>by ' .$repoOwner. '</span>';
          echo ' <div class="description">' .$description. '</div>';
          /*include ('readme.php');*/
          echo '<a class="download" href="https://github.com/' .$repoOwner. '/' .$repoName. '/archive/master.zip">Download</a>';
          echo '<a class="cloneUrl" href="' .$cloneUrl. '">Clone url</a>';
        echo '</div>';
      }
    echo '</div>';
  }

  getRepos($client, 'Antoine-Gelgon', 'XavierKlein', 'baladurzgate', 'EtienneOz', 'ivangrozny', 'Boxon-');

?>
