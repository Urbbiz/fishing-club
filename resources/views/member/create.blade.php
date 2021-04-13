@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Create New Member</div>

               <div class="card-body">
                 <form method="POST" action="{{route('member.store')}}">
                    <div class="form-group">
                        <label>Name: </label>
                        <input type="text" class="form-control" name="member_name" value="{{old('member_name')}}">
                        <small class="form-text text-muted">Please enter new member name.</small>
                    </div>
                    
                    <div class="form-group">
                        <label>Surname: </label>
                        <input type="text" class="form-control" name="member_surname" value="{{old('member_surname')}}" >
                        <small class="form-text text-muted">Please enter new member surname.</small>
                    </div>

                    <div class="form-group">
                        <label>Live: </label>
                        <input type="text" class="form-control" name="member_live" value="{{old('member_live')}}" >
                        <small class="form-text text-muted">Please enter new member live place.</small>
                    </div>

                    <div class="form-group">
                        <label>Experience: </label>
                        <input type="text" class="form-control" name="member_experience" value="{{old('member_experience')}}" >
                        <small class="form-text text-muted">Please enter new member experience.</small>
                    </div>

                    <div class="form-group">
                        <label>Registration: </label>
                        <input type="text" class="form-control" name="member_registered" value="{{old('member_registered')}}" >
                        <small class="form-text text-muted">Please enter new member registration number.</small>
                    </div>

                     <div class="form-group">
                        <label>Reservoir: </label>
                        <select name="reservoir_id">
                            {{-- @foreach ($reservoirs as $reservoir)
                                <option value="{{$reservoir->id}}">{{$reservoir->name}} {{$reservoir->surname}}</option>
                            @endforeach --}}
                        </select>
                        <small class="form-text text-muted">Please please select reservoir name.</small>
                    </div>
                     @csrf
                     <button class="btn btn-primary" type="submit">ADD</button>
                  </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection
