@extends('layouts.app')
@section('title', 'New Enrollment')
@section('content')
<div class="card"><div class="card-header bg-white"><strong>New Enrollment</strong></div>
<div class="card-body">@include('enrollments._form')</div></div>
@endsection
