@if(Auth::guard('web')->check())

	<p class="text-success"> You are logged In as a Employee.</p>

@else

	<p class="text-danger"> You are logged Out as Employee.</p>

@endif

@if(Auth::guard('admin')->check())

	<p class="text-success"> You are logged In as a Admin.</p>

@else

	<p class="text-danger"> You are logged Out as Admin.</p>

@endif