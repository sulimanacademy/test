@extends('layouts.app')

<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>

<script type="text/javascript">

    function enabler() {
        let min_ = $("button[value='minus']").length;
        let max_ = $("button[value='plus']").length;
        if (min_ === 1) {
            $("button[value='minus']").prop('disabled', true);
        } else {
            $("button[value='minus']").prop('disabled', false);
        }
        if (max_ === 5) {
            $("button[value='plus']").prop('disabled', true);
        } else {
            $("button[value='plus']").prop('disabled', false);
        }
    }

    $(document).ready(function () {
        enabler();
    })

    $(document).on("click", "form", function (event) {
        let obj = event.target;
        if (obj.value === 'plus') { //make new row insertion
            obj = obj.closest('div');
            let clone_ = $(obj).clone();
            $(clone_).find("input").val("");
            clone_.insertAfter(obj);
        }
        if (obj.value === 'minus') { //make current row deletion
            let obj2 = obj.closest('div');
            $(obj2).remove();
        }
        enabler();
    });
</script>

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header text-left">
						<div class="row align-items-center">
							<div class="col-md-11"> Menu Settings</div>
							<div class="col-md-1">
								<a class="btn btn-primary bg-warning float-end" href="home" role="button">Back</a>
							</div>
						</div>
					</div>
					<div class="card-body">
						<form action="" method="post">
							@csrf
							@if (isset($data))
								@foreach( $data as $menu)
									<div class="input-group mb-3">
										<span class="input-group-text">Tiltle:</span>
										<input type="text" name="row[title][]" class="form-control"
										       value="<?=$menu->title?>">
										<span class="input-group-text">Link:</span>
										<input type="text" name="row[link][]" class="form-control"
										       value="<?=$menu->link?>">
										<button type="button" class="btn bg-danger" value="minus">-</button>
										<button type="button" class="btn bg-success" value="plus">+</button>
									</div>
								@endforeach
							@endif
							<div class="d-grid gap-2">
								<input type="submit" class="btn bg-info" value="Send">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection


