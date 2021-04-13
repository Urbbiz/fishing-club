@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Edit reservoir</div>
               <div class="card-body">
                <form method="POST" action="{{route('reservoir.update',[$reservoir])}}">
                <div class="form-group">
                        <label>Title: </label>
                        <input type="text" class="form-control" name="reservoir_title" value="{{$reservoir->title}}" value="{{old('reservoir_title',$reservoir->title)}}">
                        <small class="form-text text-muted">Edit reservoir title.</small>
                    </div>
                    <div class="form-group">
                        <label>Area : </label>
                        <input type="text" class="form-control" name="reservoir_area" value="{{old('reservoir_area',$reservoir->area)}}">
                        <small class="form-text text-muted">Edit reservoir area.</small>
                    </div>
                    <div class="form-group">
                        <label>About </label>
                        <textarea name="reservoir_about"  id="summernote">{{($reservoir->about)}} </textarea>
                        <small class="form-text text-muted">About this reservoir.</small>
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
