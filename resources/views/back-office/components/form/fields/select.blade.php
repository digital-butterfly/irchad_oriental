@php
    $field_value = '';
    if (isset($data)) {
        if(isset($field['group']) && isset($data[$field['group']]) && isset(get_object_vars($data[$field['group']])[$field['name'].'-autre']))
        $field_value=get_object_vars($data[$field['group']])[$field['name'].'-autre'];
        
    }
@endphp
<div class="form-group {{ (isset($field['config']) && $field['config']['hotizontalRows']) ? 'row' : '' }}">

    <label for="{{ $field['name'] }}" class="{{ (isset($field['config']) && $field['config']['hotizontalRows']) ? 'col-lg-3 col-form-label' : '' }}">{{ $field['label'] }}</label>
    <div class="{{ (isset($field['config']) && $field['config']['hotizontalRows']) ? 'col-lg-6' : 'w-100' }}">
        <select class="form-control {{isset($field['error']) ? 'is-invalid' : ''}}" name="{{ $field['name'] }}" id="{{ $field['name'] }}Select" onchange="$(this).val()==='Autre' || $(this).val()==42 || $(this).val()==58 || $(this).val()==61 || $(this).val()==71 || $(this).val()==68 || $(this).val()==74 || $(this).val()==86 || $(this).val()==91 || $(this).val()==95?$(this).closest('.form-group').find('.pi').show():$(this).closest('.form-group').find('.pi').hide()">
            @php
                $counter = 0;
            @endphp
            @foreach($fields as $key)
                @php
                    $ref = $key['name'];
                @endphp
                @if ($key['type'] == 'select' && $key['name'] == $field['name'])
                    <div class="form-group">
                        <option value="">---</option>
                        @foreach($key['options'] as $option)
                            @if (isset($option->childs))
                                <optgroup label="{{ $option->title }}">
                                    @if (!empty($option->childs))
                                        @foreach($option->childs as $option)
                                            <option value="{{ $option->id ?? ($option->title ?? $option) }}"

                                            @if (old($field['name'])))
                                                @if (isset($option->id))
                                                    {{ old($field['name']) == $option->id ? 'selected' : '' }}
                                                @elseif (isset($option->title))
                                                    {{ old($field['name']) == $option->title ? 'selected' : '' }}
                                                @else
                                                    {{ old($field['name']) == $option ? 'selected' : '' }}
                                                @endif
                                            @elseif (isset($data->$ref))
                                                @if (isset($option->id))
                                                    {{ $data->$ref == $option->id ? 'selected' : '' }}
                                                @elseif (isset($option->title))
                                                    {{ $data->$ref == $option->title ? 'selected' : '' }}
                                                @else
                                                    {{ $data->$ref == $option ? 'selected' : '' }}
                                                @endif
                                            @endif

                                            >{{ $option->title ?? $option }}</option>
                                        @endforeach
                                    @endif
                                </optgroup>
                            @else
                                <option value="{{ $option->id ?? ($option->title ?? $option) }}"

                                    @if (old($field['name']))
                                        @if (isset($option->id))
                                            {{ old($field['name']) == $option->id ? 'selected' : '' }}
                                        @elseif (isset($option->title))
                                            {{ old($field['name']) == $option->title ? 'selected' : '' }}
                                        @else
                                            {{ old($field['name']) == $option ? 'selected' : '' }}
                                        @endif
                                    @elseif (isset($data->$ref))
                                        @if (isset($option->id))
                                            {{ $data->$ref == $option->id ? 'selected' : '' }}
                                        @elseif (isset($option->title))
                                            {{ $data->$ref == $option->title ? 'selected' : '' }}
                                        @else
                                            {{ $data->$ref == $option ? 'selected' : '' }}
                                        @endif
                                    @endif


                                >{{ $option->title ?? $option }}</option>
                            @endif
                        @endforeach
                    </div>
                @elseif ($key['type'] == 'section')
                    @foreach ($key['sub_fields'] as $subfield)
                        @if ($subfield['type'] == 'select' && $subfield['name'] == $field['name'])
                            <div class="form-group">
                                <option value="">---</option>
                                @foreach($subfield['options'] as $option)
                                    @php
                                        $sub_ref = $subfield['name'];
                                    @endphp
                                    @if (isset($option->childs))
                                        <optgroup label="{{ $option->title }}">
                                            @if (!empty($option->childs))
                                                @foreach($option->childs as $option)
                                                    <option value="{{ $option->id ?? ($option->title ?? $option) }}"

                                                        @if (old($field['name']))
                                                            @if (isset($option->id))
                                                                {{ old($field['name']) == $option->id ? 'selected' : '' }}
                                                            @elseif (isset($option->title))
                                                                {{ old($field['name']) == $option->title ? 'selected' : '' }}
                                                            @else
                                                                {{ old($field['name']) == $option ? 'selected' : '' }}
                                                            @endif
                                                        @elseif (isset($data->$ref))
                                                            @if (isset($option->id))
                                                                {{ $data->$ref == $option->id ? 'selected' : '' }}
                                                            @elseif (isset($option->title))
                                                                {{ $data->$ref == $option->title ? 'selected' : '' }}
                                                            @else
                                                                {{ $data->$ref == $option ? 'selected' : '' }}
                                                            @endif
                                                        @endif

                                                    >{{ $option->title ?? $option }}</option>
                                                @endforeach
                                            @endif
                                        </optgroup>
                                    @else
                                        <option value="{{ $option->id ?? ($option->title ?? $option) }}"

                                        @if (old($field['name']))
                                            @if (isset($option->id))
                                                {{ old($field['name']) == $option->id ? 'selected' : '' }}
                                            @elseif (isset($option->title))
                                                {{ old($field['name']) == $option->title ? 'selected' : '' }}
                                            @else
                                                {{ old($field['name']) == $option ? 'selected' : '' }}
                                            @endif
                                        @elseif (isset($data->$ref->$sub_ref))
                                            @if (isset($option->id))
                                                {{ $data->$ref->$sub_ref == $option->id ? 'selected' : '' }}
                                            @elseif (isset($option->title))
                                                {{ $data->$ref->$sub_ref == $option->title ? 'selected' : '' }}
                                            @else
                                                {{ $data->$ref->$sub_ref == $option ? 'selected' : '' }}
                                            @endif
                                        @elseif (isset($data->$ref))
                                            @if (isset($option->id))
                                                {{ $data->$ref == $option->id ? 'selected' : '' }}
                                            @elseif (isset($option->title))
                                                {{ $data->$ref == $option->title ? 'selected' : '' }}
                                            @else
                                                {{ $data->$ref == $option ? 'selected' : '' }}
                                            @endif
                                        @endif

                                        >{{ $option->title ?? $option }}</option>

                                    @endif
                                @endforeach
                            </div>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </select>
        @if(isset($data))
        <input type="text" id="{{ $field['name'] }}-autre" name="{{ $field['name'] }}-autre"  class="pi form-control hi" placeholder=""  style="display: none" value="{{ (old($field['name']) ?? $field_value) ? (old($field['name']) ?? $field_value) :$data['category_id-autre']}}">
        <span class="form-text text-muted"></span>
        @endif
    </div>
</div>
<script>
/*let variable = document.getElementById('project_ideaSelect');
console.log(variable)
 $('#').load(function(){
    console.log("hello")
})*/

window.addEventListener("load", function(event) {
    var x = document.getElementById('{{ $field['name'] }}-autre');
    var select = document.getElementById('{{ $field['name'] }}Select');
// select.options[select.selectedIndex].value==='Autre' || select.options[select.selectedIndex].value==='Autre - Agriculture' || select.options[select.selectedIndex].value==='Autre - Artisanat' || select.options[select.selectedIndex].value==='Autre -  Pêche' || $(this).val()==='Autre - Commerce' || $(this).val()==='Autre - Tourisme-CHR' || $(this).val()==='Autre - Transport ' || $(this).val()==='Autre - Service' || $(this).val()==='Autre - Education'
  console.log('{{$field['name']}}')
  if (select.options[select.selectedIndex].value=='Autre' || select.options[select.selectedIndex].value==42|| select.options[select.selectedIndex].value==58|| select.options[select.selectedIndex].value==61||select.options[select.selectedIndex].value==95|| $(this).val()==71 || $(this).val()==68 || $(this).val()==74 || $(this).val()==86 || $(this).val()==91 || $(this).val()==95) {
    x.style.display = 'block';
  } else {
    x.style.display = 'none';
  }
  });
//   window.addEventListener("load", function(event) {
//     var x = document.getElementById('informal_activity_desc');
//    if ( document.querySelector('#chomageSelect').value=='Oui' ) {
//     x.style.display = 'block';
//   }else{
//     x.style.display = 'none'; 
// }
//   })
// element.addEventListener('change',function () {
// var x = document.getElementById('informal_activity_desc');
//   if(this.value=='Oui'){
//     x.style.display = 'block'; 
// }else{
//     x.style.display = 'none'; 
// }
//   })
</script>