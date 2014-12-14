<?php
ignore_user_abort();

# argv[1] sequence
# argv[2] email of user
# argv[3] file for result
# argv[4] directory num
# argv[5] sequence title


# Run scorpion and add it to the correct file for look up
$cmd =
    "pushd /var/www/cgi-bin/;" .
    "./c3scorpion BLAST/blastpgp " .
    "nr_database/ " . $argv[1] .
    " > " . $argv[3] .
    ";popd";
system($cmd);
# Add to new file to database then get ID
if (isset($argv[5]))
    $title = $argv[5];
else
    $title = "";

$id = store_result($argv[2], $argv[4], $title);
# Create link
$link = "http://scorpion.cs.odu.edu/result.php?id=" . $id;
$result = "Click here for result: " . $link;



?>
