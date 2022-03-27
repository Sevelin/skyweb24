<?php

namespace App\Tasks;
    
class ConvertInArrayTask
{
    /**
    * Преобразоываем строку в массив
    */
    public static function run($array)
    {
        if(count($array) < 1) return $array;
        
        $tmp_array = explode(',', $array[0]['booked_day']);
        $final_array = [];
        
        
        foreach($tmp_array as $item)
        {
            array_push($final_array, (int) $item);
        }
        
        return $final_array;
    }
}