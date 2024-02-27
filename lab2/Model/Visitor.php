<?php 
class Visitor{
    public static function isCounted(){
        if(!isset($_SESSION['is_counted'])){
            $_SESSION['is_counted'] = true;
            return false;
        }
        return true;
    }
}