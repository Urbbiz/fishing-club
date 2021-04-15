<?php

namespace App\Http\Controllers;

use App\Models\Reservoir;
use App\Models\Member;
use Illuminate\Http\Request;
use Validator;

class ReservoirController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {

         // $member = $request->sort ? Member::orderBy('surname')->get() : Member::all();
         if ('title' == $request->sort) {
            $reservoirs = Reservoir::orderBy('title')->get();
        }
        elseif ('area' == $request->sort) {
            $reservoirs = Reservoir::orderBy('area')->get();
        }
        else {
            $reservoirs = Reservoir::all();
           
        }
        // $member = Member::all();
        // $member = Member::orderBy('surname')->get();
        return view('reservoir.index', ['reservoirs' => $reservoirs]);
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
               'reservoir_title' => ['required','regex:/^[A-Z][a-zA-z\s\'\-]*[a-z]$/', 'min:3', 'max:150'],
               'reservoir_area' => ['required', 'numeric', 'min:0','max:2000'],
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

        if($reservoir->reservoirMember->count() !==0){
            // return 'Trinti negalima, nes turi knygų';
            return redirect()->back()->with('info_message', 'Cannot delete resevoir, because it linked to member');
        }
        $reservoir->delete();
        return redirect()->route('reservoir.index')->with('success_message', 'Reservoir deleted!');
    }
}
