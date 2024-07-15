<?php
$db = new mysqli("localhost", "root", "", "livekodam");

// Cek koneksi
if ($db->connect_error) {
    die("Koneksi gagal: " . $db->connect_error);
}

?>