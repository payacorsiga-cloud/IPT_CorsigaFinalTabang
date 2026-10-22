@extends('layouts.app')
@section('title', 'Add Dance Class')
@section('content')
<div class="card"><div class="card-header bg-white"><strong>Add Dance Class</strong></div>
<div class="card-body">@include('dance-classes._form')</div></div>
@endsection
