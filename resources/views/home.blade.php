@extends('layouts.app')
@include('menu')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">{{ __('Dashboard') }}</div>
					<div class="card-body">
						@if (session('status'))
							<div class="alert alert-success" role="alert">
								{{ session('status') }}
							</div>
						@endif
						<div class="row">
							<div class="col-9"><h4>Menu settings</h4></div>
							<div class="col-3 d-grid">
								<a href="menusets" class="btn btn-info" role="button">Edit...</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
@endsection
