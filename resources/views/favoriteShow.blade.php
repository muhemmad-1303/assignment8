@extends('layouts.app')
@section('head')
<link rel="stylesheet" href="{{asset('style.css')}}">
@endsection
@section('content')
@section('content')
<div class="main mainFav">
    <div class="nav">
    </div>
    <div class="fruits">
        <h1>Favourite Fruits.....</h1>
        <div class="fruitCardBody">
            @if ($fruits->isEmpty())
            <h1>No fruits found</h1>
            @else
            @foreach($fruits as $fruit)
            <div class="fruitCard">
                <div class="fruitCardContent">
                    <img src="{{ asset('fruit.png') }}" alt="Example Image">
                    <h4>Name:{{$fruit->name}}</h4>
                    <h4>Nutrition Facts</h4>
                    <h4>Calories:{{$fruit->calories}}</h4>
                    <h4>Fat:{{$fruit->fat}}</h4>
                    <h4>Sugar:{{$fruit->sugar}}</h4>
                    <h4>Carbohydrates:{{$fruit->carbohydrates}}</h4>
                    <h4>Protein:{{$fruit->protein}}</h4>
                    <form method="post" action="/removeFromFavourites">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="fruitId" value="{{ $fruit->id }}">
                        <button type="submit" class="btn">Remove from Favorites</button>
                    </form>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</div>
@endsection