<div class="page-header">
	<div class="pull-left">
		<h1>Add new banner</h1>
	</div>

	<div class="pull-right">
		<ul class="minitiles">
			<li class="lightgrey">
				<a href="/admin/banners"><i class="icon-arrow-left"></i></a>
			</li>
		</ul>
	</div>

</div>

@if (Session::has('created') || Session::has('updated'))
<div class="alert alert-success compact">
	<button type="button" class="close" data-dismiss="alert">×</button>

	@if (Session::has('created'))
	<strong>Success!</strong> Banner successfully created!
	@elseif (Session::has('updated'))
	<strong>Success!</strong> Banner successfully saved!
	@endif

</div>
@endif


<div class="row-fluid">
	<div class="span12">
		<div class="box box-bordered">
			<div class="box-title">
				<h3><i class="icon-th-list"></i> Banner</h3>
			</div>
			<div class="box-content nopadding">
				<form action="{{ isset($banner) ? '/admin/banners/update/' . $banner->id : '/admin/banners/create' }}" method="POST" class="form-horizontal form-bordered" enctype="multipart/form-data">

					{{ Form::hidden('section', $section_name) }}

					<div class="control-group">
						<label class="control-label">Status</label>

						<div class="controls">
							<label class="checkbox">

								{{ Form::hidden('status', false) }}
								{{ Form::checkbox('status', true, Input::old('status', isset($banner->status) ? $banner->status : true)) }} Enabled

							</label>
						</div>
					</div>



					@foreach($fields as $field)

						@include('banner::types.' . $field['type'])

					@endforeach



					<div class="form-actions">
						<button type="submit" class="btn btn-primary">Save changes</button>
						<a href="/admin/languages" class="btn">Cancel</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">

	$(function() {

		$('select.banner-redirect').change(function() {

			var page = $(this).next();
			var url = $(this).next().next();

			var val = $(this).val();

			if (val == 1) {
				page.hide();
				url.show();
			}
			if (val == 2) {
				page.show();
				url.hide();
			}
		}).change();

	});

</script>

