<?php

session_start();
require_once('twitteroauth/twitteroauth.php');

define('CONSUMER_KEY', 'GANTI CONSUMER KEY LOE');
define('CONSUMER_SECRET', 'GANTI CONSUMER SECRET LOE');
define('access_token', 'GANTI ACCESS TOKEN LOE');
define('access_token_secret', 'GANTI ACCESS TOKEN SECRET LOE');

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
