<?php
session_start();
mysql_connect("localhost","root","")or die(mysql_error());
mysql_select_db("appo");

function protect($str)
{
    return mysql_real_escape_string(strip_tags($str));
}

?>