@extends('admin.layouts.master')
@section('content')
<!-- role mang editor--> 		
@php $values = explode(',',optional(auth()->user())->posttypes_id); @endphp
@foreach($values as $vid) 
    @if($vid)  							
        @if(optional(auth()->user())->role == 111 || $vid == $posttypeSlug->id)
            @php $result = $vid; @endphp
            @break
        @endif											   
    @endif
@endforeach 
@php $result = $vid ?? ''; @endphp
<!-- role mang editor--> 

@if(optional(auth()->user())->role == 111 || $result == $posttypeSlug->id && optional(auth()->user())->create == "create")

<h5 class="h5 mb-2 text-gray-800"><a href="{{ url('/dashboard/posttypes/')}}/{{ collect(request()->segments())->last() }}"><i class="fa fa-arrow-left" aria-hidden="true"></i></a> Back</h5>

<form class="user" action="{{ url('/dashboard/posts/posttypes') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row">    

        <!-- Area Chart -->
        <div class="col-xl-9 col-lg-8">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Create a {{ collect(request()->segments())->last() }}!</h6>                
                </div>
                <!-- Card Body -->
                <div class="card-body">

                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0">
                            @if($posttypeSlug->title != "#")                        
                            <input type="text" name='title' class="form-control form-control-user labelBalloon" id="exampleFirstName"
                                placeholder="{{ $posttypeSlug->title }}"><label for="exampleFirstName">{{ $posttypeSlug->title }}</label>
                            @else                                  
                            <input type="hidden" name='title' value="Untitled" class="form-control form-control-user" id="exampleFirstName"
                                placeholder="">
                            @endif                            
                        </div> 
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0">
                            <input type="hidden" name='user_id' class="form-control form-control-user" id="exampleFirstName"
                                placeholder="user" value="@auth(){{ optional(auth()->user())->id}}@endauth">
                        </div> 
                    </div>
                    <!-- editor -->
                    @if($posttypeSlug->content != "#")
                        <!-- choose editor  -->
                        @if($settingsAdmin->editor == "classic")
                        <!-- editor 1-->
                            <!-- <textarea name="content"></textarea>   -->

                            <!-- ---------------Block System-------------------  -->
                            <p class="mb-2 text-primary">{{$posttypeSlug->content}}</a>
                            <div id="blockArea"></div>  
                            <div class="text-center">
                                <button type="button" class="btn btn-primary btn-user btn-block" onclick="addBlock()">➕ Add Editor for {{$posttypeSlug->content}}</button>                                
                            </div>

                            <input type="hidden" name="content" id="contentIF">
                            <script>
                            let blocks = [];

                            function addBlock(html = '') {
                                blocks.push(html);
                                renderBlocks();
                            }

                            function renderBlocks() {
                                const area = document.getElementById('blockArea');
                                area.innerHTML = '';

                                blocks.forEach((content, index) => {
                                    area.innerHTML += `
                                    <div style="border:1px solid #ddd;padding:10px;margin-bottom:10px">
                                        <textarea class="editor" data-index="${index}">
                                            ${content}
                                        </textarea>
                                        <br>
                                        <div class="gap-1">
                                            <a href="javascript:void(0)" role="button" class="btn btn-outline-secondary btn-sm" onclick="moveUp(${index})">
                                                <i class="bi bi-arrow-up"></i> ↑
                                            </a>
                                            <a href="javascript:void(0)" role="button" class="btn btn-outline-secondary btn-sm" onclick="moveDown(${index})">
                                                <i class="bi bi-arrow-down"></i> ↓
                                            </a>
                                            <a href="javascript:void(0)" role="button" class="btn btn-danger btn-sm" onclick="removeBlock(${index})">
                                                Delete
                                            </a>
                                        </div>
                                    </div>`;
                                });

                                document.getElementById('contentIF').value =
                                    blocks.map(b => `<!--block-->${b}`).join('');

                                initTiny();
                            }

                            function removeBlock(i) {
                                blocks.splice(i, 1);
                                renderBlocks();
                            }

                            function moveUp(i) {
                                if (i === 0) return;
                                [blocks[i], blocks[i-1]] = [blocks[i-1], blocks[i]];
                                renderBlocks();
                            }

                            function moveDown(i) {
                                if (i === blocks.length - 1) return;
                                [blocks[i], blocks[i+1]] = [blocks[i+1], blocks[i]];
                                renderBlocks();
                            }
                            </script>
                            <script>
                            function initTiny() {
                                // Only remove the dynamic block editors, keep global editor intact
                                tinymce.remove('.editor');

                                tinymce.init({
                                    selector: '.editor',
                                    height: 550,
                                    directionality: '',
                                    /* language: '', */
                                    plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount textpattern noneditable help charmap emoticons', // imagetools, quickbars
                                    imagetools_cors_hosts: ['picsum.photos'],
                                    menubar: 'file edit view insert format tools table help',
                                    toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
                                    toolbar_sticky: false,
                                    document_base_url: '{{url('/')}}',
                                    relative_urls: true,
                                    convert_urls: false,
                                    valid_elements : '*[*]',
                                    toolbar_mode: 'sliding',
                                    forced_root_block: '', // disables automatic <p> wrapping
                                    file_picker_callback(callback, value, meta) {
                                        let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth
                                        let y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight

                                        tinymce.activeEditor.windowManager.openUrl({
                                            url: '{{url('/dashboard/mediamanager')}}',
                                            title: '{{ __("Media Library") }}',
                                            width: x * 0.8,
                                            height: y * 0.8,
                                            onMessage: (api, message) => {
                                                callback(message.content, {text: message.text})
                                            }
                                        })
                                    },
                                    setup: function (editor) {
                                        editor.on('keyup change', function () {
                                            const i = editor.getElement().dataset.index;
                                            blocks[i] = editor.getContent();
                                            document.getElementById('contentIF').value =
                                                blocks.map(b => `<!--block-->${b}`).join('');
                                        });
                                    }
                                });
                            }
                            </script>
                            <!-- ---------------Block System-------------------  -->

                        @else
                        <!-- editor 2-->                
                        <textarea id="html" name="content"></textarea>
                        <textarea id="css" name="content_css"></textarea>                
                        <div id="gjs" style="height:500px !important;"></div>                      
                        @endif  
                    @endif


                </div>
            </div>

            @php
                $excerpt = $posttypeSlug->excerpt ?? [];
                $option_1 = $posttypeSlug->option_1 ?? [];                
                $option_2 = $posttypeSlug->option_2 ?? [];             
                $option_3 = $posttypeSlug->option_3 ?? [];             
                $option_4 = $posttypeSlug->option_4 ?? [];
            @endphp

            @if($excerpt['type'] != "none" || $option_1['type'] != "none" || $option_2['type'] != "none" || $option_3['type'] != "none" || $option_4['type'] != "none")
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">More Fields for {{ collect(request()->segments())->last() }}</h6>                
                </div>
                <!-- Card Body -->
                <div class="card-body">

                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0">
                        <!-- for excerpt -->
                        @php                                                        
                            $values = explode(',', $excerpt['values'] ?? '');
                        @endphp

                        @if($excerpt['type'] == "select") 
                            <label>{{ $excerpt['label'] ?? 'Select Option' }}</label>
                            <select name="excerpt" class="form-control form-control-user form-select form-select-sm custom-select" {{ $excerpt['required'] == 1 ? 'required':'' }}>
                                <option value="">Choose</option>
                                @foreach($values as $value)
                                    <option value="{{ trim($value) }}">{{ trim($value) }}</option>
                                @endforeach
                            </select>   
                        @elseif ($excerpt['type'] == "checkbox")  
                            <label>{{ $excerpt['label'] ?? 'Select Option' }}</label>
                            @foreach($values as $value)
                                <div class="form-check">                        
                                    <input class="form-check-input" type="checkbox" value="{{ trim($value) }}" id="defaultCheck{{ trim($value) }}" name="excerpt[]" {{ $excerpt['required'] == 1 ? 'required':'' }}>
                                    <label class="form-check-label" for="defaultCheck{{ trim($value) }}">{{ trim($value) }}</label>
                                </div>                                    
                            @endforeach    
                        
                        @elseif ($excerpt['type'] == "radio")  
                            <label>{{ $excerpt['label'] ?? 'Select Option' }}</label>
                            @foreach($values as $value)
                                <div class="form-check">                        
                                    <input class="form-check-input" type="radio" value="{{ trim($value) }}" id="defaultCheck{{ trim($value) }}" name="excerpt[]" {{ $excerpt['required'] == 1 ? 'required':'' }}>
                                    <label class="form-check-label" for="defaultCheck{{ trim($value) }}">{{ trim($value) }}</label>
                                </div>                                    
                            @endforeach  

                        @elseif ($excerpt['type'] == "image")  
                            <label>{{ $excerpt['label'] ?? 'Select Option' }}</label>
                            
                            <div class="form-group"> 
                                <input type="hidden" id="excerpt_type" name='excerpt' placeholder="Image Url" class="form-control" {{ $excerpt['required'] == 1 ? 'required':'' }} >
                                <img id="excerpt" src="{{ asset('packages/larapress/src/Assets/admin/img/dummy-image-square.jpg') }}" width="20%" height="auto" data-toggle="modal" data-target="#exampleModalCenter" class="border border-info" data-preview="excerpt">
                                 
                            </div>
                            <button type="button" onclick="removeValue('{{url('/packages/larapress/src/Assets/admin/img/dummy-image-square.jpg')}}', 'excerpt')" class="btn btn-secondary btn-sm">Remove Images</button>  
                        @elseif ($excerpt['type'] == "none") 
                        @elseif ($excerpt['type'] == "posttype") 
                            <label>{{ $excerpt['label'] ?? 'Select Option' }}</label>
                            <select name="excerpt[]" class="form-select form-select-sm custom-select" {{ $excerpt['required'] == 1 ? 'required':'' }} multiple>
                                    <option value="">Choose</option>
                                    @foreach(getPostsByType($excerpt['values'],'all') as $value) 
                                        <option value="{{ $value->slug }}">{{ trim($value->title) }}</option>
                                    @endforeach
                            </select> 
                              
                        @else
                            <input type="{{ $excerpt['type'] }}" name='excerpt' class="form-control form-control-user labelBalloon" style="{{ $excerpt['type'] == 'color' ? 'padding:5px':'' }}" id="excerpt" placeholder="{{ $excerpt['values'] }}" {{ $excerpt['required'] == 1 ? 'required':'' }}>
                            <label for="excerpt">{{ $excerpt['label'] }}</label> 
                        @endif
                        <!-- for excerpt -->                    

                        </div> 
                    </div> 
                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0">
                            
                            <!-- for option_1 -->
                            @php                                                        
                                $option_1_values = explode(',', $option_1['values'] ?? '');
                            @endphp

                            @if($option_1['type'] == "select") 
                                <label>{{ $option_1['label'] ?? 'Select Option' }}</label>
                                <select name="option_1" class="form-control form-control-user form-select form-select-sm custom-select" {{ $option_1['required'] == 1 ? 'required':'' }}>
                                    <option value="">Choose</option>
                                    @foreach($option_1_values as $value)
                                        <option value="{{ trim($value) }}">{{ trim($value) }}</option>
                                    @endforeach
                                </select>   
                            @elseif ($option_1['type'] == "checkbox")  
                                <label>{{ $option_1['label'] ?? 'Select Option' }}</label>
                                @foreach($option_1_values as $value)
                                    <div class="form-check">                        
                                        <input class="form-check-input" type="checkbox" value="{{ trim($value) }}" id="defaultCheck{{ trim($value) }}" name="option_1[]" {{ $option_1['required'] == 1 ? 'required':'' }}>
                                        <label class="form-check-label" for="defaultCheck{{ trim($value) }}">{{ trim($value) }}</label>
                                    </div>                                    
                                @endforeach    
                            
                            @elseif ($option_1['type'] == "radio")  
                                <label>{{ $option_1['label'] ?? 'Select Option' }}</label>
                                @foreach($option_1_values as $value)
                                    <div class="form-check">                        
                                        <input class="form-check-input" type="radio" value="{{ trim($value) }}" id="defaultCheck{{ trim($value) }}" name="option_1[]" {{ $option_1['required'] == 1 ? 'required':'' }}>
                                        <label class="form-check-label" for="defaultCheck{{ trim($value) }}">{{ trim($value) }}</label>
                                    </div>                                    
                                @endforeach  

                            @elseif ($option_1['type'] == "image")  
                                <label>{{ $option_1['label'] ?? 'Select Option' }}</label>
                                
                                <div class="form-group"> 
                                    <input type="hidden" id="option_1_type" name='option_1' placeholder="Image Url" class="form-control" {{ $option_1['required'] == 1 ? 'required':'' }} >
                                    <img id="option_1" src="{{ asset('packages/larapress/src/Assets/admin/img/dummy-image-square.jpg') }}" width="20%" height="auto" data-toggle="modal" data-target="#exampleModalCenter" class="border border-info" data-preview="option_1">
                                    
                                </div>
                                <button type="button" onclick="removeValue('{{url('/packages/larapress/src/Assets/admin/img/dummy-image-square.jpg')}}', 'option_1')" class="btn btn-secondary btn-sm">Remove Images</button>  
                            @elseif ($option_1['type'] == "none")  
                            
                            @elseif ($option_1['type'] == "posttype") 
                                <label>{{ $option_1['label'] ?? 'Select Option' }}</label>
                                <select name="option_1[]" class="form-select form-select-sm custom-select" {{ $option_1['required'] == 1 ? 'required':'' }} multiple>
                                        <option value="">Choose</option>
                                        @foreach(getPostsByType($option_1['values'],'all') as $value) 
                                            <option value="{{ $value->slug }}">{{ trim($value->title) }}</option>
                                        @endforeach
                                </select> 
                            @else
                                <input type="{{ $option_1['type'] }}" name='option_1' class="form-control form-control-user labelBalloon" style="{{ $option_1['type'] == 'color' ? 'padding:5px':'' }}" id="option_1" placeholder="{{ $option_1['values'] }}" {{ $option_1['required'] == 1 ? 'required':'' }}>
                                <label for="option_1">{{ $option_1['label'] }}</label> 
                            @endif
                            <!-- for option_1 -->      
                        </div> 
                    </div> 


                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0">
                        
                            <!-- for option_2 -->
                            @php                                                        
                                $option_2_values = explode(',', $option_2['values'] ?? '');
                            @endphp

                            @if($option_2['type'] == "select") 
                                <label>{{ $option_2['label'] ?? 'Select Option' }}</label>
                                <select name="option_2" class="form-control form-control-user form-select form-select-sm custom-select" {{ $option_2['required'] == 1 ? 'required':'' }}>
                                    <option value="">Choose</option>
                                    @foreach($option_2_values as $value)
                                        <option value="{{ trim($value) }}">{{ trim($value) }}</option>
                                    @endforeach
                                </select>   
                            @elseif ($option_2['type'] == "checkbox")  
                                <label>{{ $option_2['label'] ?? 'Select Option' }}</label>
                                @foreach($option_2_values as $value)
                                    <div class="form-check">                        
                                        <input class="form-check-input" type="checkbox" value="{{ trim($value) }}" id="defaultCheck{{ trim($value) }}" name="option_2[]" {{ $option_2['required'] == 1 ? 'required':'' }}>
                                        <label class="form-check-label" for="defaultCheck{{ trim($value) }}">{{ trim($value) }}</label>
                                    </div>                                    
                                @endforeach    
                            
                            @elseif ($option_2['type'] == "radio")  
                                <label>{{ $option_2['label'] ?? 'Select Option' }}</label>
                                @foreach($option_2_values as $value)
                                    <div class="form-check">                        
                                        <input class="form-check-input" type="radio" value="{{ trim($value) }}" id="defaultCheck{{ trim($value) }}" name="option_2[]" {{ $option_2['required'] == 1 ? 'required':'' }}>
                                        <label class="form-check-label" for="defaultCheck{{ trim($value) }}">{{ trim($value) }}</label>
                                    </div>                                    
                                @endforeach  

                            @elseif ($option_2['type'] == "image")  
                                <label>{{ $option_2['label'] ?? 'Select Option' }}</label>
                                
                                <div class="form-group"> 
                                    <input type="hidden" id="option_2_type" name='option_2' placeholder="Image Url" class="form-control" {{ $option_2['required'] == 1 ? 'required':'' }} >
                                    <img id="option_2" src="{{ asset('packages/larapress/src/Assets/admin/img/dummy-image-square.jpg') }}" width="20%" height="auto" data-toggle="modal" data-target="#exampleModalCenter" class="border border-info" data-preview="option_2">
                                    
                                </div>
                                <button type="button" onclick="removeValue('{{url('/packages/larapress/src/Assets/admin/img/dummy-image-square.jpg')}}', 'option_2')" class="btn btn-secondary btn-sm">Remove Images</button>  
                            @elseif ($option_2['type'] == "none")                             
                            
                            @elseif ($option_2['type'] == "posttype") 
                                <label>{{ $option_2['label'] ?? 'Select Option' }}</label>
                                <select name="option_2[]" class="form-select form-select-sm custom-select" {{ $option_2['required'] == 1 ? 'required':'' }} multiple>
                                        <option value="">Choose</option>
                                        @foreach(getPostsByType($option_2['values'],'all') as $value) 
                                            <option value="{{ $value->slug }}">{{ trim($value->title) }}</option>
                                        @endforeach
                                </select>  
                            @else
                                <input type="{{ $option_2['type'] }}" name='option_2' class="form-control form-control-user labelBalloon" style="{{ $option_2['type'] == 'color' ? 'padding:5px':'' }}" id="option_2" placeholder="{{ $option_2['values'] }}" {{ $option_2['required'] == 1 ? 'required':'' }}>
                                <label for="option_2">{{ $option_2['label'] }}</label> 
                            @endif
                            <!-- for option_2 -->
                        </div> 
                    </div> 
                    
                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0">
                        <!-- for option_3 -->
                            @php                                                        
                                $option_3_values = explode(',', $option_3['values'] ?? '');
                            @endphp

                            @if($option_3['type'] == "select") 
                                <label>{{ $option_3['label'] ?? 'Select Option' }}</label>
                                <select name="option_3" class="form-control form-control-user form-select form-select-sm custom-select" {{ $option_3['required'] == 1 ? 'required':'' }}>
                                    <option value="">Choose</option>
                                    @foreach($option_3_values as $value)
                                        <option value="{{ trim($value) }}">{{ trim($value) }}</option>
                                    @endforeach
                                </select>   
                            @elseif ($option_3['type'] == "checkbox")  
                                <label>{{ $option_3['label'] ?? 'Select Option' }}</label>
                                @foreach($option_3_values as $value)
                                    <div class="form-check">                        
                                        <input class="form-check-input" type="checkbox" value="{{ trim($value) }}" id="defaultCheck{{ trim($value) }}" name="option_3[]" {{ $option_3['required'] == 1 ? 'required':'' }}>
                                        <label class="form-check-label" for="defaultCheck{{ trim($value) }}">{{ trim($value) }}</label>
                                    </div>                                    
                                @endforeach    
                            
                            @elseif ($option_3['type'] == "radio")  
                                <label>{{ $option_3['label'] ?? 'Select Option' }}</label>
                                @foreach($option_3_values as $value)
                                    <div class="form-check">                        
                                        <input class="form-check-input" type="radio" value="{{ trim($value) }}" id="defaultCheck2{{ trim($value) }}" name="option_3[]" {{ $option_3['required'] == 1 ? 'required':'' }}>
                                        <label class="form-check-label" for="defaultCheck2{{ trim($value) }}">{{ trim($value) }}</label>
                                    </div>                                    
                                @endforeach  

                            @elseif ($option_3['type'] == "image")  
                                <label>{{ $option_3['label'] ?? 'Select Option' }}</label>
                                
                                <div class="form-group"> 
                                    <input type="hidden" id="option_3_type" name='option_3' placeholder="Image Url" class="form-control" {{ $option_3['required'] == 1 ? 'required':'' }} >
                                    <img id="option_3" src="{{ asset('packages/larapress/src/Assets/admin/img/dummy-image-square.jpg') }}" width="20%" height="auto" data-toggle="modal" data-target="#exampleModalCenter" class="border border-info" data-preview="option_3">
                                    
                                </div>
                                <button type="button" onclick="removeValue('{{url('/packages/larapress/src/Assets/admin/img/dummy-image-square.jpg')}}', 'option_3')" class="btn btn-secondary btn-sm">Remove Images</button>  
                            @elseif ($option_3['type'] == "none")                            
                              
                            @elseif ($option_3['type'] == "posttype") 
                                <label>{{ $option_3['label'] ?? 'Select Option' }}</label>
                                <select name="option_3[]" class="form-select form-select-sm custom-select" {{ $option_3['required'] == 1 ? 'required':'' }} multiple>
                                        <option value="">Choose</option>
                                        @foreach(getPostsByType($option_3['values'],'all') as $value) 
                                            <option value="{{ $value->slug }}">{{ trim($value->title) }}</option>
                                        @endforeach
                                </select> 
                            
                            @else
                                <input type="{{ $option_3['type'] }}" name='option_3' class="form-control form-control-user labelBalloon" style="{{ $option_3['type'] == 'color' ? 'padding:5px':'' }}" id="option_3" placeholder="{{ $option_3['values'] }}" {{ $option_3['required'] == 1 ? 'required':'' }}>
                                <label for="option_3">{{ $option_3['label'] }}</label> 
                            @endif
                            <!-- for option_3 -->
                        </div> 
                    </div> 
                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0">
                        <!-- for option_4 -->
                            @php                                                        
                                $option_4_values = explode(',', $option_4['values'] ?? '');
                            @endphp

                            @if($option_4['type'] == "select") 
                                <label>{{ $option_4['label'] ?? 'Select Option' }}</label>
                                <select name="option_4" class="form-control form-control-user form-select form-select-sm custom-select" {{ $option_4['required'] == 1 ? 'required':'' }}>
                                    <option value="">Choose</option>
                                    @foreach($option_4_values as $value)
                                        <option value="{{ trim($value) }}">{{ trim($value) }}</option>
                                    @endforeach
                                </select>   
                            @elseif ($option_4['type'] == "checkbox")  
                                <label>{{ $option_4['label'] ?? 'Select Option' }}</label>
                                @foreach($option_4_values as $value)
                                    <div class="form-check">                        
                                        <input class="form-check-input" type="checkbox" value="{{ trim($value) }}" id="defaultCheck{{ trim($value) }}" name="option_4[]" {{ $option_4['required'] == 1 ? 'required':'' }}>
                                        <label class="form-check-label" for="defaultCheck{{ trim($value) }}">{{ trim($value) }}</label>
                                    </div>                                    
                                @endforeach    
                            
                            @elseif ($option_4['type'] == "radio")  
                                <label>{{ $option_4['label'] ?? 'Select Option' }}</label>
                                @foreach($option_4_values as $value)
                                    <div class="form-check">                        
                                        <input class="form-check-input" type="radio" value="{{ trim($value) }}" id="defaultCheck{{ trim($value) }}" name="option_4[]" {{ $option_4['required'] == 1 ? 'required':'' }}>
                                        <label class="form-check-label" for="defaultCheck{{ trim($value) }}">{{ trim($value) }}</label>
                                    </div>                                    
                                @endforeach  

                            @elseif ($option_4['type'] == "image")  
                                <label>{{ $option_4['label'] ?? 'Select Option' }}</label>
                                
                                <div class="form-group"> 
                                    <input type="hidden" id="option_4_type" name='option_4' placeholder="Image Url" class="form-control" {{ $option_4['required'] == 1 ? 'required':'' }} >
                                    <img id="option_4" src="{{ asset('packages/larapress/src/Assets/admin/img/dummy-image-square.jpg') }}" width="20%" height="auto" data-toggle="modal" data-target="#exampleModalCenter" class="border border-info" data-preview="option_4">
                                    
                                </div>
                                <button type="button" onclick="removeValue('{{url('/packages/larapress/src/Assets/admin/img/dummy-image-square.jpg')}}', 'option_4')" class="btn btn-secondary btn-sm">Remove Images</button>  
                            @elseif ($option_4['type'] == "none")  
                            @elseif ($option_4['type'] == "posttype") 
                                <label>{{ $option_4['label'] ?? 'Select Option' }}</label>
                                <select name="option_4[]" class="form-select form-select-sm custom-select" {{ $option_4['required'] == 1 ? 'required':'' }} multiple>
                                        <option value="">Choose</option>
                                        @foreach(getPostsByType($option_4['values'],'all') as $value) 
                                            <option value="{{ $value->slug }}">{{ trim($value->title) }}</option>
                                        @endforeach
                                </select>
                                 
                            @else
                                <input type="{{ $option_4['type'] }}" name='option_4' class="form-control form-control-user labelBalloon" style="{{ $option_4['type'] == 'color' ? 'padding:5px':'' }}" id="option_4" placeholder="{{ $option_4['values'] }}" {{ $option_4['required'] == 1 ? 'required':'' }}>
                                <label for="option_4">{{ $option_4['label'] }}</label> 
                            @endif
                            <!-- for option_4 -->
                        </div> 
                    </div> 

                </div>
            </div>
            @endif

            @if($posttypeSlug->more_option_1 != "#" || $posttypeSlug->more_option_2 != "#")
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">More Fields for {{ collect(request()->segments())->last() }}</h6>                
                </div>
                <!-- Card Body -->
                <div class="card-body">

                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0"> 
                            @if($posttypeSlug->more_option_1 != "#")
                                <!-- <input type="text" name='more_option_1' class="form-control form-control-user labelBalloon" id="more_option_1" placeholder="{{$posttypeSlug->more_option_1}}"> 
                            <label for="more_option_1">{{ $posttypeSlug->more_option_1 }}</label>  -->


                            <!-- ---------------Block System------------------- -->
                            <p class="mb-2 text-primary">{{$posttypeSlug->more_option_1}}</p>
                            <div id="blockAreaNew"></div>

                            <div class="text-center mt-2">
                                <button type="button" class="btn btn-primary btn-user btn-block" onclick="openBlockModal()">
                                    ➕ Add Multi Block for {{$posttypeSlug->more_option_1}}
                                </button>
                            </div>

                            <input type="hidden" name="more_option_1" id="contentIFNew">

                            <!-- Type Picker Modal -->
                            <div id="blockTypeModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.45);z-index:9999;align-items:center;justify-content:center;">
                                <div style="background:#fff;border-radius:12px;padding:24px;width:400px;box-shadow:0 8px 32px rgba(0,0,0,.15)">
                                    <h6 class="mb-1 fw-semibold">Choose block type</h6>
                                    <p class="text-muted small mb-3">Select the kind of content to add</p>
                                    <div class="row g-2 mb-3" id="typePickerGrid">
                                        <!-- filled by JS -->
                                    </div>
                                    <div class="d-flex gap-2 justify-content-end">
                                        <p class="btn btn-outline-secondary btn-sm mr-2" onclick="closeBlockModal()">Cancel</p>
                                        <p class="btn btn-primary btn-sm" onclick="confirmBlock()">Add Block</p>
                                    </div>
                                </div>
                            </div>

                            <script>
                            let blocksNew = [];
                            let selectedBlockType = null;
                            let blockIdCounter = 0;

                            const BLOCK_TYPES = [
                                { type: 'text',     label: 'Text',        icon: '🔤', badge: 'primary' },
                                { type: 'textarea', label: 'Rich Editor',  icon: '📝', badge: 'success' },
                                { type: 'image',    label: 'Image URL',    icon: '🖼️', badge: 'warning' },
                                { type: 'date',     label: 'Date',         icon: '📅', badge: 'danger' },
                                { type: 'color',    label: 'Color',        icon: '🎨', badge: 'info' },
                                { type: 'number',   label: 'Number',       icon: '🔢', badge: 'secondary' },
                            ];

                            function openBlockModal() {
                                selectedBlockType = null;
                                const grid = document.getElementById('typePickerGrid');
                                grid.innerHTML = BLOCK_TYPES.map(t => `
                                    <div class="col-4 mb-3">
                                        <div class="card border type-card text-center py-3 px-2" style="cursor:pointer"
                                            data-type="${t.type}" onclick="selectBlockType('${t.type}', this)">
                                            <div style="font-size:24px">${t.icon}</div>
                                            <div class="small mt-1">${t.label}</div>
                                        </div>
                                    </div>
                                `).join('');
                                document.getElementById('blockTypeModal').style.display = 'flex';
                            }

                            function closeBlockModal() {
                                document.getElementById('blockTypeModal').style.display = 'none';
                            }

                            function selectBlockType(type, el) {
                                selectedBlockType = type;
                                document.querySelectorAll('.type-card').forEach(c => {
                                    c.classList.remove('border-primary', 'shadow-sm');
                                });
                                el.classList.add('border-primary', 'shadow-sm');
                            }

                            function confirmBlock() {
                                if (!selectedBlockType) {
                                    alert('Please select a block type.');
                                    return;
                                }
                                const id = ++blockIdCounter;
                                blocksNew.push({ id, type: selectedBlockType, value: '' });
                                closeBlockModal();
                                renderBlocksNew();
                            }

                            function removeBlockNew(id) {
                                // Save TinyMCE content before removing
                                blocksNew.forEach(b => {
                                    if (b.type === 'textarea') {
                                        const ed = tinymce.get('editor_' + b.id);
                                        if (ed) b.value = ed.getContent();
                                    }
                                });
                                blocksNew = blocksNew.filter(b => b.id !== id);
                                renderBlocksNew();
                            }

                            function moveBlockNew(id, dir) {
                                // Save all TinyMCE content before re-render
                                blocksNew.forEach(b => {
                                    if (b.type === 'textarea') {
                                        const ed = tinymce.get('editor_' + b.id);
                                        if (ed) b.value = ed.getContent();
                                    }
                                });
                                const i = blocksNew.findIndex(b => b.id === id);
                                const swapIdx = dir === 'up' ? i - 1 : i + 1;
                                if (swapIdx < 0 || swapIdx >= blocksNew.length) return;
                                [blocksNew[i], blocksNew[swapIdx]] = [blocksNew[swapIdx], blocksNew[i]];
                                renderBlocksNew();
                            }

                            function syncContent() {
                                // Sync TinyMCE editors before saving
                                blocksNew.forEach(b => {
                                    if (b.type === 'textarea') {
                                        const ed = tinymce.get('editor_' + b.id);
                                        if (ed) b.value = ed.getContent();
                                    }
                                });
                                document.getElementById('contentIFNew').value =
                                    blocksNew.map(b => `<!--block--><!--type:${b.type}-->${b.value}`).join('');        
                                    // blocksNew.map(b => `<!--block-->${b.value}`).join('');
                            }

                            function renderBlocksNew() {
                                tinymce.remove('.tinymce-block'); // remove all block editors

                                const area = document.getElementById('blockAreaNew');
                                area.innerHTML = '';

                                blocksNew.forEach(b => {
                                    let fieldHTML = '';

                                    if (b.type === 'text') {
                                        fieldHTML = `<input type="text" class="form-control form-control-user labelBalloon"
                                            placeholder="Enter text..."
                                            value="${escHtml(b.value)}"
                                            onchange="updateBlockVal(${b.id}, this.value)">`;

                                    } else if (b.type === 'textarea') {
                                        fieldHTML = `<textarea id="editor_${b.id}" class="tinymce-block form-control"
                                            style="height:300px">${escHtml(b.value)}</textarea>`;

                                    } else if (b.type === 'image') {
                                        fieldHTML = `                                        
                                            <input type="text" class="form-control form-control-user labelBalloon mb-2"
                                                placeholder="https://example.com/image.jpg"
                                                value="${escHtml(b.value)}"
                                                onchange="updateBlockVal(${b.id}, this.value)">
                                            ${b.value ? `<img src="${escHtml(b.value)}" style="max-height:120px;border-radius:6px;border:1px solid #ddd">` : ''}`;

                                    } else if (b.type === 'date') {
                                        fieldHTML = `<input type="date" class="form-control form-control-user labelBalloon"
                                            value="${escHtml(b.value)}"
                                            onchange="updateBlockVal(${b.id}, this.value)">`;

                                    } else if (b.type === 'color') {
                                        fieldHTML = `
                                            <div class="d-flex align-items-center gap-2">
                                                <input type="color" class="form-control form-control-color"
                                                    value="${b.value || '#3B82F6'}"
                                                    oninput="updateBlockVal(${b.id}, this.value); document.getElementById('colorHex_${b.id}').textContent = this.value">
                                                <span id="colorHex_${b.id}" class="text-muted small">${b.value || '#3B82F6'}</span>
                                            </div>`;

                                    } else if (b.type === 'number') {
                                        fieldHTML = `<input type="number" class="form-control form-control-user labelBalloon"
                                            placeholder="0"
                                            value="${escHtml(b.value)}"
                                            onchange="updateBlockVal(${b.id}, this.value)">`;
                                    }

                                    const typeBadges = {
                                        text:'primary text-white', textarea:'success text-white', image:'warning text-white',
                                        date:'danger text-white', color:'info text-white', number:'secondary text-white'
                                    };
                                    const typeLabels = {
                                        text:'Text', textarea:'Rich Editor', image:'Image',
                                        date:'Date', color:'Color', number:'Number'
                                    };

                                    area.innerHTML += `
                                    <div class="card mb-2" data-block-id="${b.id}">
                                        <div class="card-header d-flex align-items-center justify-content-between py-2 px-3"
                                            style="background:#f8f9fa">
                                            <span class="badge bg-${typeBadges[b.type]}">${typeLabels[b.type]}</span>
                                            <div class="d-flex gap-1">
                                                <button type="button" class="btn btn-outline-secondary btn-sm"
                                                    onclick="moveBlockNew(${b.id},'up')">↑</button>
                                                <button type="button" class="btn btn-outline-secondary btn-sm"
                                                    onclick="moveBlockNew(${b.id},'down')">↓</button>
                                                <button type="button" class="btn btn-outline-danger btn-sm"
                                                    onclick="removeBlockNew(${b.id})">Delete</button>
                                            </div>
                                        </div>
                                        <div class="card-body py-2 px-3">${fieldHTML}</div>
                                    </div>`;
                                });

                                syncContent();
                                initBlockEditors();
                            }

                            function updateBlockVal(id, val) {
                                const b = blocksNew.find(b => b.id === id);
                                if (b) b.value = val;
                                syncContent();
                            }

                            function escHtml(str) {
                                return String(str || '')
                                    .replace(/&/g,'&amp;').replace(/"/g,'&quot;')
                                    .replace(/</g,'&lt;').replace(/>/g,'&gt;');
                            }

                            function initBlockEditors() {
                                const textareaBlocks = blocksNew.filter(b => b.type === 'textarea');
                                if (!textareaBlocks.length) return;

                                tinymce.init({
                                    selector: '.tinymce-block',
                                    height: 300,
                                    directionality: '',
                                    plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount textpattern noneditable help charmap emoticons',
                                    menubar: 'file edit view insert format tools table help',
                                    toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist | forecolor backcolor removeformat | fullscreen preview | insertfile image media template link anchor codesample | ltr rtl',
                                    toolbar_mode: 'sliding',
                                    document_base_url: '{{url("/")}}',
                                    relative_urls: true,
                                    convert_urls: false,
                                    valid_elements: '*[*]',
                                    file_picker_callback(callback, value, meta) {
                                        let x = window.innerWidth || document.documentElement.clientWidth;
                                        let y = window.innerHeight || document.documentElement.clientHeight;
                                        tinymce.activeEditor.windowManager.openUrl({
                                            url: '{{url("/dashboard/mediamanager")}}',
                                            title: '{{ __("Media Library") }}',
                                            width: x * 0.8,
                                            height: y * 0.8,
                                            onMessage: (api, message) => callback(message.content, { text: message.text })
                                        });
                                    },
                                    setup: function (editor) {
                                        editor.on('keyup change', function () {
                                            const id = parseInt(editor.id.replace('editor_', ''));
                                            const b = blocksNew.find(b => b.id === id);
                                            if (b) b.value = editor.getContent();
                                            syncContent();
                                        });
                                    }
                                });
                            }

                            // Sync before form submit
                            document.addEventListener('DOMContentLoaded', function () {
                                const form = document.querySelector('form');
                                if (form) form.addEventListener('submit', syncContent);
                            });
                            </script>
                            <!-- ---------------Block System------------------- -->

                            @endif
                        </div> 
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0"> 
                            @if($posttypeSlug->more_option_2 != "#")
                             
                            <!-- ---------------Block System-------------------  -->
                            <p class="mb-2 text-primary">{{$posttypeSlug->more_option_2}}</a>
                            <div id="blockArea2"></div>  
                            <div class="text-center">
                                <button type="button" class="btn btn-primary btn-user btn-block" onclick="addBlock2()">➕ Add Editor for {{ $posttypeSlug->more_option_2 }}</button>                                
                            </div>

                            <input type="hidden" name="more_option_2" id="contentIF2">
                            <script>
                            let blocks2 = [];

                            function addBlock2(html = '') {
                                blocks2.push(html);
                                renderBlocks2();
                            }

                            function renderBlocks2() {
                                const area2 = document.getElementById('blockArea2');
                                area2.innerHTML = '';

                                blocks2.forEach((content, index) => {
                                    area2.innerHTML += `
                                    <div style="border:1px solid #ddd;padding:10px;margin-bottom:10px">
                                        <textarea class="editor" data-index="${index}">
                                            ${content}
                                        </textarea>
                                        <br>
                                        <div class="gap-1">
                                            <a href="javascript:void(0)" role="button" class="btn btn-outline-secondary btn-sm" onclick="moveUp2(${index})">
                                                <i class="bi bi-arrow-up"></i> ↑
                                            </a>
                                            <a href="javascript:void(0)" role="button" class="btn btn-outline-secondary btn-sm" onclick="moveDown2(${index})">
                                                <i class="bi bi-arrow-down"></i> ↓
                                            </a>
                                            <a href="javascript:void(0)" role="button" class="btn btn-danger btn-sm" onclick="removeBlock2(${index})">
                                                Delete
                                            </a>
                                        </div>
                                    </div>`;
                                });

                                document.getElementById('contentIF2').value =
                                    blocks2.map(b => `<!--block-->${b}`).join('');

                                initTiny2();
                            }

                            function removeBlock2(i) {
                                blocks2.splice(i, 1);
                                renderBlocks2();
                            }

                            function moveUp2(i) {
                                if (i === 0) return;
                                [blocks2[i], blocks2[i-1]] = [blocks2[i-1], blocks2[i]];
                                renderBlocks2();
                            }

                            function moveDown2(i) {
                                if (i === blocks2.length - 1) return;
                                [blocks2[i], blocks2[i+1]] = [blocks2[i+1], blocks2[i]];
                                renderBlocks2();
                            }
                            </script>
                            <script>
                            function initTiny2() {
                                // Only remove the dynamic block editors, keep global editor intact
                                tinymce.remove('.editor');

                                tinymce.init({
                                    selector: '.editor',
                                    height: 550,
                                    directionality: '',
                                    /* language: '', */
                                    plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount textpattern noneditable help charmap emoticons', // imagetools, quickbars
                                    imagetools_cors_hosts: ['picsum.photos'],
                                    menubar: 'file edit view insert format tools table help',
                                    toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
                                    toolbar_sticky: false,
                                    document_base_url: '{{url('/')}}',
                                    relative_urls: true,
                                    convert_urls: false,
                                    valid_elements : '*[*]',
                                    toolbar_mode: 'sliding',
                                    forced_root_block: '', // disables automatic <p> wrapping
                                    file_picker_callback(callback, value, meta) {
                                        let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth
                                        let y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight

                                        tinymce.activeEditor.windowManager.openUrl({
                                            url: '{{url('/dashboard/mediamanager')}}',
                                            title: '{{ __("Media Library") }}',
                                            width: x * 0.8,
                                            height: y * 0.8,
                                            onMessage: (api, message) => {
                                                callback(message.content, {text: message.text})
                                            }
                                        })
                                    },
                                    setup: function (editor) {
                                        editor.on('keyup change', function () {
                                            const i = editor.getElement().dataset.index;
                                            blocks2[i] = editor.getContent();
                                            document.getElementById('contentIF2').value =
                                                blocks2.map(b => `<!--block-->${b}`).join('');
                                        });
                                    }
                                });
                            }
                            </script>
                            <!-- ---------------Block System-------------------  -->

                            <!-- <textarea name="more_option_2" class="form-control textarea"></textarea> -->
                            @endif
                        </div>  
                    </div>

                </div>
            </div>
            @endif

        </div>
        <!-- Pie Chart -->
        <div class="col-xl-3 col-lg-4">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Publish</h6>                
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="form-group row"> 
                        <div class="col-sm-12 mb-3 mb-sm-0"> 
                            <input type="text" name='position' value="" class="form-control form-control-user form-select-sm labelBalloon" id="positionId" placeholder="Position"><label for="positionId">Position</label>  
                        </div>
                    </div> 
                    <div class="form-group">
                        <input class="form-control form-select form-control-user form-select-sm" aria-label=".form-select-sm example" name="post_type" value="{{ collect(request()->segments())->last() }}" readonly>
                    </div> 
                    <div class="form-group row">                           
                        <div class="col-sm-12 mb-3 mb-sm-0">                  
                            <select class="form-control form-control-user form-select form-select-sm custom-select" aria-label=".form-select-sm example" name="status">                            
                                <option value="1" selected>Publish</option>    
                                <option value="0">Unpublish</option>
                            </select>
                        </div>
                    </div> 
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-user btn-block">Publish</button>
                    </div> 
                </div>
            </div>


            @if($posttypeSlug->category_id != "#")
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">{{$posttypeSlug->category_id}}</h6>                
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="form-group">                                
                        <input type="text" name='categori_name' class="form-control form-control-user form-select-sm" placeholder="Creat a new">
                    </div> 
                    <div class="form-group scrollCat">
                        
                        @foreach($specificCatOnly as $specificCat) 
                        <label class="form-check">
                            <input class="form-select form-select-sm form-check-input checkchild" name="category_id[]" type="checkbox" value="{{ $specificCat->id }}">
                            <span class="form-check-label">{{$specificCat->name}}</span> 
                        </label>
                        @endforeach                        
                    </div>                                        
                </div>
            </div>
            @else
               <input type="hidden" name="category_id" value=""> 
            @endif
            
            @if($posttypeSlug->thumbnail_path != "#")
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">{{$posttypeSlug->thumbnail_path}}</h6>                
                </div>
                <!-- Card Body -->
                <div class="card-body">                    
                    <div class="form-group">                       
                            <input type="hidden" id="myImg_type" name='thumbnail_path' placeholder="Image Url" class="form-control" >
                            <img id="myImg" src="{{ asset('packages/larapress/src/Assets/admin/img/dummy-image-square.jpg') }}" width="100%" height="auto" data-toggle="modal" data-target="#exampleModalCenter" class="border border-info" data-preview="myImg">
                            <button type="button" onclick="removeValue('{{url('/packages/larapress/src/Assets/admin/img/dummy-image-square.jpg')}}', 'myImg')" class="btn btn-secondary btn-sm mt-3">Remove Images</button>                        
                    </div>
                </div>
            </div>
            @endif 

            @if($posttypeSlug->gallery_img != "#")
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">{{$posttypeSlug->gallery_img}} for {{ collect(request()->segments())->last() }}</h6>                
                </div>
                <!-- Card Body -->
                <div class="card-body">                    
                    <div class="form-group">
                        <div class="mb-3">
                            <div class="form-group">                            
                                <img id="myImg" src="{{ asset('/packages/larapress/src/Assets/admin/img/dummy-image-square.jpg') }}" width="100%" height="auto" data-toggle="modal" data-target="#exampleModalGallery" class="border border-info">
                            </div> 
                        </div> 
                        <div class="row container1"></div>   
                    <!-- generate image container1 -->
                    </div>

                </div>
            </div>
            @else
            <!-- tempory value  -->
            <input type="hidden" name="gallery_img[]" >
            @endif

            <input type="hidden" name="template" value="{{$posttypeSlug->template}}" id="lp-orderInput">

        </div>        
 
        @if($posttypeSlug->template != 0 && $posttypeSlug->template != null && $posttypeSlug->template != 'single')
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Template</h6>         
                    <a href="https://larapress.org/en/store"><h6 class="m-0 font-weight-bold text-primary">View More Template</h6> </a>
                    <a href="{{url('/dashboard/about')}}"><h6 class="m-0 font-weight-bold text-primary">Upload Template</h6> </a>       
                </div>
                <div class="card-body scroll-design">
                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0"> 
                            <div id="lp-left-list" class="lp-list-container"> 
                                <?php
                                $folder_names = [];
                                $i = 0;  
                                // Define the paths
                                $mainResourceDir = resource_path('views/front/template');
                                $packageDir = base_path('packages/larapress/src/resources/views/front/template');

                                // Initialize an empty array to hold the merged directory list
                                $mergedDirList = [];

                                // Function to scan directories recursively
                                function scanDirectoryRecursively($dir) {
                                    $result = [];
                                    $items = scandir($dir);
                                    foreach ($items as $item) {
                                        if ($item == '.' || $item == '..') continue; // Skip current and parent directory references
                                        $fullPath = $dir . '/' . $item;
                                        if (is_dir($fullPath)) {
                                            // If it's a directory, recursively scan it
                                            $result[$item] = scanDirectoryRecursively($fullPath);
                                        } else {
                                            // If it's a file, just add it to the result
                                            $result[] = $fullPath;
                                        }
                                    }
                                    return $result;
                                }

                                // Function to extract comments from PHP file
                                function extractTemplateInfo($filePath) {
                                    $templateInfo = [
                                        'Template' => 'Unknown',
                                        'Version' => 'Unknown'
                                    ];

                                    // Read the first 1024 bytes of the file to look for the comment block
                                    $fileContent = file_get_contents($filePath, false, null, 0, 1024);
                                    if (preg_match('/\/\*\s*Template Name:\s*(.+)\s*Version:\s*(.+?)\s*\*\//', $fileContent, $matches)) {
                                        $templateInfo['Template'] = trim($matches[1]);
                                        $templateInfo['Version'] = trim($matches[2]);
                                    }

                                    return $templateInfo;
                                }

                                // Function to find the screenshot (png) file in the directory
                                function findScreenshot($files) {
                                    foreach ($files as $file) {
                                        if (pathinfo($file, PATHINFO_EXTENSION) === 'png') {
                                            return $file; // Return the first PNG file found
                                        }
                                    }
                                    return null; // Return null if no PNG is found
                                }

                                // Scan the main resource directory
                                if (is_dir($mainResourceDir)) {
                                    $dirList = scandir($mainResourceDir);
                                    foreach ($dirList as $value) {
                                        if (strpos($value, '.') === false) {
                                            // Recursively get files inside the directory
                                            $mergedDirList[$value] = scanDirectoryRecursively($mainResourceDir . '/' . $value);
                                        }
                                    }
                                }

                                // Scan the package directory
                                if (is_dir($packageDir)) {
                                    $dirList = scandir($packageDir);                                    
                                    foreach ($dirList as $value) {
                                        if (strpos($value, '.') === false) {
                                            // Recursively get files inside the directory
                                            $mergedDirList[$value] = scanDirectoryRecursively($packageDir . '/' . $value);
                                        }
                                    }
                                }

                                // Iterate through the merged directory list and output options
                                foreach ($mergedDirList as $dir => $files) {                                    
                                    // Find the screenshot (png) file for background image
                                    $screenshot = findScreenshot($files);
                                    $backgroundImage = $screenshot ? url(str_replace(base_path(), '', $screenshot)) : ''; // Default image if no screenshot is found
                                    ?>
                                    <div class="lp-item card" data-id="{{ $dir }}">
                                        @if($backgroundImage)
                                        <img src="<?php echo $backgroundImage; ?>">
                                        @endif
                                        <div class="card-body">                                        
                                        <?php
                                        foreach ($files as $file) {
                                            // Check if the file is a PHP file
                                            if (pathinfo($file, PATHINFO_EXTENSION) === 'php') {
                                                // Extract template info from the PHP file comments
                                                $templateInfo = extractTemplateInfo($file);
                                                ?>                                                
                                                    <?php //echo basename($file); ?>
                                                    <strong>Template Name:</strong> <?php echo $templateInfo['Template']; ?> <br>
                                                    <strong>Version:</strong> <?php echo $templateInfo['Version']; ?>    
                                                    <!-- <p><a href="{{url('/dashboard/delete-template',$dir)}}" class="btn btn-danger">Delete</a></p>                                                   -->
                                                <?php
                                            }
                                        }
                                        ?>
                                        </div>                                        
                                    </div>
                                    <?php
                                }
                                ?>                                
                                <!-- <div class="lp-item" data-id="4">Item 4</div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">My Design</h6>                
                </div>
                <div class="card-body scroll-design">
                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0">                            
                            <div id="lp-right-list" class="lp-drop-container"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

    </div>
</form>
<!-- Insert Image from library -->
@include('admin.media.medialibrary')
@include('admin.media.mediauploads')
<!-- Modal -->
@else
You can't access this page. Please contact admin.
@endif
<script src="{{ asset('packages/larapress/src/Assets/admin/js/template_design.js')}}"></script>
@endsection