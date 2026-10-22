@extends('layouts.app')
@section('title', 'Add Schedule')
@section('content')
<div class="card"><div class="card-header bg-white"><strong>Add Schedule</strong></div>
<div class="card-body">@include('schedules._form')</div></div>
@endsection
