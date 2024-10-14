<?php
    session_start();
    //Menghapus sessions
    session_destroy();
    unset($_SESSION);

    //redirect ke halaman login
    header("Location: index.php");