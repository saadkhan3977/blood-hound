<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trophy;

class TrophyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $trophy =  Trophy::get();
       return view('admin.trophy.index',compact('trophy'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.trophy.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $add = Trophy::create($request->all());
        if($add)
        {
            return redirect()->back()->with(['success'=>'Successfully added']);
        }else{
            return redirect()->back()->with(['error'=>'Please try again']);  
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
        $trophy =Trophy::find($id);
        return view('admin.trophy.edit',compact('trophy'));
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
            $trophy = Trophy::find($id);
            $trophy->name = $request->name;
            $trophy->trophy = $request->trophy;
            $trophy->save();
            return redirect()->route('trophy.index')->with(['success'=>'Recod Updated Successfully']);
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
        $trophy = Trophy::find($id);
        $trophy->delete();
        return redirect()->back()->with(['success'=>'Recod Deleted Successfully']);
    }
}
