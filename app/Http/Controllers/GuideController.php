<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guide;
use Validator;
class GuideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guides= Guide::get();
        return view('admin.guides.index',compact('guides'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.guides.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{

        $validatio= Validator::make($request->all(),[
            'question' => 'required',
            'description'=>'required'
        ]);
       

        if($validatio->fails())
        {
            return redirect()->back()->with(['error'=>$validatio->fails()]);
        }
        $input = $request->except(['_token'],$request->all());
        Guide::create($input);
        return redirect()->route('guides.index')->with(['success'=>'Recod Created Successfully']);
    }catch(\Exception $e){
        return redirect()->back()->with(['error'=>$e->getMessage()]);

    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $guide =Guide::find($id);
        return view('admin.guides.edit',compact('guide'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $guide = Guide::find($id);
            $guide->question = $request->question;
            $guide->description = $request->description;
            $guide->save();
            return redirect()->route('guides.index')->with(['success'=>'Recod Updated Successfully']);
        }catch(\Exception $e){
            return redirect()->back()->with(['error'=>$e->getMessage()]);
        }
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $guide = Guide::find($id);
        $guide->delete();
        return redirect()->back()->with(['success'=>'Recod Deleted Successfully']);
  
    }
}
