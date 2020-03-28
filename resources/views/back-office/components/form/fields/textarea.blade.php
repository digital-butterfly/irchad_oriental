<label for="{{ $field['name'] }}">{{ $field['label'] }}:</label>
<textarea id="{{ $field['name'] }}" name="{{ $field['name'] }}"  class="form-control" placeholder="{{ $field['label'] }}" value="{{ $data->{$field['name']} ?? '' }}" rows="3"></textarea>
<span class="form-text text-muted"></span>