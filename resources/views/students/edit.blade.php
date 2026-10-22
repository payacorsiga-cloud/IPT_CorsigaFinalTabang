@extends('layouts.app')
@section('title', 'Edit Student')
@section('content')
<div class="card"><div class="card-header bg-white"><strong>Edit Student</strong></div>
<div class="card-body">@include('students._form')</div></div>
@endsection
