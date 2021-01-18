<?php

namespace App\Http\Controllers;

use App\Absen;
use App\Classes;
use App\Pertemuan;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\File; 
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
        $statuses = [];
        $user_id = Auth::user()->id;

        foreach($pertemuan as $pert){ 
            $absen = Absen::where('pertemuan_id', $pert->id)->get();
            $exist = Absen::where('user_id', $user_id)->where('pertemuan_id', $pert->id)->first();

            if($exist != NULL){
                array_push($statuses, [
                    "status"=>'1',
                    "pertemuan_id"=>$pert->id
                ]);
            }else{
                array_push($statuses, [
                    "status"=>'2',
                    "pertemuan_id"=>$pert->id
                ]);
            }

            foreach($absen as $abs){
                $mhs = User::where('id', $abs->user_id)->first();
                array_push($absens, [
                    "id"=>$abs->id,
                    "pertemuan_id"=>$pert->id,
                    "ava"=>$mhs->image,
                    "nama"=>$mhs->name,
                    "nim"=>$mhs->username,
                    "waktu"=>$abs->date,
                ]);
            }
        }

        return view('classes')->with('class', $class)->with('pertemuan', $pertemuan)->with('absens', $absens)->with('statuses', $statuses);
    }

    public function viewAddClass(){
        return view('addClass');
    }

    public function addClass(Request $request){
        $dosen_id = Auth::user()->id;

        $request->validate([
            'classname' => 'required',
            'classimage' => 'mimes:jpg,jpeg,png',
            'timedescclass' => 'required',
            'location' => 'required'
            ]);
            
            
            if($request->hasFile('classimage')){
                $file = $request->file('classimage');
                $file->move('img/class_image/', $request->classimage->getClientOriginalName());

                DB::table('classes')->insert([
                    'dosen_id' => $dosen_id,
                    'name'=> $request->classname,
                    'image'=> $request->classimage->getClientOriginalName(),
                    'timedesc'=> $request->timedescclass,
                    'location' => $request->location,
                    'created_at' => Carbon::now('Asia/Jakarta')
                ]);
            }else{
                DB::table('classes')->insert([
                    'dosen_id' => $dosen_id,
                    'name'=> $request->classname,
                    'image'=> 'empty',
                    'timedesc'=> $request->timedescclass,
                    'location' => $request->location,
                    'created_at' => Carbon::now('Asia/Jakarta')
                ]);
            }
            
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
        $class = Classes::where('id', $class_id)->first();
        
        $request->validate([
            'classname' => 'required',
            'classimage' => 'mimes:jpg,jpeg,png',
            'timedescclass' => 'required',
            'location' => 'required'
            ]);
            
            if($request->hasFile('classimage')){
                $path = 'img/class_image/';
                File::delete($path.$class->image);

                $file = $request->file('classimage');
                $file->move('img/class_image/', $request->classimage->getClientOriginalName());

                DB::table('classes')->where('id', $class_id)->update([
                    'name'=> $request->classname,
                    'image'=> $request->classimage->getClientOriginalName(),
                    'timedesc'=> $request->timedescclass,
                    'location' => $request->location,
                    'updated_at' => Carbon::now('Asia/Jakarta')
                ]);
            }else{
                DB::table('classes')->where('id', $class_id)->update([
                    'name'=> $request->classname,
                    'image'=> 'empty',
                    'timedesc'=> $request->timedescclass,
                    'location' => $request->location,
                    'updated_at' => Carbon::now('Asia/Jakarta')
                ]);
            }
        
        return redirect('/class/'.$class_id);
    }

    public function deleteClass($class_id){
        $pertemuan = Pertemuan::where('classes_id', $class_id)->get();
        $class = Classes::where('id', $class_id)->first();
        $path = 'img/class_image/';

        foreach($pertemuan as $pert){
            DB::table('absens')->where('pertemuan_id', $pert->id)->delete();
        }

        File::delete($path.$class->image);
        DB::table('pertemuans')->where('classes_id', $class_id)->delete();
        DB::table('userclasses')->where('classes_id', $class_id)->delete();
        DB::table('classes')->where('id', $class_id)->delete();
        
        return redirect('/');
    }
}
