<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class CalendarTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reserved = [
            'month'         =>  '03.2022',
            'booked_day'    =>  '12, 18, 25',
            'created_at'    =>  now(),
            'updated_at'    =>  now(),
        ];
        
        \DB::table('calendars')->insert($reserved);
        
    }
}
