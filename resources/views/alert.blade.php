@if (session('success'))
<br>
<div class="alert alert-success" role="alert">
	<b>Message : </b>{{ session('success') }}
</div>
@endif

@if (session('update'))
<br>
<div class="alert alert-warning" role="alert">
	<b>Message : </b>{{ session('update') }}
</div>
@endif

@if (session('delete'))
<br>
<div class="alert alert-danger" role="alert">
	<b>Message : </b>{{ session('delete') }}
</div>
@endif