<?php

session_start();
require_once('twitteroauth/twitteroauth.php');

define('CONSUMER_KEY', '1vuWFUZuGkQHy7RWYGQlYn4Fc');
define('CONSUMER_SECRET', 'j2FC0EczJpVrLUWeZHOF53O2SOPjNrvjA4Y0Unlo78jtgiF9io');
define('access_token', '986097542-78dT3BrMRtwIiav51EfVRjOqtyRz096medJxRkyd');
define('access_token_secret', 'ysODiEgPpJMqY2zITKPfdsHWx4exqq5d9iik6fzZYzWvr');

$jumlah = "1";
$type = "recent";

function randomline( $target )
{
    $lines = file( $target );
    return $lines[array_rand( $lines )];
}
$target = randomline('target.txt');
$koneksi = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, access_token, access_token_secret);
$nasi = $koneksi->get('search/tweets', array('q' => $target,  'count' => $jumlah, 'result_type' => $type));
$statuses = $nasi->statuses;
foreach($statuses as $status)
{
$username = $status->user->screen_name;
$eksekusi = $koneksi->post('friendships/create', array('screen_name' => $username));
if($eksekusi->errors) {
echo "<center>Gagal</center>";
}
else {
echo "<center>Berhasil. Follow $username </center>";
}
}
?>
