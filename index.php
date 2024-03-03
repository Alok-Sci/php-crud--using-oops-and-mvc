<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/the-kraftors/29feb2024--php-crud--using-oops-and-mvc/config.php';

require_once APP_PATH . '/controller/userController.php';
$user = new UserController();
$user->pageHandler();
