<?php

namespace App\Http\Controllers;

use App\Resident;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResidentsController extends Controller
{   
    public function main(){
        $residents = new Resident();
        return view('residents', ['residents' => $residents->all()]);
    }

    public function index(){
        return Resident::all();
    }

    public function show($id){
        $resident = Resident::where('id', $id)->first();
        return $resident;
    }

    public function update(Request $request){
        $resident = DB::table('residents')->where('id', $request->id)->update([
            'fio' => $request->fio,
            'area' => $request->area,
            'start_date' => $request->start_date
            ]);
        return $request;
    }

    public function create(){
        request()->validate([
            'fio' => 'required',
            'area' => 'required|numeric',
            'start_date' => 'required'
        ]);

        $resident = Resident::create([
            'fio' => request('fio'),
            'area' => request('area'),
            'start_date' => request('start_date')
        ]);

        return $resident;
    }

    public function destroy($id){
        try{
            Resident::where('id', $id)->delete();
        }
        catch (Exception $ex){
            return false;
        }
        return true; 
    }
}
