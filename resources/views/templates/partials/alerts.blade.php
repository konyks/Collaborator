{{--Regular bootstrap alerts--}}
@if (Session::has('infoAlert'))
    <div class="alert alert-info fade in">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{Session::get('infoAlert')}}
    </div>
@endif

@if (Session::has('successAlert'))
	<div class="alert alert-success fade in">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		{{Session::get('successAlert')}}
	</div>
@endif

@if (Session::has('warningAlert'))
	<div class="alert alert-warning fade in">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		{{Session::get('warningAlert')}}
	</div>
@endif

@if (Session::has('dangerAlert'))
	<div class="alert alert-danger fade in">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		{{Session::get('dangerAlert')}}
	</div>
@endif

