<div class="control-group">
	<label for="{{ $field['name'] }}" class="control-label">
		{{ $field['title'] }}
	</label>

	@foreach(Simple\Cms\Language::$languages as $lang)

		<div class="controls append @if ($errors->has( $field['name'] . '_' . $lang->code)) error @endif ">
			<div class="input-append">
				<input type="text" name="{{ $field['name'] }}_{{ $lang->code }}" value="{{ Input::old( $field['name'] . '_' . $lang->code, !empty($banner->fields->{$field['name']}) ? $banner->fields->{$field['name']}->{$lang->code} : '' ) }}" id="{{ $field['name'] }}" class="input-xlarge"/>
				<span class="add-on"><img src="/packages/simple/cms/img/flags/{{ $lang->code }}.png" alt="{{ $lang->title }}"/></span>
			</div>
			@if ($errors->has($field['name'] . '_' . $lang->code))
			<span class="help-inline error">{{ $errors->first( $field['name'] . '_' . $lang->code) }}</span>
			@endif
		</div>

	@endforeach

</div>