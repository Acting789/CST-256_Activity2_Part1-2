@extends('layouts.appmaster')
@section('title','Login Page')

@section('content')
<form action="dologin3" method="post">
	<input type="hidden" name="_token" value="<?php echo csrf_token()?>" />
	<h2>Login Activity</h2>
	<table>
		<tr>
			<td>Username:</td>
			<td><input type="text" name="username" maxlength="10" />{{ $errors->first('username') }}</td>
		</tr>
		<tr>
			<td>Password:</td>
			<td><input type="password" name="password" maxlength="10"/>{{ $errors->first('password') }}</td>
		</tr>
		<tr>
			<td colspan="2" align="center"><input type="submit" value="Login" /></td>
		</tr>
	</table>
</form>
@endsection

<!-- display all the data validation errors -->
@if ($errrors->count() !=0)
	<h5>list of errors</h5>
		@foreach($errors->all() as $message)
			{{ $message }} <br>
		@endforeach
	@endif