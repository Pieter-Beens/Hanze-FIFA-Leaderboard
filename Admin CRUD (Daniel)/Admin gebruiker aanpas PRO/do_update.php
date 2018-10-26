<?php
/**
 * Created by PhpStorm.
 * User: johan
 * Date: 25/10/2018
 * Time: 18:03
 */

require_once __DIR__ . '/functions.php';

doUpdate($_POST['id'], $_POST);
// Altijd redirecten na een POST, omdat met een reload er anders de update wordt herhaald
header("Location: /");