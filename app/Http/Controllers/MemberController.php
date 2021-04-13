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
        // $member = $request->sort ? Member::orderBy('surname')->get() : Member::all();
        if ('name' == $request->sort) {
            $member = Member::orderBy('name')->get();
        }
        elseif ('surname' == $request->sort) {
            $member = Member::orderBy('surname')->get();
        }
        else {
            $member = Member::all();
        }
        // $member = Member::all();
        // $member = Member::orderBy('surname')->get();
        return view('members.index', ['memberss' => $member]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('member.create');
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
           'member_name' => ['required', 'min:3', 'max:100'],
           'member_surname' => ['required', 'min:3', 'max:150'],
           'member_live' => ['required', 'min:3', 'max:50'],
           'member_experience' => ['required', 'numeric', 'max:4'],
           'member_registered' => ['required', 'numeric', 'max:4'],
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

        $members = new Member;
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
        return view('member.edit', ['member' => $member]);
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
           'member_experience' => ['required', 'numeric', 'max:4'],
           'member_registered' => ['required', 'numeric', 'max:4'],
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
        if($member->memberBooks->count()){
            return redirect()->route('member.index')->with('info_message', 'Can not delete, member have books.');
        }
        $member->delete();
        return redirect()->route('member.index')->with('success_message', 'Member deleted!');
 
 
    }
    }

