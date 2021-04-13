<?php

namespace App\Http\Controllers;

use App\Models\Reservoir;
use App\Models\Member;
use Illuminate\Http\Request;
use Validator;

class ReservoirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
       //FILTRAVIMAS
        $reservoir_id = Member::all();

        if($request->reservoir_id) {
            $reservoirs = Reservoir::where('reservoir_id',$request->reservoir_id) ->get();
            $filterBy = $request->reservoir_id;
        }
        else {
            $reservoirs = Reservoir::all();
        }

        // Rusiavimas SORT
        if($request->sort && 'asc' == $request->sort) {
            $reservoirs = $reservoirs ->sortBy('title');
            $sortBy = 'asc';
        }
        elseif($request->sort && 'desc' == $request->sort) {
            $reservoirs = $reservoirs ->sortByDesc('title');
            $sortBy = 'desc';
        }

    return view('reservoir.index', [
        'reservoirs' => $reservoirs, 
        'reservoir_id' => $reservoir_id,
        'filterBy'=>$filterBy ?? 0,
        'sortBy' => $sortBy ?? ''
        ]);
    }
    // public function index()
    // {
    //     //
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $reservoirs = Reservoir::all();
        return view('reservoir.create', ['reservoirs' => $reservoirs]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        
            $validator = Validator::make(
                $request->all(),
                 [
               'reservoir_title' => ['required', 'min:3', 'max:200'],
               'reservoir_area' => ['required', 'numeric'],
               'reservoir_about' => ['required', 'min:3', 'max:400'],
               
                 ],
                 [

                 ]
                
           );
           if ($validator->fails()) {
               $request->flash();
               return redirect()->back()->withErrors($validator);
           }
          
    
            $reservoir = new Reservoir;
           $reservoir->title = $request->reservoir_title;
           $reservoir->area = $request->reservoir_area;
           $reservoir->about = $request->reservoir_about;
           $reservoir->save();
           return redirect()->route('reservoir.index')->with('success_message', 'Reservoir created!');
          
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservoir  $reservoir
     * @return \Illuminate\Http\Response
     */
    public function show(Reservoir $reservoir)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reservoir  $reservoir
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservoir $reservoir)
    {
        // $reservoir = Reservoir::all();
        return view('reservoir.edit', ['reservoir' => $reservoir]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservoir  $reservoir
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservoir $reservoir)
    {
        

            $validator = Validator::make(
                $request->all(),
                [
            'reservoir_title' => ['required', 'min:3', 'max:200'],
            'reservoir_area' => ['required', 'numeric'],
            'reservoir_about' => ['required', 'min:3', 'max:400'],
            
                ],
                [

                ]
            
            );
            if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
            }
    
            
    $reservoir->title = $request->reservoir_title;
    $reservoir->area = $request->reservoir_area;
    $reservoir->about = $request->reservoir_about;
    $reservoir->save();
    return redirect()->route('reservoir.index')->with('success_message', 'Reservoir created!');
    }
  

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservoir  $reservoir
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservoir $reservoir)
    {
        $reservoir->delete();
        return redirect()->route('reservoir.index')->with('success_message', 'Reservoir deleted!');
    }
}
