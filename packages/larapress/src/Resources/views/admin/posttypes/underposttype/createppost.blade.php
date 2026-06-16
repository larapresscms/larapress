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

@if(optional(auth()->user())->role == 111 || $result == $posttypeSlug->id)

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
                                 
                                <div id="blockAreaNew"></div>                            
                                <input type="hidden" name="content" id="contentIFNew">
                                <!-- Type Picker Modal -->                                

                                <script>
                                let blocksNew = [];
                                let selectedBlockType = null;
                                let blockIdCounter = 0;

                                const BLOCK_TYPES = [
                                    { type: 'text',     label: 'Text',       icon: '🔤', badge: 'primary text-white'   },
                                    { type: 'textarea', label: 'Rich Editor', icon: '📝', badge: 'success text-white'   },
                                    { type: 'image',    label: 'Image URL',   icon: '🖼️', badge: 'warning text-white'   },
                                    { type: 'date',     label: 'Date',        icon: '📅', badge: 'danger text-white'    },
                                    { type: 'color',    label: 'Color',       icon: '🎨', badge: 'info text-white'      },
                                    { type: 'number',   label: 'Number',      icon: '🔢', badge: 'secondary text-white' },
                                ];                                

                                function syncContent() {
                                    blocksNew.forEach(b => {
                                        if (b.type === 'textarea') {
                                            const ed = tinymce.get('editor_' + b.id);
                                            if (ed) b.value = ed.getContent();
                                        }
                                    });
                                    // ✏️ include label in serialized output
                                    document.getElementById('contentIFNew').value =
                                        blocksNew.map(b => `<!--block--><!--type:${b.type}--><!--label:${b.label}-->${b.value}`).join('');
                                }

                                function renderBlocksNew() {
                                    tinymce.remove('.tinymce-block');

                                    const area = document.getElementById('blockAreaNew');
                                    area.innerHTML = '';

                                    const typeBadges = { text:'primary text-white', textarea:'success text-white', image:'warning text-white', date:'danger text-white', color:'info text-white', number:'secondary text-white' };
                                    const typeLabels = { text:'Text', textarea:'Rich Editor', image:'Image', date:'Date', color:'Color', number:'Number' };

                                    blocksNew.forEach(b => {
                                        let fieldHTML = '';

                                        if (b.type === 'text') {
                                            fieldHTML = `<input type="text" class="form-control"
                                                placeholder="Enter text..."
                                                value="${escHtml(b.value)}"
                                                onchange="updateBlockVal(${b.id}, this.value)">`;

                                        } else if (b.type === 'textarea') {
                                            fieldHTML = `<textarea id="editor_${b.id}" class="tinymce-block form-control"
                                                style="height:300px">${b.value}</textarea>`;

                                        } else if (b.type === 'image') {
                                            const imgSrc = b.value.replace(/"/g, '&quot;');
                                            fieldHTML = `
                                                <input type="text" class="form-control mb-2"
                                                    placeholder="https://example.com/image.jpg"
                                                    value="${escHtml(b.value)}"
                                                    onchange="updateBlockVal(${b.id}, this.value)">
                                                ${b.value ? `<img src="${imgSrc}" style="max-height:120px;border-radius:6px;border:1px solid #ddd">` : ''}`;

                                        } else if (b.type === 'date') {
                                            fieldHTML = `<input type="date" class="form-control"
                                                value="${escHtml(b.value)}"
                                                onchange="updateBlockVal(${b.id}, this.value)">`;

                                        } else if (b.type === 'color') {
                                            const colorVal = b.value || '#3B82F6';
                                            fieldHTML = `
                                                <div class="d-flex align-items-center gap-2">
                                                    <input type="color" class="form-control form-control-color"
                                                        value="${colorVal}"
                                                        oninput="updateBlockVal(${b.id}, this.value); document.getElementById('colorHex_${b.id}').textContent = this.value">
                                                    <span id="colorHex_${b.id}" class="text-muted small">${colorVal}</span>
                                                </div>`;

                                        } else if (b.type === 'number') {
                                            fieldHTML = `<input type="number" class="form-control"
                                                placeholder="0"
                                                value="${escHtml(b.value)}"
                                                onchange="updateBlockVal(${b.id}, this.value)">`;
                                        }

                                        area.innerHTML += `
                                        <div class="card mb-2" data-block-id="${b.id}">
                                            <div class="card-header d-flex align-items-center justify-content-between py-2 px-3" style="background:#f8f9fa">
                                                <div class="d-flex align-items-center gap-2">
                                                    <!-- ✏️ label shown as static text -->
                                                    <span class="fw-semibold small badge bg-${typeBadges[b.type]}">${escHtml(b.label)}</span>                                                                                                        
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
                                        .replace(/&/g,'&amp;')
                                        .replace(/"/g,'&quot;')
                                        .replace(/</g,'&lt;')
                                        .replace(/>/g,'&gt;');
                                }

                                function initBlockEditors() {
                                    if (!blocksNew.filter(b => b.type === 'textarea').length) return;
                                    tinymce.init({
                                        selector: '.tinymce-block',
                                        height: 300,
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
                                                width: x * 0.8, height: y * 0.8,
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

                                document.addEventListener('DOMContentLoaded', function () {
                                    const form = document.querySelector('form');
                                    if (form) form.addEventListener('submit', syncContent);

                                    const savedBlockData = @json($posttypeSlug->content ?? '');

                                    if (savedBlockData && savedBlockData.trim() !== '') {
                                        // ✏️ updated parser: now extracts label between <!--label:...--> and the value after
                                        const parts = savedBlockData.split('<!--block-->').filter(Boolean);
                                        parts.forEach(part => {
                                            const typeMatch  = part.match(/<!--type:([^-]+)-->/);
                                            const labelMatch = part.match(/<!--label:(.*?)-->/);
                                            if (!typeMatch) return;
                                            const type  = typeMatch[1].trim();
                                            const label = labelMatch ? labelMatch[1] : '';
                                            const validTypes = ['text','textarea','image','date','color','number'];
                                            if (!validTypes.includes(type)) return;
                                            // value is everything after the last --> marker
                                            const value = part.replace(/<!--.*?-->/g, '');
                                            blocksNew.push({ id: ++blockIdCounter, type, value, label }); // ✏️ label restored
                                        });
                                        if (blocksNew.length > 0) renderBlocksNew();
                                    }
                                });
                                </script>
                            <!-- ---------------Block System------------------- -->
                            

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
                            <!-- ---------------Block System------------------- -->
                               <div id="mo1BlockArea"></div>
                                <input type="hidden" name="more_option_1" id="mo1ContentIF">

                                <!-- Type Picker Modal -->

                                <script>
                                let mo1Blocks = [];
                                let mo1SelectedBlockType = null;
                                let mo1BlockIdCounter = 0;

                                const MO1_BLOCK_TYPES = [
                                    { type: 'text',     label: 'Text',        icon: '🔤', badge: 'primary text-white'   },
                                    { type: 'textarea', label: 'Rich Editor',  icon: '📝', badge: 'success text-white'   },
                                    { type: 'image',    label: 'Image URL',    icon: '🖼️', badge: 'warning text-white'   },
                                    { type: 'date',     label: 'Date',         icon: '📅', badge: 'danger text-white'    },
                                    { type: 'color',    label: 'Color',        icon: '🎨', badge: 'info text-white'      },
                                    { type: 'number',   label: 'Number',       icon: '🔢', badge: 'secondary text-white' },
                                ];

                                function mo1SyncContent() {
                                    mo1Blocks.forEach(b => {
                                        if (b.type === 'textarea') {
                                            const ed = tinymce.get('mo1_editor_' + b.id);
                                            if (ed) b.value = ed.getContent();
                                        }
                                    });
                                    document.getElementById('mo1ContentIF').value =
                                        mo1Blocks.map(b => `<!--block--><!--type:${b.type}--><!--label:${b.label}-->${b.value}`).join('');
                                }

                                function mo1RenderBlocks() {
                                    // Only remove mo1 TinyMCE instances, never touch other fields' editors
                                    mo1Blocks.forEach(b => {
                                        if (b.type === 'textarea') {
                                            const ed = tinymce.get('mo1_editor_' + b.id);
                                            if (ed) ed.remove();
                                        }
                                    });
                                    document.querySelectorAll('.mo1-tinymce-block').forEach(el => {
                                        const ed = tinymce.get(el.id);
                                        if (ed) ed.remove();
                                    });

                                    const area = document.getElementById('mo1BlockArea');
                                    area.innerHTML = '';

                                    const typeBadges = { text:'primary text-white', textarea:'success text-white', image:'warning text-white', date:'danger text-white', color:'info text-white', number:'secondary text-white' };
                                    const typeLabels = { text:'Text', textarea:'Rich Editor', image:'Image', date:'Date', color:'Color', number:'Number' };

                                    mo1Blocks.forEach(b => {
                                        let fieldHTML = '';

                                        if (b.type === 'text') {
                                            fieldHTML = `<input type="text" class="form-control"
                                                placeholder="Enter text..."
                                                value="${mo1EscHtml(b.value)}"
                                                onchange="mo1UpdateBlockVal(${b.id}, this.value)">`;

                                        } else if (b.type === 'textarea') {
                                            fieldHTML = `<textarea id="mo1_editor_${b.id}" class="mo1-tinymce-block form-control"
                                                style="height:300px">${b.value}</textarea>`;

                                        } else if (b.type === 'image') {
                                            const imgSrc = b.value.replace(/"/g, '&quot;');
                                            fieldHTML = `
                                                <input type="text" class="form-control mb-2"
                                                    placeholder="https://example.com/image.jpg"
                                                    value="${mo1EscHtml(b.value)}"
                                                    onchange="mo1UpdateBlockVal(${b.id}, this.value)">
                                                ${b.value ? `<img src="${imgSrc}" style="max-height:120px;border-radius:6px;border:1px solid #ddd">` : ''}`;

                                        } else if (b.type === 'date') {
                                            fieldHTML = `<input type="date" class="form-control"
                                                value="${mo1EscHtml(b.value)}"
                                                onchange="mo1UpdateBlockVal(${b.id}, this.value)">`;

                                        } else if (b.type === 'color') {
                                            const colorVal = b.value || '#3B82F6';
                                            fieldHTML = `
                                                <div class="d-flex align-items-center gap-2">
                                                    <input type="color" class="form-control form-control-color"
                                                        value="${colorVal}"
                                                        oninput="mo1UpdateBlockVal(${b.id}, this.value); document.getElementById('mo1ColorHex_${b.id}').textContent = this.value">
                                                    <span id="mo1ColorHex_${b.id}" class="text-muted small">${colorVal}</span>
                                                </div>`;

                                        } else if (b.type === 'number') {
                                            fieldHTML = `<input type="number" class="form-control"
                                                placeholder="0"
                                                value="${mo1EscHtml(b.value)}"
                                                onchange="mo1UpdateBlockVal(${b.id}, this.value)">`;
                                        }

                                        area.innerHTML += `
                                        <div class="card mb-2" data-block-id="${b.id}">
                                            <div class="card-header d-flex align-items-center justify-content-between py-2 px-3" style="background:#f8f9fa">
                                                <div class="d-flex align-items-center gap-2">
                                                    <span class="fw-semibold small badge bg-${typeBadges[b.type]}">${mo1EscHtml(b.label)}</span>
                                                </div>
                                            </div>
                                            <div class="card-body py-2 px-3">${fieldHTML}</div>
                                        </div>`;
                                    });

                                    mo1SyncContent();
                                    mo1InitBlockEditors();
                                }

                                function mo1UpdateBlockVal(id, val) {
                                    const b = mo1Blocks.find(b => b.id === id);
                                    if (b) b.value = val;
                                    mo1SyncContent();
                                }

                                function mo1EscHtml(str) {
                                    return String(str || '')
                                        .replace(/&/g,'&amp;')
                                        .replace(/"/g,'&quot;')
                                        .replace(/</g,'&lt;')
                                        .replace(/>/g,'&gt;');
                                }

                                function mo1InitBlockEditors() {
                                    if (!mo1Blocks.filter(b => b.type === 'textarea').length) return;
                                    tinymce.init({
                                        selector: '.mo1-tinymce-block',
                                        height: 300,
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
                                                width: x * 0.8, height: y * 0.8,
                                                onMessage: (api, message) => callback(message.content, { text: message.text })
                                            });
                                        },
                                        setup: function (editor) {
                                            editor.on('keyup change', function () {
                                                const id = parseInt(editor.id.replace('mo1_editor_', ''));
                                                const b = mo1Blocks.find(b => b.id === id);
                                                if (b) b.value = editor.getContent();
                                                mo1SyncContent();
                                            });
                                        }
                                    });
                                }

                                document.addEventListener('DOMContentLoaded', function () {
                                    const form = document.querySelector('form');
                                    if (form) form.addEventListener('submit', mo1SyncContent);

                                    const mo1SavedData = @json($posttypeSlug->more_option_1 ?? '');

                                    if (mo1SavedData && mo1SavedData.trim() !== '') {
                                        const parts = mo1SavedData.split('<!--block-->').filter(Boolean);
                                        parts.forEach(part => {
                                            const typeMatch  = part.match(/<!--type:([^-]+)-->/);
                                            const labelMatch = part.match(/<!--label:(.*?)-->/);
                                            if (!typeMatch) return;
                                            const type  = typeMatch[1].trim();
                                            const label = labelMatch ? labelMatch[1] : '';
                                            const validTypes = ['text','textarea','image','date','color','number'];
                                            if (!validTypes.includes(type)) return;
                                            const value = part.replace(/<!--.*?-->/g, '');
                                            mo1Blocks.push({ id: ++mo1BlockIdCounter, type, value, label });
                                        });
                                        if (mo1Blocks.length > 0) mo1RenderBlocks();
                                    }
                                });
                                </script>
                                <!-- ---------------Block System: more_option_1------------------- -->                           
                            @endif
                        </div> 
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0"> 
                            @if($posttypeSlug->more_option_2 != "#")                             
                            <!-- ---------------Block System-------------------  -->                            
                            <div id="mo2BlockArea"></div>
                            <input type="hidden" name="more_option_2" id="mo2ContentIF">

                            <script>
                            let mo2Blocks = [];
                            let mo2SelectedBlockType = null;
                            let mo2BlockIdCounter = 0;

                            const MO2_BLOCK_TYPES = [
                                { type: 'text',     label: 'Text',        icon: '🔤', badge: 'primary text-white'   },
                                { type: 'textarea', label: 'Rich Editor',  icon: '📝', badge: 'success text-white'   },
                                { type: 'image',    label: 'Image URL',    icon: '🖼️', badge: 'warning text-white'   },
                                { type: 'date',     label: 'Date',         icon: '📅', badge: 'danger text-white'    },
                                { type: 'color',    label: 'Color',        icon: '🎨', badge: 'info text-white'      },
                                { type: 'number',   label: 'Number',       icon: '🔢', badge: 'secondary text-white' },
                            ];

                            function mo2SyncContent() {
                                mo2Blocks.forEach(b => {
                                    if (b.type === 'textarea') {
                                        const ed = tinymce.get('mo2_editor_' + b.id);
                                        if (ed) b.value = ed.getContent();
                                    }
                                });
                                document.getElementById('mo2ContentIF').value =
                                    mo2Blocks.map(b => `<!--block--><!--type:${b.type}--><!--label:${b.label}-->${b.value}`).join('');
                            }

                            function mo2RenderBlocks() {
                                mo2Blocks.forEach(b => {
                                    if (b.type === 'textarea') {
                                        const ed = tinymce.get('mo2_editor_' + b.id);
                                        if (ed) ed.remove();
                                    }
                                });
                                document.querySelectorAll('.mo2-tinymce-block').forEach(el => {
                                    const ed = tinymce.get(el.id);
                                    if (ed) ed.remove();
                                });

                                const area = document.getElementById('mo2BlockArea');
                                area.innerHTML = '';

                                const typeBadges = { text:'primary text-white', textarea:'success text-white', image:'warning text-white', date:'danger text-white', color:'info text-white', number:'secondary text-white' };

                                mo2Blocks.forEach(b => {
                                    let fieldHTML = '';

                                    if (b.type === 'text') {
                                        fieldHTML = `<input type="text" class="form-control"
                                            placeholder="Enter text..." value="${mo2EscHtml(b.value)}"
                                            onchange="mo2UpdateBlockVal(${b.id}, this.value)">`;

                                    } else if (b.type === 'textarea') {
                                        fieldHTML = `<textarea id="mo2_editor_${b.id}" class="mo2-tinymce-block form-control"
                                            style="height:300px">${b.value}</textarea>`;

                                    } else if (b.type === 'image') {
                                        const imgSrc = b.value.replace(/"/g, '&quot;');
                                        fieldHTML = `
                                            <input type="text" class="form-control mb-2"
                                                placeholder="https://example.com/image.jpg"
                                                value="${mo2EscHtml(b.value)}"
                                                onchange="mo2UpdateBlockVal(${b.id}, this.value)">
                                            ${b.value ? `<img src="${imgSrc}" style="max-height:120px;border-radius:6px;border:1px solid #ddd">` : ''}`;

                                    } else if (b.type === 'date') {
                                        fieldHTML = `<input type="date" class="form-control"
                                            value="${mo2EscHtml(b.value)}"
                                            onchange="mo2UpdateBlockVal(${b.id}, this.value)">`;

                                    } else if (b.type === 'color') {
                                        const colorVal = b.value || '#3B82F6';
                                        fieldHTML = `
                                            <div class="d-flex align-items-center gap-2">
                                                <input type="color" class="form-control form-control-color"
                                                    value="${colorVal}"
                                                    oninput="mo2UpdateBlockVal(${b.id}, this.value); document.getElementById('mo2ColorHex_${b.id}').textContent = this.value">
                                                <span id="mo2ColorHex_${b.id}" class="text-muted small">${colorVal}</span>
                                            </div>`;

                                    } else if (b.type === 'number') {
                                        fieldHTML = `<input type="number" class="form-control"
                                            placeholder="0" value="${mo2EscHtml(b.value)}"
                                            onchange="mo2UpdateBlockVal(${b.id}, this.value)">`;
                                    }

                                    area.innerHTML += `
                                    <div class="card mb-2" data-block-id="${b.id}">
                                        <div class="card-header d-flex align-items-center justify-content-between py-2 px-3" style="background:#f8f9fa">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="fw-semibold small badge bg-${typeBadges[b.type]}">${mo2EscHtml(b.label)}</span>
                                            </div>
                                        </div>
                                        <div class="card-body py-2 px-3">${fieldHTML}</div>
                                    </div>`;
                                });

                                mo2SyncContent();
                                mo2InitBlockEditors();
                            }

                            function mo2UpdateBlockVal(id, val) {
                                const b = mo2Blocks.find(b => b.id === id);
                                if (b) b.value = val;
                                mo2SyncContent();
                            }

                            function mo2EscHtml(str) {
                                return String(str || '')
                                    .replace(/&/g,'&amp;').replace(/"/g,'&quot;')
                                    .replace(/</g,'&lt;').replace(/>/g,'&gt;');
                            }

                            function mo2InitBlockEditors() {
                                if (!mo2Blocks.filter(b => b.type === 'textarea').length) return;
                                tinymce.init({
                                    selector: '.mo2-tinymce-block',
                                    height: 300,
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
                                            width: x * 0.8, height: y * 0.8,
                                            onMessage: (api, message) => callback(message.content, { text: message.text })
                                        });
                                    },
                                    setup: function (editor) {
                                        editor.on('keyup change', function () {
                                            const id = parseInt(editor.id.replace('mo2_editor_', ''));
                                            const b = mo2Blocks.find(b => b.id === id);
                                            if (b) b.value = editor.getContent();
                                            mo2SyncContent();
                                        });
                                    }
                                });
                            }

                            document.addEventListener('DOMContentLoaded', function () {
                                const form = document.querySelector('form');
                                if (form) form.addEventListener('submit', mo2SyncContent);

                                const mo2SavedData = @json($posttypeSlug->more_option_2 ?? '');

                                if (mo2SavedData && mo2SavedData.trim() !== '') {
                                    const parts = mo2SavedData.split('<!--block-->').filter(Boolean);
                                    parts.forEach(part => {
                                        const typeMatch  = part.match(/<!--type:([^-]+)-->/);
                                        const labelMatch = part.match(/<!--label:(.*?)-->/);
                                        if (!typeMatch) return;
                                        const type  = typeMatch[1].trim();
                                        const label = labelMatch ? labelMatch[1] : '';
                                        const validTypes = ['text','textarea','image','date','color','number'];
                                        if (!validTypes.includes(type)) return;
                                        const value = part.replace(/<!--.*?-->/g, '');
                                        mo2Blocks.push({ id: ++mo2BlockIdCounter, type, value, label });
                                    });
                                    if (mo2Blocks.length > 0) mo2RenderBlocks();
                                }
                            });
                            </script>
                            <!-- ---------------Block System: more_option_2------------------- -->
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