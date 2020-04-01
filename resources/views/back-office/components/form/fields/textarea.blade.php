<div class="form-group {{ (isset($field['config']) && $field['config']['hotizontalRows']) ? 'row' : '' }}">
    <label for="{{ $field['name'] }}" class="{{ (isset($field['config']) && $field['config']['hotizontalRows']) ? 'col-lg-3 col-form-label' : '' }}">{{ $field['label'] }}:</label>
    <div class="{{ (isset($field['config']) && $field['config']['hotizontalRows']) ? 'col-lg-6' : 'w-100' }}">
        <textarea id="{{ $field['name'] }}" name="{{ $field['name'] }}"  class="form-control" placeholder="{{ $field['label'] }}" rows="3">{{ $data->{$field['name']} ?? '' }}</textarea>
        <span class="form-text text-muted"></span>
    </div>
</div>