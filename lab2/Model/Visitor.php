<?php 
class Visitor{
    public static function isCounted(){
        session_start();
        if(!isset($_SESSION['is_counted'])){
            $_SESSION['is_counted'] = true;
            return false;
        }
        return true;
    }
}