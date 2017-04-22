<?php
unset($_COOKIE['u_log']);
setcookie('u_log', null, -1, '/');
unset($_COOKIE['u_pass']);
setcookie('u_pass', null, -1, '/');
unset($_COOKIE['u_access']);
setcookie('u_access', null, -1, '/');

header("Location: {$_SERVER['HTTP_REFERER']}");
exit;
?>