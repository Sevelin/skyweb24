<?php

namespace App\Tasks;

use App\Models\Calendar;

class UpdateBookedTask
{
    /**
    * Обновляем зарезервированные дни в БД
    */
    public function update($month, $days)
    {   
        $result = Calendar::where('month', $month)
            -> update(['booked_day' => $days]);
        
        return $result;
    }
}
