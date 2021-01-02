<?php

namespace App\Http\Controllers;

use App\Classes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PertemuanController extends Controller
{
    public function viewAddPertemuan($class_id){
        $class = Classes::where('id', $class_id)->first();
        return view ('addPertemuan')->with('class', $class);
    }

    public function addPertemuan(Request $request, $class_id){

        $request->validate([
            'pertemuanname' => 'required',
            'date_start' => 'required',
            'date_end' => 'required'
            ]);
            
            DB::table('pertemuans')->insert([
                'classes_id' => $class_id,
                'name'=> $request->pertemuanname,
                'date_start'=> $request->timestart,
                'date_end'=> $request->timestart,
            ]);
            
        return redirect('classes')->with('class',$class_id);
    }

}
