<?php

$raw_password = 'pass';
echo password_hash($raw_password, PASSWORD_DEFAULT, ['cost' => 12] , '/n');