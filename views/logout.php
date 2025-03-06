<?php

require_once '../includes/session.php';
;

session_destroy();

header("location: ../views/index.php");
exit;