<div class="control-group">
	<label for="textfield" class="control-label">{{ $field['title'] }}</label>
	<div class="controls">
		<div class="fileupload {{ empty($banner->fields->{$field['name']}) ? 'fileupload-new' : 'fileupload-exists' }}" data-provides="fileupload">
			<input name="{{ $field['name'] }}" type="hidden" value="{{ empty($banner->fields->{$field['name']}) ? '' : $banner->fields->{$field['name']} }}">
			<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
				<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image">
			</div>
			<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;">
				@if (!empty($banner->fields->{$field['name']}))
				<img src="/uploads/banners/{{ $banner->fields->{$field['name']} }}" />
				@endif
			</div>
			<div>
				<span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name="{{ $field['name'] }}"></span>
				<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
			</div>
		</div>
	</div>
</div>