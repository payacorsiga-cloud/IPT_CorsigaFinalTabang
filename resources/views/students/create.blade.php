@extends('layouts.app')
@section('title', 'Add Student')
@section('content')
<div class="card"><div class="card-header bg-white"><strong>Add Student</strong></div>
<div class="card-body">@include('students._form')</div></div>
@endsection
