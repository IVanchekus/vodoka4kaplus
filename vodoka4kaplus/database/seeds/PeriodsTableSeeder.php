<?php

use App\Resident;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeriodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i < 10; $i++){
            DB::table('pump_meter_records')->insert([
                'period_id' => $period_id = DB::table('periods')->insertGetId([
                    'begin_date' => "2024-$i-1",
                    'end_date' => "2024-$i-29"
                ]),
                'amount_volume' => 1 * $i
            ]);

            DB::table('month_costs')->insert([
                'month' => "2024-$i-10",
                'costs' => random_int(1, 15)
            ]);

            DB::table('residents')->insert([
                'fio' => bin2hex(random_bytes(10)),
                'area' => random_int(1, 12),
                'start_date' => "2024-$i-29"
            ]);
        }
    }
}
