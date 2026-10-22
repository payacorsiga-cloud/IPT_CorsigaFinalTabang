@extends('layouts.app')
@section('title', 'Edit Enrollment')
@section('content')
<div class="card"><div class="card-header bg-white"><strong>Edit Enrollment</strong></div>
<div class="card-body">@include('enrollments._form')</div></div>
@endsection
