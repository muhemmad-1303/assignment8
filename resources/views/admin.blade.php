@extends('layouts.app')
@section('head')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="{{asset('style.css')}}">
<script src="{{asset('flashMessage.js')}}"></script>
<script src="{{asset('filterBox.js')}}"></script>
@endsection
@section('content')
<div class="main">
    <div class="nav">
        <div class="loginButton">
            <form action="/Adminlogout" method="post">
                @csrf
                <button type="submit">LogOut</button>
            </form>
        </div>
        <form action="/admin" method='get'>
            @csrf
            <input type="text" name="search" value="{{$search}}" placeholder="Search For The Fruit">
            <input type="submit" value="&#128269;">
        </form>
        <div class="filterOption">Filter</div>
    </div>
    <div class="fruits">
        <h1>Fruits.....</h1>
        <div class="fruitCardBody">
            @if ($fruits->isEmpty())
            <h1>No fruits found</h1>
            @else
            @foreach($fruits as $fruit)
            <div class="fruitCard">
                <div class="fruitCardContent">
                    <img src="{{ asset('fruit.png') }}" alt="Example Image">
                    <h4>Name:{{$fruit->name}}</h4>
                        <h4>Family:{{$fruit->family}}</h4>
                            <h4>Genus:{{$fruit->genus}}</h4>
                            <h4>addedBy:{{$fruit->favoriteCount}}</h4>
                </div>
            </div>
            @endforeach
            @endif

        </div>
    </div>

<div class="filter filterHidden">
    <div class="navFilter">
        <h3>Family</h3>
        <span class="closeFilter">X</span>
    </div>
    <form action="/admin" method="get">
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


<div class="paginator">
{{ $fruits->appends(request()->input())->links() }}
</div>
</div>
@endsection