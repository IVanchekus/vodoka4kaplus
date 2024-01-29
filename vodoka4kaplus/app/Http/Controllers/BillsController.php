<?php

namespace App\Http\Controllers;

use App\Bill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillsController extends Controller
{
    public function show($id){
        $bills = Bill::where('resident_id', $id)->join('periods', 'bills.period_id', '=','periods.id')
            ->select('begin_date', 'amount_rub')->get();
        return $bills;
    }
}
