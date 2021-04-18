@if ($errors->any())
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

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