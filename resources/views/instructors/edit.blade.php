@extends('layouts.app')
@section('title', 'Edit Instructor')
@section('content')
<div class="card"><div class="card-header bg-white"><strong>Edit Instructor</strong></div>
<div class="card-body">@include('instructors._form')</div></div>
@endsection
