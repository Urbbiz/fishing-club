@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Add new reservoir</div>
               <div class="card-body">
                <form method="POST" action="{{route('reservoir.store')}}">
                <div class="form-group">
                        <label>Title: </label>
                        <input type="text" class="form-control" name="reservoir_title" value="{{old('reservoir_title')}}">
                        <small class="form-text text-muted">Please enter reservoir title.</small>
                    </div>
                    <div class="form-group">
                        <label>Area : </label>
                        <input type="text" class="form-control" name="reservoir_area"  value="{{old('reservoir_area')}}">
                        <small class="form-text text-muted">Please enter reservoir area.</small>
                    </div>
                    <div class="form-group">
                        <label>About </label>
                        <textarea name="reservoir_about" value="{{old('reservoir_about')}}" id="summernote"> </textarea>
                        <small class="form-text text-muted">About this reservoir.</small>
                    </div>
                    @csrf
                    <button class="btn btn-primary" type="submit">ADD</button>
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
