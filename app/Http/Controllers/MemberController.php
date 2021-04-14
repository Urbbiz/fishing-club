<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Models\Reservoir;
use Validator;

class MemberController extends Controller
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
    // public function index()
    // {
    //     //
    // }

    public function index(Request $request)
    {
       //FILTRAVIMAS
       $reservoirs = Reservoir::all();
    //    $reservoirs = Reservoir::orderBy('title')->get();  //sita eilute dedam jeigu iskart norim isrusiuoti pagal kazka
      
       

       if($request->reservoir_id) {
           $members = Member::where('reservoir_id',$request->reservoir_id) ->get();
           $filterBy = $request->reservoir_id;
        //    $members->append(['reservoir_id' => $request->reservoir_id]);
           
           
       }
       else {
        
        $members = Member::all();
        $members = Member::orderBy('name')->get();
       }

       // Rusiavimas SORT
       if($request->sort && 'asc' == $request->sort) {
           $members = $members ->sortBy('surname');
           $sortBy = 'asc';
       }
       elseif($request->sort && 'desc' == $request->sort) {
           $members = $members ->sortByDesc('surname');
           $sortBy = 'desc';
       }

   return view('member.index', [
    // $reservoirs = Reservoir::orderBy('title')->get();
       'reservoirs' => $reservoirs, 
       'members' => $members,
       'filterBy'=>$filterBy ?? 0,
       'sortBy' => $sortBy ?? ''
       ]);
   }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('member.create');
        $reservoirs = Reservoir::orderBy('title')->get();
        return view('member.create', ['reservoirs' => $reservoirs->sortBy('title')]);
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
           'member_name' => ['required','regex:/^[\pL\s\-]+$/u', 'min:3', 'max:100'],
           'member_surname' => ['required','regex:/^[A-Z][a-zA-z\s\'\-]*[a-z]$/', 'min:3', 'max:150'],
           'member_live' => ['required','regex:/^[\pL\s\-]+$/u', 'min:3', 'max:50'],
           'member_experience' => ['required', 'numeric', 'min:0'],
           'member_registered' => ['required','lt:member_experience', 'numeric', 'min:1'],  //'gt:meat'
           'reservoir_id' => ['required',],
            ],
            [
            'member_surname.required' => 'Name cannot be empty!',
            'member_surname.min' => 'To short Surname',
            'member_name.required' => 'Surname cannot be empty',
            'member_name.regex' => 'be kableliu',
            ]
       );
       if ($validator->fails()) {
           $request->flash();
           return redirect()->back()->withErrors($validator);
       }

        $member = new Member;
    $member->name = $request->member_name;
    $member->surname = $request->member_surname;
    $member->live = $request->member_live;
    $member->experience = $request->member_experience;
    $member->registered = $request->member_registered;
    $member->reservoir_id = $request->reservoir_id;
    $member->save();
    return redirect()->route('member.index')->with('success_message', 'New member added!');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        // return view('member.edit', ['member' => $member]);

        $reservoirs = Reservoir::orderBy('title')->get();
        return view('member.edit', ['member' => $member,'reservoirs' => $reservoirs->sortBy('title')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {
        $validator = Validator::make(
            $request->all(),
             [
           'member_name' => ['required', 'min:3', 'max:100'],
           'member_surname' => ['required', 'min:3', 'max:150'],
           'member_live' => ['required', 'min:3', 'max:50'],
           'member_experience' => ['required', 'numeric'],
           'member_registered' => ['required', 'numeric'],
           'reservoir_id' => ['required',],
            ],
            [
            'member_surname.required' => 'Name cannot be empty!',
            'member_surname.min' => 'To short Surname',
            'member_name.required' => 'Surname cannot be empty',
            ]
       );
       if ($validator->fails()) {
           $request->flash();
           return redirect()->back()->withErrors($validator);
       }

      
    $member->name = $request->member_name;
    $member->surname = $request->member_surname;
    $member->live = $request->member_live;
    $member->experience = $request->member_experience;
    $member->registered = $request->member_registered;
    $member->reservoir_id = $request->reservoir_id;
    $member->save();
    return redirect()->route('member.index')->with('success_message', 'New member added!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        
        $member->delete();
        return redirect()->route('member.index')->with('success_message', 'Member deleted!');
 
 
    }
    }

