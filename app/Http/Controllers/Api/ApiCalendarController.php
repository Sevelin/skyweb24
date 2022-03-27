<?php

namespace App\Http\Controllers\Api;

use App\Models\Calendar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\CalendarRepository;
use App\Tasks\ConvertInArrayTask;
use App\Tasks\ConvertInStrTask;
use App\Tasks\UpdateBookedTask;

class ApiCalendarController extends Controller
{
    
    /**
    * Данный контроллел работает с таблицей Calendar
    * Получает и обновляет данные о зарезервированных днях
    */
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        return 'INDEX';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
//        return 'CREATE';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        return 'STORE';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Api\ApiCalendar  $apiCalendar
     * @return \Illuminate\Http\Response
     */
    public function show(Calendar $apiCalendar, $month)
    {
        $getCalendar = new CalendarRepository();
        
        $bookedDay = $getCalendar -> getDay($month) -> toArray();
        
        // Преобразовываем строку в массиы
        $result = ConvertInArrayTask::run($bookedDay);
        
        return $result; 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Api\ApiCalendar  $apiCalendar
     * @return \Illuminate\Http\Response
     */
    public function edit(Calendar $apiCalendar)
    {
//        return 'EDIT';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Api\ApiCalendar  $apiCalendar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Calendar $apiCalendar, $month)
    {
        // Преобразовываем массив в строку
        $str = ConvertInStrTask::run($request -> booked_day);
        
        $update = new UpdateBookedTask();
        
        $result = $update -> update($month, $str);
        
        if($result){
            return true;
        }else{
            return false;
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Api\ApiCalendar  $apiCalendar
     * @return \Illuminate\Http\Response
     */
    public function destroy(ApiCalendar $apiCalendar)
    {
//        return 'DESTROY';
    }
}
