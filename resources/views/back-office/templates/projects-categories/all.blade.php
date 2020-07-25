@extends('back-office.layouts.layout-default')


@section('specific_css')
<link href="plugins/back-office/custom/jstree/jstree.bundle.css" rel="stylesheet" type="text/css" />
@endsection



@section('page_content')
    <div class="kt-container  kt-grid__item kt-grid__item--fluid">
        @component('back-office.components.portlets.main', ['types' => [''], 'add_link' => 'admin/projects-categories/create'])
            @slot('title')
                Catégories de projets
            @endslot
            @slot('body')
                <div class="kt-portlet__body">
                    <div id="kt_tree_1" class="tree-demo">
                        <ul>
                            @foreach($categories as $category)
                                @if(!$category->parent_id)
                                    <li>
                                        {{ $category->title }}
                                        <ul>
                                            @foreach($categories as $subCategory)
                                                @if($subCategory->parent_id && $subCategory->parent_id == $category->id)
                                                    <li>
                                                        {{ $subCategory->title }}
                                                    </li>
                                                @endif
                                            @endforeach
                                            <li data-jstree='{ "icon" : "fa fa-plus kt-font-success " }'>
                                                <a href="#">Ajouter</a>
                                            </li>
                                        </ul>

                                    </li>
                                @endif
                            @endforeach
                            <!-- <li data-jstree='{ "icon" : "fa fa-plus kt-font-success " }'>
                                <a href="#">Ajouter</a>
                            </li> -->
                        </ul>
                    </div>
                </div>
            @endslot
        @endcomponent
    </div>
@endsection



@section('specific_js')
    <script src="plugins/back-office/custom/jstree/jstree.bundle.js" type="text/javascript"></script>
    <script src="js/back-office/pages/components/extended/treeview.js" type="text/javascript"></script>
@endsection
