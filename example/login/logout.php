<?php

// Jangan lupa session harus di start dulu
session_start();

// Melakukan penghapusan kredensi user di session
if (isset($_SESSION['user']))
    unset($_SESSION['user']);

// Lalu pindah ke halaman localhost/nama-folder-mu/home.php
header('Location: ./home.php');
