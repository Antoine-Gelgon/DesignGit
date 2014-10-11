<?php

  # This is an heretic way to show repo tree,
  # it needs to be properly rewritten.
  # Note about image display : Computer can going very slow with a
  # huge amount of HD images. The temporary solution has to display only
  # images under 2.5mo but it would be better to use a thumbnailer.

  # Level 1
  echo '<div class="tree">';
    echo '<h1>Tree</h1>';

    $fileInfos = $client->api('repo')->contents()->show($repoOwner, $repoName);
    $filePath = array();
    $fileCommit = $client->api('repo')->commits()->all($repoOwner, $repoName, array('sha' => 'master', 'path' => $filePath));

    function fileUrl($client, $repoOwner, $repoName, $filePath, $fileName, $fileDate){

      echo '<a class="indent" href="https://raw.githubusercontent.com/' .$repoOwner. '/' .$repoName. '/master/' .$filePath. '">' .$fileName. ' <sup class="date">' .$fileDate. '</sup></a>';
    }

    function fileImage($repoOwner, $repoName, $filePath, $fileSize){
      $image = 'https://raw.githubusercontent.com/' .$repoOwner. '/' .$repoName. '/master/' .$filePath;
      if((preg_match("/\.(jpe?g|png|gif)$/i", $image)) && ($fileSize < 2600000)){
        echo '<img class="preview indent" src=" '.$image.' " />';
      } else {
        echo '<p class="indent error">No preview availaible.</p>';
      }
    }

    function fileDiff($client, $repoOwner, $repoName, $filePath, $fileName){
      $fileCommits = $client->api('repo')->commits()->all($repoOwner, $repoName, array('sha' => 'master', 'path' => $filePath));
      if (count($fileCommits) > 1) {
        echo '<div class="diff indent">';
          echo '<span> See older versions for this file: </span>';
          echo '<form method="post"  action="templates/redirect.php"><select name="oldVersions">';
            foreach ($fileCommits as $fileCommit){
              $link = 'https://raw.githubusercontent.com/' .$repoOwner. '/' .$repoName. '/' .$fileCommit['sha']. '/' .$filePath;
              echo '<option value="' .$link. '">' .$fileName. ' &rarr; ' .$fileCommit['commit']['author']['date']. '</OPTION>';
            }
          echo '</select><input type="submit" value="See file" title="See file" /></form>';
        echo '</div>';
      } else {
        echo 'No older version available.';
      }
    }

    foreach ($fileInfos as $fileInfo){
      if ($fileInfo['type'] == 'file') {
        echo '<div class="file">';
          fileUrl($client, $repoOwner, $repoName, $fileInfo['path'], $fileInfo['name'], $fileCommit[1]['commit']['author']['date']);
          fileImage($repoOwner, $repoName, $fileInfo['path'], $fileInfo['size']);
          fileDiff($client, $repoOwner, $repoName, $fileInfo['path'],$fileInfo['name']);

        echo '</div>';
      }  else {

        # Level 2
        echo '<p class="dirName">' .$fileInfo['name']. '</p>';
        echo '<div class="dir">';

          $dirInfos = $client->api('repo')->contents()->show($repoOwner, $repoName, $fileInfo['path']);

          foreach ($dirInfos as $dirInfo) {
            if ($dirInfo['type'] == 'file') {
              echo '<div class="file">';
                fileUrl($client, $repoOwner, $repoName, $dirInfo['path'], $dirInfo['name'], $fileCommit[1]['commit']['author']['date']);
                fileImage($repoOwner, $repoName, $dirInfo['path'], $dirInfo['size']);
                fileDiff($client, $repoOwner, $repoName,  $dirInfo['path'],$dirInfo['name']);


              echo '</div>';
            } else {

              # Level 3
              echo '<p class="dirName indent">' .$dirInfo['name']. '</p>';
              echo '<div class="dir indent">';

                $dirInfos2 = $client->api('repo')->contents()->show($repoOwner, $repoName, $dirInfo['path']);

                foreach ($dirInfos2 as $dirInfo2){
                  if ($dirInfo2['type'] == 'file') {
                    echo '<div class="file">';
                      fileUrl($client, $repoOwner, $repoName, $dirInfo2['path'], $dirInfo2['name'], $fileCommit[1]['commit']['author']['date']);
                      fileImage($repoOwner, $repoName, $dirInfo2['path'], $dirInfo2['size']);
                      fileDiff($client, $repoOwner, $repoName,  $dirInfo2['path'],$dirInfo2['name']);


                    echo '</div>';
                  } else {

                    # Level 4
                    echo '<p class="dirName indent">' .$dirInfo2['name']. '</p>';
                    echo '<div class="dir indent">';

                      $dirInfos3 = $client->api('repo')->contents()->show($repoOwner, $repoName, $dirInfo2['path']);

                      foreach($dirInfos3 as $dirInfo3){
                        echo '<div class="file">';
                          fileUrl($client, $repoOwner, $repoName, $dirInfo3['path'], $dirInfo3['name'], $fileCommit[1]['commit']['author']['date']);
                          fileImage($repoOwner, $repoName, $dirInfo3['path'], $dirInfo3['size']);
                          fileDiff($client, $repoOwner, $repoName,  $dirInfo3['path'],$dirInfo3['name']);


                        echo '</div>';
                      }
                    echo '</div>';
                    # /Level 4

                  }
                }
              echo '</div>';
              # /Level 3

            }
          }
        echo '</div>';
        # /Level 2

      }
    }
  echo '</div>';
  # /Level 1

?>
