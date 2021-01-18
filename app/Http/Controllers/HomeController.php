<?php

namespace App\Http\Controllers;

use App\Absen;
use App\Classes;
use App\Pertemuan;
use App\User;
use App\Userclass;
use App\Userlog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $classes = Userclass::where('user_id', $user->id)->get();
        return view('home')->with('classes', $classes);
    }

    public function viewAllClass(){
        $classes = Classes::all();
        $user = Auth::user();
        $statuses = [];
        $message = '';

        foreach($classes as $class){
            $exist = Userclass::where('user_id', $user->id)->where('classes_id', $class->id)->first();

            if($exist != NULL){
                array_push($statuses, [
                    "status"=>'1',
                    "classes_id"=>$class->id
                ]);
            }else{
                array_push($statuses, [
                    "status"=>'2',
                    "classes_id"=>$class->id
                ]);
            }
        }

        return view('allclass')->with('classes', $classes)->with('statuses', $statuses)->with('message', $message);
    }

    public function enrollClass($class_id){
        $user = Auth::user();
        $class = Classes::where('id', $class_id)->first();

        DB::table('userclasses')->insert([
            'user_id'=>$user->id,
            'classes_id'=>$class->id
        ]);

        return redirect('/');
    }

    public function unenrollClass($class_id){
        $user = Auth::user();

        DB::table('userclasses')->where('user_id', $user->id)->where('classes_id', $class_id)->delete();

        return redirect('/');
    }

    public function searchClass(Request $request){
        $classes = Classes::where('name', 'like', '%' . $request->search . '%')->get();
        $user = Auth::user();
        $statuses = [];
        $message = 'Search result for "' . $request->search . '"';

        foreach($classes as $class){
            $exist = Userclass::where('user_id', $user->id)->where('classes_id', $class->id)->first();

            if($exist != NULL){
                array_push($statuses, [
                    "status"=>'1',
                    "classes_id"=>$class->id
                ]);
            }else{
                array_push($statuses, [
                    "status"=>'2',
                    "classes_id"=>$class->id
                ]);
            }
        }

        return view('allclass')->with('classes', $classes)->with('statuses', $statuses)->with('message', $message);
    }

    public function viewDosen()
    {
        $users = User::where('role', 'dosen')->orderBy('username', 'ASC')->get();
        return view('dosenlog')->with('users', $users);
    }

    public function viewMahasiswa()
    {
        $users = User::where('role', 'mahasiswa')->orderBy('username', 'ASC')->get();
        return view('mahasiswalog')->with('users', $users);
    }

    public function viewClass()
    {
        $users = User::where('role', 'dosen')->get();
        $classes = [];

        foreach($users as $user){
            $class = Classes::where('dosen_id', $user->id)->get();
            foreach($class as $cls){
                array_push($classes, [
                'id' => $cls->id,
                'dosen_id' => $cls->dosen_id,
                'name' => $cls->name,
                'timedesc' => $cls->timedesc,
                'location' => $cls->location,
                'created_at' => $cls->created_at,
                'updated_at' => $cls->updated_at
                ]);
            }
        }

        return view('classlog')->with('classes', $classes)->with('users', $users);
    }

    public function viewPertemuan($dosenid, $classid){
        $class = Classes::where('id', $classid)->first();
        $dosen = User::where('id', $dosenid)->first();
        $pertemuan = Pertemuan::where('classes_id', $classid)->get();
        $absen = [];

        foreach($pertemuan as $pert){
            $temp = Absen::where('pertemuan_id', $pert->id)->get();
            foreach($temp as $tmp){
                array_push($absen, [
                'id' => $tmp->id,
                'pertemuanid' => $tmp->pertemuan_id,
                'name' => $tmp->mahasiswa->name,
                'nim' => $tmp->mahasiswa->username,
                'date' => $tmp->date
                ]);
            }
        }

        return view('pertemuanlog')->with('pertemuan', $pertemuan)->with('absen', $absen)->with('class', $class)->with('dosen', $dosen);
    }

    public function viewForbidden(){
        return view('forbidden');
    }
}
