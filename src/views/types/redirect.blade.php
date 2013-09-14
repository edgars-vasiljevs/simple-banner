<div class="control-group">

	<label for="layout" class="control-label">{{ $field['title'] }}</label>

	<div class="controls">
		<select name="{{ $field['name'] }}[type]" class="banner-redirect" class="input-mini">
			<option value="1">URL</option>
			<option value="2" {{ (isset($banner->fields->{$field['name']}->type) && $banner->fields->{$field['name']}->type == 2) ? 'selected="selected"' : '' }}>Page</option>
		</select>

		<select name="{{ $field['name'] }}[page_id]">
			@foreach($tree as $item)
			<option {{ (isset($banner->fields->{$field['name']}->page_id) && $banner->fields->{$field['name']}->page_id == $item->id) ? 'selected="selected"' : '' }} value="{{ $item->id }}">{{ str_repeat(' &nbsp; &nbsp; ', $item->level) .' '. $item->title }}</option>
			@endforeach
		</select>

		<div class="input-prepend">
			<span class="add-on"><i class="icon-link"></i></span>
			<input type="text" name="{{ $field['name'] }}[url]" value="{{ Input::old($field['name'] . '.url', !empty($banner->fields->{$field['name']}->url) ? $banner->fields->{$field['name']}->url : '' ) }}" class="input-xlarge"/>
		</div>

	</div>

</div>

