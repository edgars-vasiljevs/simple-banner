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


<div class="row-fluid">
	<div class="span12">
		<div class="box">
			<div class="box-title">
				<h3>
					<i class="icon-reorder"></i>
					Select a banner type
				</h3>

			</div>
			<div class="box-content">

				@foreach($sections as $section)
				<a href="/admin/banners/new/{{ $section['name'] }}" class="btn btn-info">{{ $section['title'] }}</a>
				@endforeach

			</div>
		</div>
	</div>
</div>



