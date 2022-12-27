@extends('home.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>{{$event->title}}</h1>
                {{$event->image}}
                <img src="{{ Storage::url('events/' . $event->image) }}" />
            </div>
        </div>
    </div>

@endsection
