<?php

namespace App\Repositories;
    
use App\Models\Calendar;
    
class CalendarRepository extends BaseRepository
{
    
    protected function getModelClass()
    {
        return Calendar::class;
    }
    
    /**
    * Получаем список занятых дней
    */
    public function getDay($month)
    {
        $columns = [
            'booked_day'
        ];
        
        $result = $this -> startQuery()
                    -> select($columns)
                    -> where('month', $month)
                    -> get();
        
        return $result;
    }
    
}