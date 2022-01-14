                                 <div class="kt-form" id="kt_form">
                                        <form id="candidaturesform" class="" method="POST" action="{{ route('candidatures.update', $data->id) }}" enctype="multipart/form-data">
                                        {{ method_field('PUT') }}
                            
                                                <div class="kt-portlet__body">
                                                    <div class="kt-section kt-section--first">
                                                        @php
                                                            $done_groups = [];
                                                        @endphp
                                                        @foreach($fields as $parent)
                                                            @if (isset($parent['group']))
                                                                @if (!(in_array($parent['group'], $done_groups)))
                                                                    @php
                                                                        $done_groups[] = $parent['group'];
                                                                        $done_fields[] = [];
                                                                    @endphp
                                                                        <?php //dd($data->id); ?>
                                                                    <div class="kt-portlet kt-portlet--mobile  {{ $parent['class'] }}" id="{{$parent['name']==='member_id'?'member':$parent['name']}}">
                                                                        <div class="kt-portlet__head">
                                                                            <div class="kt-portlet__head-label">
                                                                                <h3 class="kt-portlet__head-title">
                                                                                    {{ $parent['group'] }}

                                                                                </h3>
                                                                            </div>
                                                                        </div>
                                                                        <div class="kt-portlet__body">
                                                                            @foreach($fields as $child)
                                                                                @if (isset($child['group']) && $child['group'] == $parent['group'])
                                                                                    @if (!isset($child['sub_fields']))
                                                                                        @if (!(in_array($child['name'], $done_fields)))
                                                                                            @php
                                                                                                $done_fields[] = $child['name'];
                                                                                                $child['config']['hotizontalRows'] = true;
                                                                                            @endphp
                                                                                            @include(sprintf('back-office.components.form.fields.%s', $child['type']), $field = $child)
                                                                                        @endif
                                                                                    @else
                                                                                        @foreach($child['sub_fields'] as $subchild)
                                                                                            @if (!(in_array($subchild['name'], $done_fields)))
                                                                                                @php
                                                                                                    $done_fields[] = $subchild['name'];
                                                                                                    $subchild['config']['hotizontalRows'] = true;
                                                                                                    $subchild['parent_name'] = $child['name'];
                                                                                                @endphp
                                                                                                @include(sprintf('back-office.components.form.fields.%s', $subchild['type']), $field = $subchild)
                                                                                            @endif
                                                                                        @endforeach
                                                                                    @endif
                                                                                @endif
                                                                            @endforeach                                                                        
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @csrf
                                        </form>
                                    </div>