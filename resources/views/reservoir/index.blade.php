@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
          <div class="card">
            <div class="card-header">
               <h2>Reservoir List</h2>
               <a href="{{route('reservoir.index',['sort'=>'title'])}}">Sort by Title</a>
               <a href="{{route('reservoir.index',['sort'=>'area'])}}">Sort by Area</a>
               <a href="{{route('reservoir.index')}}">Default</a>
            </div>
               <div class="card-body">
                <ul class="list-group">

                  @foreach ( $reservoirs as $reservoir) 
                  {{-- @foreach ( $reservoirs = $reservoirs ->sortBy('area') as $reservoir) "toki darom, jeigu default reikia pagal kazka rusiuoti" --}}
                    <li class="list-group-item list-line">
                      <div>
                        <h4>{{$reservoir->title}}</h4>
                        <h6> Area: {{$reservoir->area}} </h6>
                        <h6> About: {{$reservoir->about}} </h6>
                      </div> 
                      <div class="list-line__buttons">
                        <a href="{{route('reservoir.edit',[$reservoir])}}" class="btn btn-info">EDIT</a>
                        <form method="POST" action="{{route('reservoir.destroy', [$reservoir])}}">
                        @csrf
                        <button type="submit" class="btn btn-danger">DELETE</button>
                        </form>
                      </div>
                    </li>
                    @endforeach
                </ul>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection
