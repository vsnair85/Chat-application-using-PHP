<?php
/**
* Boomchat
*
* @package Boomchat
* @author www.myboomchat.com
* @copyright 2015
* @terms any use of this script without a legal license is prohibited
* all the content of Boomchat is the propriety of BoomCoding and Cannot be 
* used for another project.
*/
require_once("system/config.php");

$post_time = date("H:i", $time);
//
// Logged in checker
setcookie("username","",time() - (1000 * 1000));
setcookie("password","",time() - (1000 * 1000));
?>