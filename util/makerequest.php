<?php 

$directory = 0;
$handle = opendir('/var/www/html/storage');
while (false !== ($entry = readdir($handle))) {
    if ($entry === ".."
        || $entry === "."
        || $entry === ".svn")
        continue;
    if (strval($entry) >= $directory)
        $directory = strval($entry);
}
closedir($handle);

$directory = strval($directory + 1);
$sequence = "storage/" . $directory . "/2fft.fasta"; // this is pushd so its relative
$dir_num = $directory;
$directory = "/var/www/html/storage/" . $directory;
system("mkdir " . $directory);

$result = $directory . "/result";

$write_seq = fopen($sequence, "w");
fwrite($write_seq, $_POST['seq']);
fwrite($write_seq, "\n");
fclose($write_seq);

# TIME FOR THE MIRACLE!
ignore_user_abort();
$cmd = "bash -c \"exec /usr/bin/php -f /var/www/cgi-bin/sting_exec.php " .
    $sequence . " " . $_POST['email'] .
    " " . $result . " " . $dir_num . "

?>
