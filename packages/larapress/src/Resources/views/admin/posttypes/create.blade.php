@extends('admin.layouts.master')
@section('content')
@if(optional(auth()->user())->role == 111)
<!-- Nested Row within Card Body -->
<form class="user" action="{{ url('/dashboard/posttypes') }}" method="post">
{{ csrf_field() }}
    <div class="row">
        <div class="col-xl-9 col-lg-8">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Create a Post Type!</h6>                
                </div>
                <!-- Card Body -->
                <div class="card-body"> 
                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0">
                            <input type="text" name='name' class="form-control form-control-user" id="exampleFirstName"
                                placeholder=" Post Type Name">
                                <input type="hidden" name='user_id' class="form-control form-control-user" id="exampleFirstName"
                                placeholder="user" value="@auth(){{ optional(auth()->user())->id}}@endauth">
                        </div> 
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0">                                
                            <!-- choose editor  -->
                            @if($settingsAdmin->editor == "classic")
                            <!-- editor 1-->
                                <textarea name="pt_content" class="textarea"></textarea>  
                            @else
                            <!-- editor 2-->                
                            <textarea id="html" name="pt_content"></textarea>
                            <textarea id="css" name="pt_content_css"></textarea>                
                            <div id="gjs" style="height:500px !important;"></div>                      
                            @endif                                  
                        </div>                             
                    </div>
                </div>
            </div>
            
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Turn on off post sections</h6>                
                </div>
                <!-- Card Body -->
                <div class="card-body">

                    <!-- Options text -->

                    <label for="basic-url">If you visible this fields please input your placeholder. Turn off # Code: title</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text badge-success"><i class="fa fa-check" aria-hidden="true"></i></span>
                            <span class="input-group-text">title</span>
                        </div>
                        <input type="text" name="title" value="Title" class="form-control form-control-user">
                        <!-- <div class="input-group-prepend">
                            <span class="input-group-text">Required?</span>
                            <span class="input-group-text badge-info"><input name="menu_icon" type="checkbox" /></span>
                        </div> -->
                    </div> 

                    <div class="border p-3 mb-3">
                        <div class="card mb-2">
                            <div class="card-header d-flex align-items-center justify-content-between py-2 px-3" style="background:#f8f9fa">
                                <div class="d-flex align-items-center gap-2">
                                    <label for="basic-url">Mutiple Fields: `content`  <a href="https://larapress.org/en/documentation/block-multiple-fields" target="_blank">Learn More</a></label>
                                </div>
                            </div>
                        </div>                  
                        
                        <div class="form-group mb-3">
                            <!-- <div class="input-group-prepend"> -->                                                  

                                <!-- ---------------Block System------------------- --> 
                                <div id="blockAreaNew"></div>

                                <div class="text-center mt-2">
                                    <button type="button" class="btn btn-primary btn-user btn-block" onclick="openBlockModal()">
                                        ➕ Add Multi Block
                                    </button>
                                </div>

                                <input type="hidden" name="content" value="#" id="contentIFNew">

                                <!-- Type Picker Modal -->
                                <div id="blockTypeModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.45);z-index:9999;align-items:center;justify-content:center;">
                                    <div style="background:#fff;border-radius:12px;padding:24px;width:400px;box-shadow:0 8px 32px rgba(0,0,0,.15)">
                                        <h6 class="mb-1 fw-semibold">Choose block type</h6>
                                        <p class="text-muted small mb-3">Select the kind of content to add</p>
                                        <div class="row g-2 mb-3" id="typePickerGrid">
                                            <!-- filled by JS -->
                                        </div>

                                        <!-- ✏️ CHANGED: label input shown after type is selected -->
                                        <div id="blockLabelRow" style="display:none;" class="mb-3">
                                            <label class="form-label small fw-semibold">Field Label</label>
                                            <input type="text" id="blockLabelInput" class="form-control form-control-sm"
                                                placeholder="e.g. Title, Description, Cover Image...">
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
                                    // ✏️ CHANGED: reset label row on open
                                    document.getElementById('blockLabelRow').style.display = 'none';
                                    document.getElementById('blockLabelInput').value = '';

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
                                    // ✏️ CHANGED: show label input after type is picked
                                    document.getElementById('blockLabelRow').style.display = 'block';
                                    document.getElementById('blockLabelInput').focus();
                                }

                                function confirmBlock() {
                                    if (!selectedBlockType) {
                                        alert('Please select a block type.');
                                        return;
                                    }
                                    // ✏️ CHANGED: read label from input
                                    const label = document.getElementById('blockLabelInput').value.trim();
                                    if (!label) {
                                        alert('Please enter a field label.');
                                        return;
                                    }
                                    const id = ++blockIdCounter;
                                    blocksNew.push({ id, type: selectedBlockType, value: '', label });
                                    closeBlockModal();
                                    renderBlocksNew();
                                }

                                function removeBlockNew(id) {
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
                                    blocksNew.forEach(b => {
                                        if (b.type === 'textarea') {
                                            const ed = tinymce.get('editor_' + b.id);
                                            if (ed) b.value = ed.getContent();
                                        }
                                    });
                                    // ✏️ CHANGED: include label in output
                                    document.getElementById('contentIFNew').value =
                                        blocksNew.map(b => `<!--block--><!--type:${b.type}--><!--label:${b.label}-->${b.value}`).join('');
                                }

                                function renderBlocksNew() {
                                    tinymce.remove('.tinymce-block');

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
                                                <div class="d-flex align-items-center gap-2">                                                    
                                                    <!-- ✏️ CHANGED: label shown as static text, not editable -->
                                                    <span class="fw-semibold small badge bg-${typeBadges[b.type]}">${escHtml(b.label)}</span>
                                                </div>
                                                
                                                <div class="d-flex gap-1">
                                                    <button type="button" class="mr-1 btn btn-sm badge bg-${typeBadges[b.type]}">Type: ${typeLabels[b.type]} </button>
                                                    <button type="button" class="mr-1 btn btn-outline-secondary btn-sm"
                                                        onclick="moveBlockNew(${b.id},'up')">↑</button>
                                                    <button type="button" class="mr-1 btn btn-outline-secondary btn-sm"
                                                        onclick="moveBlockNew(${b.id},'down')">↓</button>
                                                    <button type="button" class="mr-1 btn btn-outline-danger btn-sm"
                                                        onclick="removeBlockNew(${b.id})">Delete</button>
                                                </div>
                                            </div>
                                            <div class="card-body py-2 px-3 d-none">${fieldHTML}</div>
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

                                document.addEventListener('DOMContentLoaded', function () {
                                    const form = document.querySelector('form');
                                    if (form) form.addEventListener('submit', syncContent);
                                });
                                </script>
                                <!-- ---------------Block System------------------- -->
                            <!-- </div> -->
                            <!-- <input type="text" name="content" value="#" class="form-control form-control-user" aria-label="Dollar amount (with dot and two decimal places)"> -->
                        </div>
                    </div>

                    <div class="border p-3">
                        <label for="basic-url">If you visible this fields please input your placeholder. Turn off # Code: excerpt</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text badge-danger"><i class="fa fa-times" aria-hidden="true"></i></span>
                                <span class="input-group-text">Excerpt</span>
                            </div>
                            <select id="excerptfieldType" name="excerpt_type" class="dynamic-field-type form-select form-select-sm custom-select" data-target="excerptDynamicField">
                                <option value="none">None</option>
                                <option value="text">Text</option>
                                <option value="date">Date</option>
                                <option value="select">Select</option>
                                <option value="image">Image</option>
                                <option value="color">Color</option>
                                <option value="checkbox">Checkbox</option>
                                <option value="number">Number</option>
                                <option value="radio">Radio</option>                                 
                                <option value="posttype">Post Type</option> 
                            </select> 
                            <!-- <input type="text" name="excerpt" class="form-control form-control-user" value="#"> -->
                        </div>
                        <div id="excerptDynamicField" class="mt-2"></div>
                    </div>                    

                    <label for="basic-url">If you visible this fields please input your placeholder. Turn off # Code: thumbnail_path</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text badge-danger"><i class="fa fa-times" aria-hidden="true"></i></span>
                            <span class="input-group-text">thumbnail_path</span>
                        </div>
                        <input type="text" name="thumbnail_path" class="form-control form-control-user" value="#">
                    </div>

                    <div class="border p-3">
                        <label for="basic-url">If you visible this fields please input your placeholder. Turn off # Code: option_1</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text badge-danger"><i class="fa fa-times" aria-hidden="true"></i></span>
                                <span class="input-group-text">option_1</span>
                            </div>
                            <!-- <input type="text" name="option_1" class="form-control form-control-user" value="#"> -->
                            <select id="option_1fieldType" name="option_1_type" class="dynamic-field-type form-select form-select-sm custom-select" data-target="option_1DynamicField">
                                <option value="none">None</option>
                                <option value="text">Text</option>
                                <option value="date">Date</option>
                                <option value="select">Select</option>
                                <option value="image">Image</option>
                                <option value="color">Color</option>
                                <option value="checkbox">Checkbox</option>
                                <option value="number">Number</option>
                                <option value="radio">Radio</option>                              
                                <option value="posttype">Post Type</option> 
                            </select> 
                        </div>
                        <div id="option_1DynamicField" class="mt-2"></div>
                    </div>
                    <!-- <div id="option_1DynamicField" class="mt-2"></div> -->

                    <div class="border p-3 mt-3">
                        <label for="basic-url">If you visible this fields please input your placeholder. Turn off # Code: option_2</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text badge-danger"><i class="fa fa-times" aria-hidden="true"></i></span>
                                <span class="input-group-text">option_2</span>
                            </div>
                            <select id="option_2fieldType" name="option_2_type" class="dynamic-field-type form-select form-select-sm custom-select" data-target="option_2DynamicField">
                                <option value="none">None</option>
                                <option value="text">Text</option>
                                <option value="date">Date</option>
                                <option value="select">Select</option>
                                <option value="image">Image</option>
                                <option value="color">Color</option>
                                <option value="checkbox">Checkbox</option>
                                <option value="number">Number</option>
                                <option value="radio">Radio</option>                              
                                <option value="posttype">Post Type</option> 
                            </select>
                        </div>
                        <div id="option_2DynamicField" class="mt-2"></div>
                    </div>

                    <div class="border p-3 mt-3">
                        <label for="basic-url">If you visible this fields please input your placeholder. Turn off # Code: option_3</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text badge-danger"><i class="fa fa-times" aria-hidden="true"></i></span>
                                <span class="input-group-text">option_3</span>
                            </div>
                            <select id="option_3fieldType" name="option_3_type" class="dynamic-field-type form-select form-select-sm custom-select" data-target="option_3DynamicField">
                                <option value="none">None</option>
                                <option value="text">Text</option>
                                <option value="date">Date</option>
                                <option value="select">Select</option>
                                <option value="image">Image</option>
                                <option value="color">Color</option>
                                <option value="checkbox">Checkbox</option>
                                <option value="number">Number</option>
                                <option value="radio">Radio</option>                              
                                <option value="posttype">Post Type</option> 
                            </select>
                        </div>
                        <div id="option_3DynamicField" class="mt-2"></div>
                    </div>

                    <div class="border p-3 mt-3 mb-3">
                        <label for="basic-url">If you visible this fields please input your placeholder. Turn off # Code: option_4</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text badge-danger"><i class="fa fa-times" aria-hidden="true"></i></span>
                                <span class="input-group-text">option_4</span>
                            </div>
                            <select id="option_4fieldType" name="option_4_type" class="dynamic-field-type form-select form-select-sm custom-select" data-target="option_4DynamicField">
                                <option value="none">None</option>
                                <option value="text">Text</option>
                                <option value="date">Date</option>
                                <option value="select">Select</option>
                                <option value="image">Image</option>
                                <option value="color">Color</option>
                                <option value="checkbox">Checkbox</option>
                                <option value="number">Number</option>
                                <option value="radio">Radio</option>                              
                                <option value="posttype">Post Type</option> 
                            </select>
                        </div>
                        <div id="option_4DynamicField" class="mt-2"></div>
                    </div>                    

                    <!-- <label for="basic-url">If you visible this fields please input your placeholder. Turn off # Code: more_option_1 like Positions</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text badge-danger"><i class="fa fa-times" aria-hidden="true"></i></span>
                            <span class="input-group-text">more_option_1</span>
                        </div>
                        <input type="text" name="more_option_1" class="form-control form-control-user" value="#">
                    </div> -->

                    <div class="border p-3 mb-3">
                        <div class="card mb-2">
                            <div class="card-header d-flex align-items-center justify-content-between py-2 px-3" style="background:#f8f9fa">
                                <div class="d-flex align-items-center gap-2">
                                    <label for="basic-url">Mutiple Fields: `more_option_1` <a href="https://larapress.org/en/documentation/block-multiple-fields" target="_blank">Learn More</a></label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">

                            <!-- ---------------Block System: more_option_1------------------- -->
                            <div id="mo1BlockArea"></div>

                            <div class="text-center mt-2">
                                <button type="button" class="btn btn-primary btn-user btn-block" onclick="mo1OpenBlockModal()">
                                    ➕ Add Multi Block
                                </button>
                            </div>

                            <input type="hidden" name="more_option_1" value="#" id="mo1ContentIF">

                            <!-- Type Picker Modal -->
                            <div id="mo1BlockTypeModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.45);z-index:9999;align-items:center;justify-content:center;">
                                <div style="background:#fff;border-radius:12px;padding:24px;width:400px;box-shadow:0 8px 32px rgba(0,0,0,.15)">
                                    <h6 class="mb-1 fw-semibold">Choose block type</h6>
                                    <p class="text-muted small mb-3">Select the kind of content to add</p>
                                    <div class="row g-2 mb-3" id="mo1TypePickerGrid">
                                        <!-- filled by JS -->
                                    </div>

                                    <div id="mo1BlockLabelRow" style="display:none;" class="mb-3">
                                        <label class="form-label small fw-semibold">Field Label</label>
                                        <input type="text" id="mo1BlockLabelInput" class="form-control form-control-sm"
                                            placeholder="e.g. Title, Description, Cover Image...">
                                    </div>

                                    <div class="d-flex gap-2 justify-content-end">
                                        <p class="btn btn-outline-secondary btn-sm mr-2" onclick="mo1CloseBlockModal()">Cancel</p>
                                        <p class="btn btn-primary btn-sm" onclick="mo1ConfirmBlock()">Add Block</p>
                                    </div>
                                </div>
                            </div>

                            <script>
                            let mo1Blocks = [];
                            let mo1SelectedBlockType = null;
                            let mo1BlockIdCounter = 0;

                            const MO1_BLOCK_TYPES = [
                                { type: 'text',     label: 'Text',        icon: '🔤', badge: 'primary' },
                                { type: 'textarea', label: 'Rich Editor',  icon: '📝', badge: 'success' },
                                { type: 'image',    label: 'Image URL',    icon: '🖼️', badge: 'warning' },
                                { type: 'date',     label: 'Date',         icon: '📅', badge: 'danger' },
                                { type: 'color',    label: 'Color',        icon: '🎨', badge: 'info' },
                                { type: 'number',   label: 'Number',       icon: '🔢', badge: 'secondary' },
                            ];

                            function mo1OpenBlockModal() {
                                mo1SelectedBlockType = null;
                                document.getElementById('mo1BlockLabelRow').style.display = 'none';
                                document.getElementById('mo1BlockLabelInput').value = '';

                                const grid = document.getElementById('mo1TypePickerGrid');
                                grid.innerHTML = MO1_BLOCK_TYPES.map(t => `
                                    <div class="col-4 mb-3">
                                        <div class="card border mo1-type-card text-center py-3 px-2" style="cursor:pointer"
                                            data-type="${t.type}" onclick="mo1SelectBlockType('${t.type}', this)">
                                            <div style="font-size:24px">${t.icon}</div>
                                            <div class="small mt-1">${t.label}</div>
                                        </div>
                                    </div>
                                `).join('');
                                document.getElementById('mo1BlockTypeModal').style.display = 'flex';
                            }

                            function mo1CloseBlockModal() {
                                document.getElementById('mo1BlockTypeModal').style.display = 'none';
                            }

                            function mo1SelectBlockType(type, el) {
                                mo1SelectedBlockType = type;
                                document.querySelectorAll('.mo1-type-card').forEach(c => {
                                    c.classList.remove('border-primary', 'shadow-sm');
                                });
                                el.classList.add('border-primary', 'shadow-sm');
                                document.getElementById('mo1BlockLabelRow').style.display = 'block';
                                document.getElementById('mo1BlockLabelInput').focus();
                            }

                            function mo1ConfirmBlock() {
                                if (!mo1SelectedBlockType) {
                                    alert('Please select a block type.');
                                    return;
                                }
                                const label = document.getElementById('mo1BlockLabelInput').value.trim();
                                if (!label) {
                                    alert('Please enter a field label.');
                                    return;
                                }
                                const id = ++mo1BlockIdCounter;
                                mo1Blocks.push({ id, type: mo1SelectedBlockType, value: '', label });
                                mo1CloseBlockModal();
                                mo1RenderBlocks();
                            }

                            function mo1RemoveBlock(id) {
                                mo1Blocks.forEach(b => {
                                    if (b.type === 'textarea') {
                                        const ed = tinymce.get('mo1_editor_' + b.id);
                                        if (ed) b.value = ed.getContent();
                                    }
                                });
                                mo1Blocks = mo1Blocks.filter(b => b.id !== id);
                                mo1RenderBlocks();
                            }

                            function mo1MoveBlock(id, dir) {
                                mo1Blocks.forEach(b => {
                                    if (b.type === 'textarea') {
                                        const ed = tinymce.get('mo1_editor_' + b.id);
                                        if (ed) b.value = ed.getContent();
                                    }
                                });
                                const i = mo1Blocks.findIndex(b => b.id === id);
                                const swapIdx = dir === 'up' ? i - 1 : i + 1;
                                if (swapIdx < 0 || swapIdx >= mo1Blocks.length) return;
                                [mo1Blocks[i], mo1Blocks[swapIdx]] = [mo1Blocks[swapIdx], mo1Blocks[i]];
                                mo1RenderBlocks();
                            }

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
                                // Only remove TinyMCE instances belonging to mo1
                                mo1Blocks.forEach(b => {
                                    if (b.type === 'textarea') {
                                        const ed = tinymce.get('mo1_editor_' + b.id);
                                        if (ed) ed.remove();
                                    }
                                });
                                // Also clean up any orphaned mo1 editors
                                document.querySelectorAll('.mo1-tinymce-block').forEach(el => {
                                    const ed = tinymce.get(el.id);
                                    if (ed) ed.remove();
                                });

                                const area = document.getElementById('mo1BlockArea');
                                area.innerHTML = '';

                                mo1Blocks.forEach(b => {
                                    let fieldHTML = '';

                                    if (b.type === 'text') {
                                        fieldHTML = `<input type="text" class="form-control form-control-user labelBalloon"
                                            placeholder="Enter text..."
                                            value="${mo1EscHtml(b.value)}"
                                            onchange="mo1UpdateBlockVal(${b.id}, this.value)">`;

                                    } else if (b.type === 'textarea') {
                                        fieldHTML = `<textarea id="mo1_editor_${b.id}" class="mo1-tinymce-block form-control"
                                            style="height:300px">${mo1EscHtml(b.value)}</textarea>`;

                                    } else if (b.type === 'image') {
                                        fieldHTML = `
                                            <input type="text" class="form-control form-control-user labelBalloon mb-2"
                                                placeholder="https://example.com/image.jpg"
                                                value="${mo1EscHtml(b.value)}"
                                                onchange="mo1UpdateBlockVal(${b.id}, this.value)">
                                            ${b.value ? `<img src="${mo1EscHtml(b.value)}" style="max-height:120px;border-radius:6px;border:1px solid #ddd">` : ''}`;

                                    } else if (b.type === 'date') {
                                        fieldHTML = `<input type="date" class="form-control form-control-user labelBalloon"
                                            value="${mo1EscHtml(b.value)}"
                                            onchange="mo1UpdateBlockVal(${b.id}, this.value)">`;

                                    } else if (b.type === 'color') {
                                        fieldHTML = `
                                            <div class="d-flex align-items-center gap-2">
                                                <input type="color" class="form-control form-control-color"
                                                    value="${b.value || '#3B82F6'}"
                                                    oninput="mo1UpdateBlockVal(${b.id}, this.value); document.getElementById('mo1ColorHex_${b.id}').textContent = this.value">
                                                <span id="mo1ColorHex_${b.id}" class="text-muted small">${b.value || '#3B82F6'}</span>
                                            </div>`;

                                    } else if (b.type === 'number') {
                                        fieldHTML = `<input type="number" class="form-control form-control-user labelBalloon"
                                            placeholder="0"
                                            value="${mo1EscHtml(b.value)}"
                                            onchange="mo1UpdateBlockVal(${b.id}, this.value)">`;
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
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="fw-semibold small badge bg-${typeBadges[b.type]}">${mo1EscHtml(b.label)}</span>
                                            </div>
                                            <div class="d-flex gap-1">
                                                <button type="button" class="mr-1 btn btn-sm badge bg-${typeBadges[b.type]}">Type: ${typeLabels[b.type]}</button>
                                                <button type="button" class="mr-1 btn btn-outline-secondary btn-sm"
                                                    onclick="mo1MoveBlock(${b.id},'up')">↑</button>
                                                <button type="button" class="mr-1 btn btn-outline-secondary btn-sm"
                                                    onclick="mo1MoveBlock(${b.id},'down')">↓</button>
                                                <button type="button" class="mr-1 btn btn-outline-danger btn-sm"
                                                    onclick="mo1RemoveBlock(${b.id})">Delete</button>
                                            </div>
                                        </div>
                                        <div class="card-body py-2 px-3 d-none">${fieldHTML}</div>
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
                                    .replace(/&/g,'&amp;').replace(/"/g,'&quot;')
                                    .replace(/</g,'&lt;').replace(/>/g,'&gt;');
                            }

                            function mo1InitBlockEditors() {
                                const textareaBlocks = mo1Blocks.filter(b => b.type === 'textarea');
                                if (!textareaBlocks.length) return;

                                tinymce.init({
                                    selector: '.mo1-tinymce-block',
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
                            });
                            </script>
                            <!-- ---------------Block System: more_option_1------------------- -->

                        </div>
                    </div>
                    
                    <!-- more_option_2 -->
                     <div class="border p-3 mb-3">
                        <div class="card mb-2">
                            <div class="card-header d-flex align-items-center justify-content-between py-2 px-3" style="background:#f8f9fa">
                                <div class="d-flex align-items-center gap-2">
                                    <label>Mutiple Fields: `more_option_2` <a href="https://larapress.org/en/documentation/block-multiple-fields" target="_blank">Learn More</a></label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">

                            <!-- ---------------Block System: more_option_2------------------- -->
                            <div id="mo2BlockArea"></div>

                            <div class="text-center mt-2">
                                <button type="button" class="btn btn-primary btn-user btn-block" onclick="mo2OpenBlockModal()">
                                    ➕ Add Multi Block
                                </button>
                            </div>

                            <input type="hidden" name="more_option_2" value="#" id="mo2ContentIF">

                            <!-- Type Picker Modal -->
                            <div id="mo2BlockTypeModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.45);z-index:9999;align-items:center;justify-content:center;">
                                <div style="background:#fff;border-radius:12px;padding:24px;width:400px;box-shadow:0 8px 32px rgba(0,0,0,.15)">
                                    <h6 class="mb-1 fw-semibold">Choose block type</h6>
                                    <p class="text-muted small mb-3">Select the kind of content to add</p>
                                    <div class="row g-2 mb-3" id="mo2TypePickerGrid"></div>

                                    <div id="mo2BlockLabelRow" style="display:none;" class="mb-3">
                                        <label class="form-label small fw-semibold">Field Label</label>
                                        <input type="text" id="mo2BlockLabelInput" class="form-control form-control-sm"
                                            placeholder="e.g. Title, Description, Cover Image...">
                                    </div>

                                    <div class="d-flex gap-2 justify-content-end">
                                        <p class="btn btn-outline-secondary btn-sm mr-2" onclick="mo2CloseBlockModal()">Cancel</p>
                                        <p class="btn btn-primary btn-sm" onclick="mo2ConfirmBlock()">Add Block</p>
                                    </div>
                                </div>
                            </div>

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

                            function mo2OpenBlockModal() {
                                mo2SelectedBlockType = null;
                                document.getElementById('mo2BlockLabelRow').style.display = 'none';
                                document.getElementById('mo2BlockLabelInput').value = '';
                                const grid = document.getElementById('mo2TypePickerGrid');
                                grid.innerHTML = MO2_BLOCK_TYPES.map(t => `
                                    <div class="col-4 mb-3">
                                        <div class="card border mo2-type-card text-center py-3 px-2" style="cursor:pointer"
                                            data-type="${t.type}" onclick="mo2SelectBlockType('${t.type}', this)">
                                            <div style="font-size:24px">${t.icon}</div>
                                            <div class="small mt-1">${t.label}</div>
                                        </div>
                                    </div>
                                `).join('');
                                document.getElementById('mo2BlockTypeModal').style.display = 'flex';
                            }

                            function mo2CloseBlockModal() {
                                document.getElementById('mo2BlockTypeModal').style.display = 'none';
                            }

                            function mo2SelectBlockType(type, el) {
                                mo2SelectedBlockType = type;
                                document.querySelectorAll('.mo2-type-card').forEach(c =>
                                    c.classList.remove('border-primary', 'shadow-sm')
                                );
                                el.classList.add('border-primary', 'shadow-sm');
                                document.getElementById('mo2BlockLabelRow').style.display = 'block';
                                document.getElementById('mo2BlockLabelInput').focus();
                            }

                            function mo2ConfirmBlock() {
                                if (!mo2SelectedBlockType) { alert('Please select a block type.'); return; }
                                const label = document.getElementById('mo2BlockLabelInput').value.trim();
                                if (!label) { alert('Please enter a field label.'); return; }
                                const id = ++mo2BlockIdCounter;
                                mo2Blocks.push({ id, type: mo2SelectedBlockType, value: '', label });
                                mo2CloseBlockModal();
                                mo2RenderBlocks();
                            }

                            function mo2RemoveBlock(id) {
                                mo2Blocks.forEach(b => {
                                    if (b.type === 'textarea') {
                                        const ed = tinymce.get('mo2_editor_' + b.id);
                                        if (ed) b.value = ed.getContent();
                                    }
                                });
                                mo2Blocks = mo2Blocks.filter(b => b.id !== id);
                                mo2RenderBlocks();
                            }

                            function mo2MoveBlock(id, dir) {
                                mo2Blocks.forEach(b => {
                                    if (b.type === 'textarea') {
                                        const ed = tinymce.get('mo2_editor_' + b.id);
                                        if (ed) b.value = ed.getContent();
                                    }
                                });
                                const i = mo2Blocks.findIndex(b => b.id === id);
                                const swapIdx = dir === 'up' ? i - 1 : i + 1;
                                if (swapIdx < 0 || swapIdx >= mo2Blocks.length) return;
                                [mo2Blocks[i], mo2Blocks[swapIdx]] = [mo2Blocks[swapIdx], mo2Blocks[i]];
                                mo2RenderBlocks();
                            }

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
                                const typeLabels  = { text:'Text', textarea:'Rich Editor', image:'Image', date:'Date', color:'Color', number:'Number' };

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
                                            <div class="d-flex gap-1">
                                                <button type="button" class="mr-1 btn btn-sm badge bg-${typeBadges[b.type]}">Type: ${typeLabels[b.type]}</button>
                                                <button type="button" class="mr-1 btn btn-outline-secondary btn-sm" onclick="mo2MoveBlock(${b.id},'up')">↑</button>
                                                <button type="button" class="mr-1 btn btn-outline-secondary btn-sm" onclick="mo2MoveBlock(${b.id},'down')">↓</button>
                                                <button type="button" class="mr-1 btn btn-outline-danger btn-sm" onclick="mo2RemoveBlock(${b.id})">Delete</button>
                                            </div>
                                        </div>
                                        <div class="card-body py-2 px-3 d-none">${fieldHTML}</div>
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
                            });
                            </script>
                            <!-- ---------------Block System: more_option_2------------------- -->

                        </div>
                    </div>

                     

                    <label for="basic-url">If you visible this fields please input your placeholder. Turn off # Code: gallery_img</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text badge-danger"><i class="fa fa-times" aria-hidden="true"></i></span>
                            <span class="input-group-text">gallery_img</span>
                        </div>
                        <input type="text" name="gallery_img" class="form-control form-control-user" value="#">
                    </div>

                    <label for="basic-url">If you visible this fields please input your placeholder. Turn off # Code: category_id</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text badge-danger"><i class="fa fa-times" aria-hidden="true"></i></span>
                            <span class="input-group-text">category_id</span>
                        </div>
                        <input type="text" name="category_id" class="form-control form-control-user" value="#">
                    </div>

                    <label for="basic-url">Template Design Turn On Off also set your single page template.</label>
                    <div class="input-group">
                        <label class="switch">
                            <input type="checkbox" id="templateSwitch" checked>
                            <span class="sliderswitch round"></span>
                        </label>
                    </div>
                    
                </div>
            </div> 
        </div>
        <div class="col-xl-3 col-lg-4">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Publish</h6>                
                </div>            
                <div class="card-body"> 
                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0">
                            <input type="text" name='paginate' class="form-control form-control-user" id="exampleFirstName" placeholder="100">
                        </div> 
                    </div> 
                    <div class="form-group row">                        
                        <div class="col-sm-12 mb-3 mb-sm-0">
                            <select class="form-control form-control-user form-select form-select-sm custom-select" aria-label=".form-select-sm example" name="status">
                            <option value="1">Publish</option>
                            <option value="0">Unpublish</option>
                            </select>
                        </div> 
                    </div> 
                    <div class="text-center mt-2">
                        <button type="submit" class="btn btn-primary btn-user btn-block">Create</button>                    
                    </div>
                    @foreach ($errors->all() as $message)
                    {{ $message }}
                    @endforeach
                </div>   
            </div>

            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Thumbnails</h6>                
                </div>
                <!-- Card Body -->
                <div class="card-body">                    
                    <div class="form-group">                       
                            <input type="hidden" id="posttype_img_type" name='pt_thumbnail_path' placeholder="Image Url" class="form-control" >
                            <img id="posttype_img" src="{{ asset('packages/larapress/src/Assets/admin/img/dummy-image-square.jpg') }}" width="100%" height="auto" data-toggle="modal" data-target="#exampleModalCenter" class="border border-info" data-preview="posttype_img">
                            <button type="button" onclick="removeValue('{{url('/packages/larapress/src/Assets/admin/img/dummy-image-square.jpg')}}','posttype_img')" class="btn btn-secondary btn-sm mt-3">Remove Images</button>                        
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Display Options</h6>                
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <!-- Display Options -->
                    <div class="form-group">
                        <label for="basic-url">Main menu. Turn On Off</label>
                        <div class="input-group mb-3">
                            <label class="switch">
                                <input type="checkbox" name="in_menu_swh" value="1" checked>
                                <span class="sliderswitch round"></span>
                            </label>
                        </div>
                        <label for="basic-url">Dashboard Turn On Off</label>
                        <div class="input-group mb-3">
                            <label class="switch">
                                <input type="checkbox" name="in_dashboard" value="1" checked>
                                <span class="sliderswitch round"></span>
                            </label>
                        </div> 
                    </div>
                    <label for="basic-url">Main Categories</label>
                    <div class="form-group">
                        <select class="form-control form-control-user form-select form-select-sm custom-select" aria-label=".form-select-sm example" name="category_main_id">
                            <option value="0" selected>No Categories</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>                       
                        
                    <label for="basic-url">Select menu name or create</label>
                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0">
                            <input type="text" name="menu_icon" class="form-control form-control-user">
                            
                            @foreach($posttypesD as $posttype)
                                @if($posttype->menu_icon)
                                <div class="form-check" style="display:inline-block">
                                <input class="form-check-input" name="menu_icon" type="checkbox" value="{{$posttype->menu_icon}}" id="for{{$posttype->menu_icon}}">
                                <label class="form-check-label" for="for{{$posttype->menu_icon}}">
                                    {{$posttype->menu_icon}}
                                </label>
                                </div>
                                @endif
                            @endforeach
                        </div> 
                    </div>                            
                    <!-- Display Options -->  
                </div>
            </div>  
        </div>
    </div> 

    <!-- The div you want to show/hide -->    
    <input type="hidden" name="template" value="single" id="lp-orderInput">
    <div id="templateDiv" class="row">
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
    </div>

    <script>
    document.getElementById("templateSwitch").addEventListener("change", function() {
        if (this.checked) {
            document.getElementById("templateDiv").style.display = "flex";
        } else {
            document.getElementById("templateDiv").style.display = "none";
            document.getElementById("lp-orderInput").value = "";
        }
    });
    </script>

    <!-- dynamic set input fields -->
    <script>                            
        document.addEventListener('DOMContentLoaded', function () {
            const existingValues = {
                excerpt_type: "none",        // current type
                excerpt_label: "New Label", // existing value 
                excerpt_value: "Option1,Option2", // existing value 
                excerpt_required: 1,

                option_1_type: "none",
                options_1_label: "New Label",
                options_1_value: "Checkbox1, Checkbox2",
                options_1_required: 1,

                option_2_type: "none",
                options_2_label: "New Label",
                options_2_value: "Checkbox1, Checkbox2",
                options_2_required: 1,                

                option_3_type: "none",
                options_3_label: "New Label",
                options_3_value: "Checkbox1, Checkbox2",
                options_3_required: 1,                

                option_4_type: "none",
                options_4_label: "New Label",
                options_4_value: "Checkbox1, Checkbox2",
                options_4_required: 1
            };

           
            // let type = this.value;
            function renderField(type, container, fieldName='', existingLabel='', value = '', existingRequired='') {               
            container.innerHTML = ''; // clear old input

            if(type === 'select') {
                container.innerHTML = `
                    <div class="card p-3 mb-3">
                        <!-- Field Label -->
                        <div class="mb-3">
                            <label class="form-label">Field Label</label>
                            <input type="text"
                                name="${fieldName}_label"
                                class="form-control form-control-user"
                                placeholder="Enter field label (e.g., Select Size)"
                                value="${existingLabel}" required>
                        </div>

                        <!-- Field Values -->
                        <div class="mb-3 tags-input-wrapper">
                            <label class="form-label">Field Options (comma separated)</label>                          
                            
                            <div class="tags-input">
                                <input type="text" class="form-control form-control-user" placeholder="Type and press enter: Small,Medium,Large">
                            </div>
                            <input type="hidden" name="${fieldName}_value" value="${value}">

                            <small class="text-muted">
                                Use comma (,) to separate values
                            </small>                          
                                
                        </div>

                        <!-- Required Checkbox -->
                        <div class="form-check">
                            <input type="checkbox"
                                name="${fieldName}_required"
                                value="1" 
                                ${existingRequired == 1 ? 'checked' : ''}
                                class="form-check-input"
                                id="${fieldName}Required">

                            <label class="form-check-label" for="${fieldName}Required">
                                This field is required
                            </label>
                        </div>
                    </div>
                `;
            }
            else if(type === 'checkbox') {
                container.innerHTML = `                                        
                    <div class="card p-3 mb-3">
                        <!-- Field Label -->
                        <div class="mb-3">
                            <label class="form-label">Checkbox Group Label</label>
                            <input type="text"
                                name="${fieldName}_label"
                                class="form-control form-control-user"
                                placeholder="Example: Select Features"
                                value="${existingLabel}" required>
                        </div>

                        <!-- Checkbox Options -->
                        <div class="mb-3 tags-input-wrapper">
                            <label class="form-label">Checkbox Options (comma separated)</label>                            

                            <div class="tags-input">
                                <input type="text" class="form-control form-control-user" placeholder="Type and press enter: Wifi,Parking,AC">
                            </div>
                            <input type="hidden" name="${fieldName}_value" value="${value}">

                            <small class="text-muted">
                                Use comma (,) to separate each checkbox option
                            </small>
                        </div>

                        <!-- Required Toggle -->
                        <div class="form-check form-switch">
                            <input class="form-check-input"
                                type="checkbox"
                                name="${fieldName}_required"
                                value="1"
                                ${existingRequired == 1 ? 'checked' : ''}
                                id="${fieldName}checkboxRequired">

                            <label class="form-check-label" for="${fieldName}checkboxRequired">
                                Make this field required
                            </label>
                        </div>

                    </div>
                `;
            }
            else if(type === 'radio') {
                container.innerHTML = `
                    <div class="card p-3 mb-3">
                        <!-- Field Label -->
                        <div class="mb-3">
                            <label class="form-label">Radio Group Label</label>
                            <input type="text"
                                name="${fieldName}_label"
                                class="form-control form-control-user"
                                placeholder="Example: Select Gender"
                                value="${existingLabel}" required>
                        </div>

                        <!-- Radio Options -->
                        <div class="mb-3 tags-input-wrapper">
                            <label class="form-label">Radio Options (comma separated)</label>                           
                            
                            <div class="tags-input">
                                <input type="text" class="form-control form-control-user" placeholder="Type and press enter: Male,Female,Other">
                            </div>
                            <input type="hidden" name="${fieldName}_value" value="${value}">

                            <small class="text-muted">
                                Separate each option using comma (,)
                            </small>
                        </div>

                        <!-- Required Switch -->
                        <div class="form-check form-switch">
                            <input class="form-check-input"
                                type="checkbox"
                                name="${fieldName}_required"
                                value="1"
                                ${existingRequired == 1 ? 'checked' : ''}
                                id="${fieldName}radioRequired">

                            <label class="form-check-label" for="${fieldName}radioRequired">
                                Make this ${type} field required
                            </label>
                        </div>

                    </div>
                `;
            }
            else if(type === 'image') {
                container.innerHTML = `
                    <div class="card p-3 mb-3">
                        <!-- Field Label -->
                        <div class="mb-3">
                            <label class="form-label">Image Label</label>
                            <input type="text"
                                name="${fieldName}_label"
                                class="form-control form-control-user"
                                placeholder="Example: Post Thumb."
                                value="${existingLabel}" required>
                        </div>                                                                                                                                 
                        <input type="hidden" name="${fieldName}_value" value="img">                                          

                        <!-- Required Switch -->
                        <div class="form-check form-switch">
                            <input class="form-check-input"
                                type="checkbox"
                                name="${fieldName}_required"
                                value="1"
                                ${existingRequired == 1 ? 'checked' : ''}
                                id="${fieldName}radioRequired">

                            <label class="form-check-label" for="${fieldName}radioRequired">
                                Make this ${type} field required
                            </label>
                        </div>
                    </div>
                `;
            }else if(type === 'none') {
                container.innerHTML = `
                <input type="hidden" name="${fieldName}_label" value="none">
                <input type="hidden" name="${fieldName}_value" value="none">
                <input type="hidden" name="${fieldName}_required" value="1">
                `;
            }else if(type === 'posttype') {
                container.innerHTML = `
                    <div class="card p-3 mb-3">
                        <!-- Field Label -->
                        <div class="mb-3">
                            <label class="form-label">Field Label</label>
                            <input type="text"
                                name="${fieldName}_label"
                                class="form-control form-control-user"
                                placeholder="Enter field label"
                                value="${existingLabel}" required>
                        </div>

                        <!-- Field Values -->
                        <div class="mb-3 tags-input-wrapper">
                            <label class="form-label">Field Options</label>   
                            <div class="tags-input">
                                <select name="${fieldName}_value" class="dynamic-field-type form-select form-select-sm custom-select">
                                    @foreach($posttypes as $posttype)                                    
                                        <option value="{{$posttype->slug}}">{{$posttype->name}}</option>
                                    @endforeach
                                </select>                                
                            </div> 
                        </div>  

                        <!-- Required Checkbox -->
                        <div class="form-check">
                            <input type="checkbox"
                                name="${fieldName}_required"
                                value="1" 
                                ${existingRequired == 1 ? 'checked' : ''}
                                class="form-check-input"
                                id="${fieldName}Required">

                            <label class="form-check-label" for="${fieldName}Required">
                                This field is required
                            </label>
                        </div>
                    </div>
                `;
            }else {
                container.innerHTML = `
                    <div class="card p-3 mb-3">
                        <!-- Field Label -->
                        <div class="mb-3">
                            <label class="form-label">${type} Label</label>
                            <input type="text"
                                name="${fieldName}_label"
                                class="form-control form-control-user"
                                placeholder="Example: Title"
                                value="${existingLabel}" required>
                        </div>

                        <!-- Radio Options -->
                        <div class="mb-3">
                            <label class="form-label">Placeholder</label>
                            <input type="text"
                                name="${fieldName}_value"
                                class="form-control form-control-user"
                                placeholder=" "
                                value="${value}" required>                                                 
                        </div>

                        <!-- Required Switch -->
                        <div class="form-check form-switch">
                            <input class="form-check-input"
                                type="checkbox"
                                name="${fieldName}_required"
                                value="1"
                                ${existingRequired == 1 ? 'checked' : ''}
                                id="${fieldName}radioRequired">

                            <label class="form-check-label" for="${fieldName}radioRequired">
                                Make this ${type} field required
                            </label>
                        </div>
                    </div>                    
                `;                 
            }
            initAllTags();
        }
        document.querySelectorAll('.dynamic-field-type')
        .forEach(function(selectField) {

            let targetId  = selectField.dataset.target;
            let container = document.getElementById(targetId);                                   

            // Get pre-filled value if editing
            let fieldName = selectField.name; // like 'excerpt_type' or 'Options_1_type'            

            let baseName = fieldName.replace('_type', '');
            let existingLabel    = existingValues[baseName + '_label'] || '';
            let existingValue    = existingValues[baseName + '_value'] || '';
            let existingRequired = existingValues[baseName + '_required'] || '';

            console.log('Label:', existingLabel);
            console.log('Value:', existingValue);
            console.log('Required:', existingRequired);
            
            // Set the select value (in case it is editing)
            if (existingValues[fieldName]) {
                selectField.value = existingValues[fieldName];
            }

            // Initial render on page load
            renderField(selectField.value, container, fieldName, existingLabel, existingValue, existingRequired);

            // on change
            selectField.addEventListener('change', function () {
                
                renderField(this.value, container, fieldName, existingLabel, existingValue, existingRequired);
                //alert(this.value);
            });
            
        });

        });
    </script>
    <!-- dynamic set input fields -->
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