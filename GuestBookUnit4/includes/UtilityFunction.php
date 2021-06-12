<?php


abstract class UtilityFunction
{
    abstract function getHeader();
    abstract function getTopNav();
    function getFooter(){
        return "<footer>Copyright 2021 Guestbook is Bestbook</footer>";
    }

    function isAllowed() {
        if (!isset($_SESSION['userName'])){
            header("location: login.php");
        }
    }
}