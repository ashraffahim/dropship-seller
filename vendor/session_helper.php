<?php

session_set_cookie_params(0, '/', $_SERVER['HTTP_HOST'], false, true);
ini_set('session.cookie_lifetime', 31536000);

session_start();

?>