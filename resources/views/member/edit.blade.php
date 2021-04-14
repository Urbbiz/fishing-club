@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Edit Member</div>
               <div class="card-body">
                 <form method="POST" action="{{route('member.update',[$member])}}">
               
                    <div class="form-group">
                        <label>Name: </label>
                        <input type="text" class="form-control" name="member_name" value="{{old('member_name', $member->name)}}">
                        <small class="form-text text-muted">Edit member name.</small>
                    </div>
                    
                    <div class="form-group">
                        <label>Surname: </label>
                        <input type="text" class="form-control" name="member_surname" value="{{old('member_surname', $member->surname)}}" >
                        <small class="form-text text-muted">Please enter new member surname.</small>
                    </div>

                    <div class="form-group">
                        <label>Live: </label>
                        <input type="text" class="form-control" name="member_live" value="{{old('member_live', $member->live)}}" >
                        <small class="form-text text-muted">Please enter new member live place.</small>
                    </div>

                    <div class="form-group">
                        <label>Experience: </label>
                        <input type="text" class="form-control" name="member_experience" value="{{old('member_experience', $member->experience)}}" >
                        <small class="form-text text-muted">Please enter new member experience.</small>
                    </div>

                    <div class="form-group">
                        <label>Registration: </label>
                        <input type="text" class="form-control" name="member_registered" value="{{old('member_registered', $member->registered)}}" >
                        <small class="form-text text-muted">Please enter new member registration number.</small>
                    </div>

                     <div class="form-group">
                        <label>Reservoir: </label>
                        <select name="reservoir_id">
                            @foreach ($reservoirs as $reservoir)
                                <option value="{{$reservoir->id}}"@if($reservoir->id == $member->reservoir_id) selected @endif>
                                {{old('reservoir_title',$reservoir->title)}}
                                </option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Please please select reservoir name.</small>
                    </div>

                    @csrf
                    <button class="btn btn-primary" type="submit">EDIT</button>
                    </form>

               </div>
           </div>
       </div>
   </div>
</div>

<script>
$(document).ready(function() {
   $('#summernote').summernote();
 });
</script>

@endsection