@extends('layouts.app')
@section('head')
<link rel="stylesheet" href="{{asset('style.css')}}">
<script src="{{asset('flashMessage.js')}}"></script>
<script src="{{asset('filterBox.js')}}"></script>


@endsection

@section('content')
<div class="main">
    <div class="nav">
       <form action="/" method='get'>
        @csrf
           <input type="text" name="search" value="{{$search}}" placeholder="Search For The Fruit">
           <input type="submit" value="&#128269;">
       </form>
       <div class="filterOption">Filter</div>
    </div>
    <div class="fruits">
        <h1>Fruits.....</h1>
        @if(session('error'))
            <div class="alertSession">
                {{ session('error') }}
            </div>
            @endif
        <div class="fruitCardBody">
            @if ($fruits->isEmpty())
            <h1>No fruits found</h1>
            @else
            @foreach($fruits as $fruit)
            <div class="fruitCard">
                <div class="fruitCardContent">
                    <img src="{{ asset('fruit.png') }}" alt="Example Image">
                    <h4>Name:{{$fruit->name}}</h2>
                        <h4>Family:{{$fruit->family}}</h2>
                            <h4>Genus:{{$fruit->genus}}</h2>
                                <form method="post" action="/addToFavourites">
                                    @csrf
                                    <button type="submit" class="btn">Add to Favorites</button>
                                </form>
                </div>
            </div>
            @endforeach
            @endif

        </div>
    </div>
</div>
<div class="filter filterHidden">
    <div class="navFilter">
        <h3>Family</h3>
        <span class="closeFilter">X</span>
    </div>
    <form action="/" method="GET">
        @csrf
        @foreach($distinctFamilyNames as $familyName)
            <label>
                <input type="checkbox" name="family_names[]" value="{{ $familyName }}" {{ in_array($familyName, $selectedFamilyNames) ? 'checked' : '' }}>
                {{ $familyName }}
            </label>
        @endforeach
        <button type="submit" class='filterSubmit'>Apply Filter</button>
    </form>
</div>


{{ $fruits->appends(request()->input())->links() }}
@endsection