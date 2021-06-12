<?php

namespace App\Http\Controllers;

use App\Classes;
use App\Pertemuan;
use App\User;
use App\Userclass;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function viewProfile(){
        $user = Auth::user();
        return view ('auth/profile')->with('user', $user);
    }

    public function viewEditProfile(){
        $user = Auth::user();
        return view ('auth/editprofile')->with('user', $user);
    }

    public function editProfile(Request $request){
        $user = Auth::user();

        $request->validate([
            'image' => 'mimes:jpg,jpeg,png',
            'name' => 'required',
            'email' => 'required',
            ]);

            if($request->hasFile('image')){
                $path = 'img/avatar/';
                File::delete($path.$user->image);

                $file = $request->file('image');
                $file->move('img/avatar/', $request->image->getClientOriginalName());

                DB::table('users')->where('id', $user->id)->update([
                    'name'=> $request->name,
                    'image'=> $request->image->getClientOriginalName(),
                    'email'=> $request->email,
                    'updated_at' => Carbon::now('Asia/Jakarta')
                ]);
            }else{
                DB::table('users')->where('id', $user->id)->update([
                    'name'=> $request->name,
                    'image'=> 'empty',
                    'email'=> $request->email,
                    'updated_at' => Carbon::now('Asia/Jakarta')
                ]);
            }
        
        return redirect('/');
    }

    public function viewChangePassword(){
        $user = Auth::user();
        $error = session('error');
        if($error == null){
            $error == null;
        }
        return view ('auth/changepassword')->with('user', $user)->with('error', $error);
    }

    public function changePassword(Request $request){
        $user = Auth::user();

        $request->validate([
            'currentpass'=>'required',
            'new_password'=>'required',
            'confirm_password'=>'required|same:new_password'
        ]);
        
        if(Hash::check($request->currentpass, $user->password)){
            $newpassword = Hash::make($request->new_password);
            $currentuser = User::find(Auth::id());
            $currentuser->password = $newpassword;
            $currentuser->updated_at = Carbon::now('Asia/Jakarta');
            $currentuser->save();
            
            return redirect('/');
        }
        else{
            $error = 'Current password incorrect!';
            return redirect('/changePassword')->with('error', $error);
        }
    }
    
    public function addUser(Request $request, $role){
        $request->validate([
            'username'=>'required',
            'name'=>'required',
            'email'=>'required'
        ]);

        DB::table('users')->insert([
            'email' => $request->email,
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->username),
            'image'=> 'empty',
            'role' => $role,
            'created_at' => Carbon::now('Asia/Jakarta')
        ]);

        return redirect('/userregistered/'.$role);
    }

    public function deleteDosen($user_id){
        $class = Classes::where('dosen_id', $user_id)->get();
        $path = 'img/class_image/';

        foreach($class as $cls){
            $pertemuan = Pertemuan::where('classes_id', $cls->id)->get();

            foreach($pertemuan as $pert){
                DB::table('absens')->where('pertemuan_id', $pert->id)->delete();
            }

            DB::table('pertemuans')->where('classes_id', $cls->id)->delete();
            File::delete($path.$cls->image);
            DB::table('userclasses')->where('classes_id', $cls->id)->delete();
            DB::table('classes')->where('id', $cls->id)->delete();
        }
        
        DB::table('users')->where('id', $user_id)->delete();

        return redirect('/userregistered/dosen');
    }

    public function deleteMahasiswa($user_id){

        DB::table('absens')->where('user_id', $user_id)->delete();
        DB::table('userclasses')->where('user_id', $user_id)->delete();
        DB::table('users')->where('id', $user_id)->delete();

        return redirect('/userregistered/mahasiswa');
    }
}
