@extends('layouts.app')
@section('title', 'Edit Schedule')
@section('content')
<div class="card"><div class="card-header bg-white"><strong>Edit Schedule</strong></div>
<div class="card-body">@include('schedules._form')</div></div>
@endsection
