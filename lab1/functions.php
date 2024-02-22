<?php
    function store_submits($name,$email){
        $fp=fopen(submit_file, "a");
        if($fp){
            $input=date("F j Y g:i A")."?". $_SERVER['REMOTE_ADDR']."?"."$name ? $email".PHP_EOL;
            if(fwrite($fp,$input)){
                fclose($fp);
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    function display_submits(){
        $lines=file(submit_file);
        foreach($lines as $line){
            echo "<h3> new user details</h3>";
            $words=explode("?",$line);
            $i=0;
            foreach($words as $word){
                if($i==0){
                    echo "<h5>date: $word</h5>";
                }elseif($i==1){
                    echo "<h5>ip address: $word</h5>";
                }elseif($i==2){
                    echo "<h5>name: $word</h5>";
                }else{
                    echo "<h5>email: $word</h5>";
                }
                $i++;
            }
        }
    }

