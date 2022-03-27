<?php

namespace App\Tasks;
    
class ConvertInStrTask
{
    /**
    * Преобразоываем массив в строку
    */
    public static function run($array)
    {
        if(count($array) < 1) return $array;
        
        $str_day = implode(',', $array);
        
        return $str_day;
    }
}