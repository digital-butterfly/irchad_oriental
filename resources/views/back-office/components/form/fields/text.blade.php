<label for="{{ $field['name'] }}">{{ $field['label'] }}:</label>
<input type="text" id="{{ $field['name'] }}" name="{{ $field['name'] }}" class="form-control" placeholder="{{ $field['label'] }}" value="{{ $data->{$field['name']} ?? '' }}">
<span class="form-text text-muted"></span>