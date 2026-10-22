@extends('layouts.app')
@section('title', 'Add Instructor')
@section('content')
<div class="card"><div class="card-header bg-white"><strong>Add Instructor</strong></div>
<div class="card-body">@include('instructors._form')</div></div>
@endsection
