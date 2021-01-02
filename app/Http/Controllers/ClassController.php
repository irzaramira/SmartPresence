<?php

namespace App\Http\Controllers;

use App\Absen;
use App\Classes;
use App\Pertemuan;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClassController extends Controller
{
    public function view($class_id)
    {
        $class = Classes::where('id', $class_id)->first();
        $pertemuan = Pertemuan::where('classes_id', $class_id)->get();
        $absens = [];
        foreach($pertemuan as $pert){ 
            $absen = Absen::where('pertemuan_id', $pert->id)->get();
            foreach($absen as $abs){
                $mhs = User::where('id', $abs->user_id)->first();
                array_push($absens, [
                    "pertemuan_id"=>$pert->id,
                    "nama"=>$mhs->name,
                    "nim"=>$mhs->username,
                    "waktu"=>$abs->date
                ]);
            }
        }
        return view('classes')->with('class', $class)->with('pertemuan', $pertemuan)->with('absens', $absens);
    }

    public function viewAddClass(){
        return view('addClass');
    }

    public function addClass(Request $request){
        $dosen_id = Auth::user()->id;

        $request->validate([
            'classname' => 'required',
            'timedescclass' => 'required',
            'location' => 'location'
            ]);
            
            DB::table('classes')->insert([
                'dosen_id' => $dosen_id,
                'name'=> $request->classname,
                'timedesc'=> $request->timedescclass,
                'location' => $request->location
            ]);
            
            $class = Classes::where('dosen_id', $dosen_id)->get()->last();
            DB::table('userclasses')->insert([
                'user_id' => $dosen_id,
                'classes_id' => $class->id
            ]);
        return redirect('/');
    }

    public function viewEditClass($class_id){
        $class = Classes::where('id', $class_id)->first();
        return view ('editClass')->with('class', $class);
    }

    public function editClass(Request $request, $class_id){
        $request->validate([
            'classname' => 'required',
            'timedescclass' => 'required',
            'location' => 'required'
            ]);
            
            DB::table('classes')->where('id', $class_id)->update([
                'name'=> $request->classname,
                'timedesc'=> $request->timedescclass,
                'location'=> $request->location
            ]);
        
        return redirect('/class/'.$class_id);
    }
}
