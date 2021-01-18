<?php

namespace App\Http\Controllers;

use App\Pertemuan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AbsenController extends Controller
{
    public function AddAbsen($class_id, $pertemuan_id){
        $user = Auth::user();
        $date = Carbon::now('Asia/Jakarta');

        $date_start = Pertemuan::where('id', $pertemuan_id)->first()->date_start;
        $date_end = Pertemuan::where('id', $pertemuan_id)->first()->date_end;

        if($date >= $date_start && $date <= $date_end){
            DB::table('absens')->insert([
                'date'=>$date,
                'user_id'=>$user->id,
                'pertemuan_id'=>$pertemuan_id
            ]);
            $errormessage = '';
        }else if($date < $date_start){
            $errormessage = 'not start';
        }else if($date > $date_end){
            $errormessage = 'over';
        }

        return redirect('/class/'.$class_id)->with('error', $errormessage);
    }

    public function deleteAbsen($class_id, $pertemuan_id, $absen_id){
        DB::table('absens')->where('id', $absen_id)->delete();
        return redirect('/class/'.$class_id);
    }
}
