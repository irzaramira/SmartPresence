<?php

namespace App\Http\Controllers;

use App\Classes;
use App\Pertemuan;
use Carbon\Carbon;
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
            'timestart' => 'required',
            'timeend' => 'required'
            ]);
            
            DB::table('pertemuans')->insert([
                'classes_id' => $class_id,
                'name'=> $request->pertemuanname,
                'date_start'=> $request->timestart,
                'date_end'=> $request->timeend,
                'created_at'=> Carbon::now('Asia/Jakarta')
            ]);
            
        return redirect('/class/'.$class_id);
    }

    public function viewEditPertemuan($class_id, $pertemuan_id){
        $class = Classes::where('id', $class_id)->first();
        $pertemuan = Pertemuan::where('id', $pertemuan_id)->first();
        return view ('editPertemuan')->with('class', $class)->with('pertemuan', $pertemuan);
    }

    public function editPertemuan(Request $request, $class_id, $pertemuan_id){
        $request->validate([
            'pertemuanname' => 'required',
            'timestart' => 'required',
            'timeend' => 'required'
            ]);
            
            DB::table('pertemuans')->where('id', $pertemuan_id)->update([
                'name'=> $request->pertemuanname,
                'date_start'=> $request->timestart,
                'date_end'=> $request->timeend,
                'updated_at'=> Carbon::now('Asia/Jakarta')
            ]);
        
        return redirect('/class/'.$class_id);
    }

    public function deletePertemuan($class_id, $pertemuan_id){
        DB::table('absens')->where('pertemuan_id', $pertemuan_id)->delete();
        DB::table('pertemuans')->where('id', $pertemuan_id)->delete();

        return redirect('/class/'.$class_id);
    }

}
