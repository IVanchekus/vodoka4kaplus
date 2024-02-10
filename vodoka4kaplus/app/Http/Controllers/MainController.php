<?php

namespace App\Http\Controllers;

use App\Bill;
use App\MonthCosts;
use App\PumpMeterRecord;
use App\Resident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function index(){
        return view('layout');
    }

    public function filter($id){
        $bills = Bill::join('periods', 'bills.period_id', '=','periods.id')
            ->join('residents', 'bills.resident_id', '=', 'residents.id')
            ->where('period_id', $id)
            ->select('fio', 'begin_date', 'amount_rub', 'period_id')
            ->orderby('period_id')
            ->get();
        return $bills;
    }

    public function filter_null(){
        $bills = Bill::join('periods', 'bills.period_id', '=','periods.id')
            ->join('residents', 'bills.resident_id', '=', 'residents.id')
            ->select('fio', 'begin_date', 'amount_rub', 'period_id')
            ->orderby('period_id')
            ->get();
        return $bills;
    }

    public function months_get(){
        return DB::table('periods')->get();
    }

    public function month_costs(){
        $monthcosts = new MonthCosts();
        //view('month_costs', ['message' => $request->get('message') ? $request->get('message') : false, 'monthcosts' => $monthcosts->orderby('month')->get()])
        return $monthcosts->orderby('month')->get();
    }

    public function month_costs_check(Request $request){
        $monthcosts = new MonthCosts();
        // $valid = $request->validate([
        //     'month' => 'required',
        //     'costs' => 'required|numeric'
        // ]);

        $month = $request->input('month');
        $costs = $request->input('costs');

        if (count(DB::table('month_costs')->where('month', 'LIKE', substr($month, 0, 7) . '%')->get()) > 0){
            DB::table('month_costs')->where('month', 'LIKE', substr($month, 0, 7) . '%')->update(['costs' => $costs]);
            return 0;
        }

        $monthcosts->month = $month;
        $monthcosts->costs = $costs;

        $monthcosts->save();

        return $monthcosts;
    }

    public function pump_meter_records(){
        $pump_meter_records = DB::table('pump_meter_records')
            ->join('periods', 'pump_meter_records.period_id', '=', 'periods.id')
            ->get();
            //view('pump_meter_records', ['message' => $request->get('message') ? $request->get('message') : false, 
           // 'pump_meter_records' => $pump_meter_records])
        return $pump_meter_records;
    }

    public function pump_meter_records_check(Request $request){
        // $valid = $request->validate([
        //     'month' => 'required',
        //     'amount' => 'required|numeric'
        // ]);

        $month = $request->input('month');
        $amount = $request->input('amount');

        if(count(DB::table('periods')->where('begin_date', 'LIKE', substr($month, 0, 7) . '%')->get()) === 0){
            DB::table('periods')->where('begin_date', 'LIKE', substr($month, 0, 7) . '%')
                                ->insert(['begin_date' => $month, 'end_date' => $month]);
        }

        $periods = DB::table('periods')->where('begin_date', 'LIKE', substr($month, 0, 7) . '%')->get();

        if(count(DB::table('pump_meter_records')->where('period_id', '=', $periods[0]->id)->get()) > 0){
            return 0;
        }

        DB::table('pump_meter_records')->insert(['period_id' => $periods[0]->id, 'amount_volume' => $amount]);
        $pmr = DB::table('pump_meter_records')
            ->join('periods', 'pump_meter_records.period_id', '=', 'periods.id')
            ->where('period_id', '=', $periods[0]->id)
            ->get();

        // $pmr = new PumpMeterRecord();

        return $pmr;
    }

    public function countBills(Request $request){
        $period_id = $request->period_id;
        $periods_ordered = DB::table('periods')->oldest('begin_date')->select('id', 'begin_date')->get();
        $periods = DB::table('periods')->where('id', $period_id)->value('begin_date');
        //$periods_ordered[1]->begin_date
        //$pump_meter_records_per = DB::table('pump_meter_records')->where('period_id', $period_id)->value('amount_volume');

        $periods_diff = null;
        $last_period = null;
        $p_m_r_last = null;
        foreach($periods_ordered as $period){
            if (substr($period->begin_date, 0, 7) === substr($periods, 0, 7)){
                if ($last_period !== null){
                    $p_m_r_last = DB::table('pump_meter_records')->where('period_id', $last_period->id)->value('amount_volume');
                }
                $p_m_r_now = DB::table('pump_meter_records')->where('period_id', $period->id)->value('amount_volume');

                if($p_m_r_last !== null){
                    $periods_diff = $p_m_r_now - $p_m_r_last;
                    break;
                }
                $periods_diff = $p_m_r_now;
            }
            $last_period = $period;
        }

        $residents_area_sum = DB::table('residents')->sum('area');
        $month_costs = DB::table('month_costs')->where('month', 'LIKE', substr($periods, 0, 7) . '%')->value('costs');

        $bill = null;
        foreach(DB::table('residents')->get() as $resident){
            if (substr($resident->start_date, 0, 7) <= substr($periods, 0, 7)){
                $amount_rub = round($periods_diff * $resident->area / $residents_area_sum * $month_costs, 2);
                $bill = Bill::updateOrCreate(['period_id' => $period_id, 'resident_id' => $resident->id], [
                    'amount_rub' => $amount_rub
                ]);
            }
        }
        //return $pump_meter_records_per . ' - ' . substr($periods_ordered, 0, 7) . ' - ' . $month_costs . ' - ' . $residents_area_sum;
        if ($bill !== null)
        {
            return $bill
            ->join('periods', 'bills.period_id', '=', 'periods.id')
            ->join('residents', 'bills.resident_id', '=', 'residents.id')
            ->get()[0];
        }
        return 0;
    }
}
