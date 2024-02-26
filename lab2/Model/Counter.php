<?php
class Counter{
    private $counterFile;
    public function __construct($counterFile){
        $this->counterFile=$counterFile;
    }

    public function getVisitCount(){
        if(file_exists($this->counterFile)){
            return intval(file_get_contents($this->counterFile));
        }else{
            return 0;
        }
    }

    public function incrementVisitsCount(){
        $count = $this->getVisitCount();
        file_put_contents($this->counterFile, ++$count);
    }
}
