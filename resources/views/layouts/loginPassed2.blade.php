@extends('layouts.appmaster')
@section('title','Login Passed Page')

@section('content')
	@if($model->getUsername() == "mark")
		<h3>Marked logged in succesfully</h3>
	@else
		<h3>A not mark logged in succesfully</h3>
	@endif
	<br>
	<a href="login2">Login Agian</a>
	@endsection