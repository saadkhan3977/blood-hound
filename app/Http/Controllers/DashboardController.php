<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminInfo;
use App\Models\User;
use Validator;

class DashboardController extends Controller
{
   public function dashboard()
   {
      return view('admin.dashboard');
   }
   public function admin_info()
   {
      $admin = AdminInfo::first();
      return view('admin.info',compact('admin'));
   } 
   
   public function negotiators_list()
   {
      $users = User::where('role','Qbid Negotiator')->get();
      return view('admin.negotiator_list',compact('users'));
   } 

   public function admin_info_post(Request $request)
   {
      try{
         $validator = Validator::make($request->all(),[
             'official_email' => 'required|email',
             'phone'=>'required|numeric'
         ]);
         if($validator->fails())
         {
             return redirect()->back()->with(['error'=>$validator->errors()->first()]); 
         }
         if($request->id != null)
         {
            $admin = AdminInfo::first();
            $admin->official_email = $request->official_email;
            $admin->phone = $request->phone;
            $admin->save();
         }else{
            $admin =new AdminInfo();
            $admin->official_email = $request->official_email;
            $admin->phone = $request->phone;
            $admin->save();
         }
         return redirect()->back()->with(['success'=>'Record Created Successfully']);
      
      }catch(\Exception $e){
            return redirect()->back()->with(['error'=>$e->getMessage()]);
        }
   }
}
