<div class="page-header">
	<div class="pull-left">
		<h1>Banners</h1>
	</div>
	<div class="pull-right">
		<ul class="minitiles">
			<li class="satgreen">
				<a href="/admin/banners/new"><i class="icon-plus-sign"></i></a>
			</li>
		</ul>
	</div>
</div>

@if (Session::has('deleted'))
<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<strong>Success!</strong> Banner successfully deleted!
</div>
@endif




<div class="row-fluid">
	<div class="span12">

		<div class="box">

			<div class="box-title">
				<h3>
					<i class="icon-reorder"></i>
					Banners in this category
				</h3>
				<ul class="tabs">
					@foreach($sections as $section)
						<li {{ $section['name'] == $active_section ? 'class="active"' : '' }}>
							<a href="/admin/banners/index/{{ $section['name'] }}">{{ $section['title'] }}</a>
						</li>
					@endforeach
				</ul>
			</div>


			<div class="box-content nopadding">


				@if (count($banners))
					<table class="table table-hover table-nomargin table-bordered table-top-border">
						<thead>
						<tr>

							@foreach($fields as $field)
								@if (isset($field['cms']))
									<th{{ isset($field['cms']['width']) ? ' style="width: ' . $field['cms']['width'] . 'px"' : '' }}>{{ $field['title'] }}</th>
								@endif
							@endforeach

							<th style="width: 80px;"></th>
						</tr>
						</thead>
						<tbody>
						@foreach($banners as $banner)

							<tr>

								@foreach($banner->fields->getValues() as $name => $field)
									@if ( isset( $fields[ $name ]['cms'] ) )
										@if ($fields[ $name ]['type'] == 'image')
											<td>
												<img {{ isset($fields[ $name ]['cms']['width']) ? 'style="width: '.$fields[ $name ]['cms']['width'].'px"' : '' }} src="/uploads/banners/{{ $field }}" />
											</td>
										@elseif ($fields[ $name ]['type'] == 'multi')
											<td>
												{{ $banner->fields->{$name} }}
											</td>
										@endif
									@endif
								@endforeach

								<td>
									<a class="btn" href="/admin/banners/edit/{{ $banner->id }}">Edit</a>
									<a class="btn btn-danger" data-confirm="Are you sure you want to delete this banner?" href="/admin/banners/delete/{{ $banner->id }}"><i class="icon-remove"></i></a>
								</td>

							</tr>

						@endforeach

						</tbody>
					</table>

				@else

				<div class="well text-center">
					No banners in this category
				</div>

				@endif
			</div>
		</div>
	</div>
</div>
