                                 <div class="kt-form" id="kt_form">
                                        <form id="candidaturesform" class="" method="POST" action="{{ route('candidature.myfunction', $data->id) }}" enctype="multipart/form-data">
                                        {{ method_field('PUT') }}
                            
                                                <div class="kt-portlet__body">
                                                    <div class="kt-section kt-section--first">
                                                        @php
                                                            $done_groups = [];
                                                        @endphp
                                                     @foreach ($fields as $parent)
                                                        @if (isset($parent['group']))
                                                         @if ($parent['group']=='entreprise_arab' ||$parent['group']=='donne_general_arab' ||$parent['group']=='etude_marche_arab'||$parent['group']=='etude_technique_arab')
                                                            @if (!in_array($parent['group'], $done_groups))
                                                                @php
                                                                    $done_groups[] = $parent['group'];
                                                                    $done_fields[] = [];
                                                                   // 
                                                                @endphp
                                                                <div class="kt-portlet kt-portlet--mobile  text-right  {{ $parent['class'] }}" id="{{ $parent['name'] === 'member_id' ? 'member' : $parent['name'] }}" >
                                                                    <div class="kt-portlet__head"dir="rtl">
                                                                        <div style=" text-align:right;">
                                                                            <h3  >
                                                                                {{ $parent['label'] }}
                                                                            </h3>
                                                                        </div>
                                                                    </div>
                                                                    <div class="kt-portlet__body  " style=" text-align:right;" dir="rtl">
                                                                        @foreach ($fields as $child)
                                                                            @if (isset($child['group']) && $child['group'] == $parent['group'])
                                                                                @if (!isset($child['sub_fields']))
                                                                                    @if (!in_array($child['name'], $done_fields))
                                                                                    @php
                                                                                   
                                                                                        $done_fields[] = $child['name'];
                                                                                        $child['config']['hotizontalRows'] = true;
                                                                                    @endphp
                                                                                    @include(sprintf('back-office.components.form.fields.%s', $child['type']), $field = $child)
                                                                                @endif
                                                                                @else
                                                                                    @foreach ($child['sub_fields'] as $subchild)
                                                                                        @if (!in_array($subchild['name'], $done_fields))
                                                                                            @php
                                                                                          //   dd( $subchild);
                                                                                                $done_fields[] = $subchild['name'];
                                                                                                $subchild['config']['hotizontalRows'] = true;
                                                                                                $subchild['parent_name'] = $child['name'];
                                                                                            @endphp
                                                                                            @include(sprintf('back-office.components.form.fields.%s', $subchild['type']), $field = $subchild)                                                                                        @endif
                                                                                    @endforeach
                                                                                @endif
                                                                            @endif
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            @endif
                                                              @endif
                                                        @endif
                                                    @endforeach
                                                     <div class="kt-portlet__foot sticky-save">
                                                <div class="kt-form__actions">
                                                    <button type="submit" class="btn btn-primary kt-align-center">Enregistrer les modifications</button>
                                                </div>
                                                 @csrf 
                                                </form>