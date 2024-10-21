<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TermsAndCondition;
use Validator;
class TermAndConditionController extends Controller
{
    public function index()
    {
        $data = TermsAndCondition::first();
        return view('admin.termsandcontions.edit',compact('data'));
    } 
    public function termandcontionpost(Request $request)
    {
       try{
          $validator = Validator::make($request->all(),[
              'effective_date' => 'required',
              'description'=>'required'
          ]);
          if($validator->fails())
          {
              return redirect()->back()->with(['error'=>$validator->errors()->first()]); 
          }
          if($request->id != null)
          {
             $admin =TermsAndCondition::first();
             $admin->effective_date = $request->effective_date;
             $admin->description = $request->description;
             $admin->save();
          }else{
             $admin =new TermsAndCondition();
             $admin->effective_date = $request->effective_date;
             $admin->description = $request->description;
             $admin->save();
          }
          return redirect()->back()->with(['success'=>'Record Created Successfully']);
       
       }catch(\Exception $e){
             return redirect()->back()->with(['error'=>$e->getMessage()]);
         }
    }
}
