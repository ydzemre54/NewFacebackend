<?php
session_start();

require(__DIR__ . "/vendor/autoload.php");

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

require_once '../backend/controllers/ControllerUser.php';

$controller = new UserController();
$controller->logout();
