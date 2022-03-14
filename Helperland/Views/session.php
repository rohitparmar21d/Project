<?php
if(!isset($_SESSION))
{
    session_start();
}
if(isset($_SESSION['loggedin']))
{
    echo 1;
}
else
{
    echo 0;
}

?>