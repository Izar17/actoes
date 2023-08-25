@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <div style="text-align: center;"><br>
                <h1>WELCOME TO RPDOS <br><br> </h1>
                <h2>{{ old('email', auth()->user()->name) }}</h2>
            </div>
        </div>
    @endsection
