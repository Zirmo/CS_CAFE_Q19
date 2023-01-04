<?php

$scandir = scandir("C:\Users\GORAE\Documents\phpAubry\CS_CAFE_19\CS_CAFE_2_15\src\Utilitaire",1);

$date=date("Y-m-d");
foreach($scandir as $file){
    if (pathinfo($file,PATHINFO_EXTENSION) == 'log' ){
        if ( pathinfo($file, PATHINFO_FILENAME) == $date){
            echo pathinfo($file, PATHINFO_FILENAME);
        };
    }
}
