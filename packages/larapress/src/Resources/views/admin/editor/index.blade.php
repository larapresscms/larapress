@extends('admin.layouts.master')
@section('content')
<form class="user">
    <div class="row">
        <!-- Area Chart -->
        <div class="col-xl-9 col-lg-8">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown --> 
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">                    
                    <h6 class="m-0 font-weight-bold text-primary">    
                        <div class="mb-3"> 
                                    <p id="btn-delete" class="btn btn-danger btn-user">Delete</p>
                                    <p id="btn-download" class="btn btn-outline-secondary btn-user">Download</p>                                 
                                <!-- <button id="btn-preview" class="btn btn-outline-primary btn-sm">Preview</button> -->
                            </div>                    
                        <!-- Editor actions -->
                        <div style="align-items:center; gap:8px; margin-bottom:6px;"> 
                            <div><strong id="currentPath">No file</strong></div>
                        </div>
                    </h6>                
                </div>
                <!-- Card Body -->
                <div class="card-body">                     
                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0">  
                            <div style="flex:1; display:flex; flex-direction:column; height:80vh">
                                <!-- Breadcrumbs -->  
                                <div style="flex:1; display:flex; gap:6px;">
                                    <div id="editor" style="flex:1; height:100%; border:1px solid #ddd;"></div>
                                    <!-- <iframe id="previewFrame" style="flex:1; height:100%; border:1px solid #ccc;"></iframe> -->
                                </div>
                            </div>
                            <!-- Editor + Preview -->   
                        </div> 
                    </div>
                    <!-- editor -->  
                </div>
            </div>            
        </div>
        <!-- Pie Chart -->
        <div class="col-xl-3 col-lg-4">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Files</h6>                
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="form-group row"> 
                        <div class="col-sm-12 mb-3 mb-sm-0"> 
                            <div class="text-center mb-3"> 
                                <p id="btn-new-file" class="btn btn-primary btn-user">New File</p>
                                <p id="btn-new-dir" class="btn btn-info btn-user">New Folder</p>  
                            </div>                        
                            <!-- Sidebar -->                             
                            <div id="breadcrumbs" style="margin-bottom:6px; display:flex; gap:4px; flex-wrap:wrap;"></div>
                            <div>                          
                                <div id="fileTree" class="overflow-scroll"></div>
                            </div>  
                        </div>
                    </div>   
                    <div class="text-center">
                        <p id="btn-save" class="btn btn-primary btn-user btn-block">Save File</p>
                    </div> 
                </div>
            </div>   
        </div>    

    </div>
</form>

<style>
.selected-item {
    background-color: #2b2b2b;
    color: #fff;
    border-radius: 4px;
    padding: 2px 4px;
}
</style>

<script>
let editor = null;
let editorReady = false;
let editorQueue = []; // queue of code to set
let selectedItem = null;  // track selected element
let expandedPaths = new Set(); // track expanded folders
let currentFile = null;
let currentDir = @json($basePath); // root by default

// Init Monaco
function initMonaco(initialValue='') {
    require.config({ paths: { 'vs': "{{ asset('packages/larapress/src/Assets/admin/monaco-editor')}}" }});
    require(['vs/editor/editor.main'], function() {
        editor = monaco.editor.create(document.getElementById('editor'), {
            value: initialValue,
            language: 'plaintext',
            theme: 'vs-white',
            automaticLayout: true,
            minimap: { enabled: false },
            wordWrap: 'on',            // ✅ enables wrap-content
            wordWrapColumn: 80,        // optional: wraps after 80 chars
            wrappingIndent: 'same',     // 'same' | 'indent' | 'deepIndent'   
            quickSuggestions: { other: true, comments: true, strings: true },
            parameterHints: { enabled: true },
            suggestOnTriggerCharacters: true,
            acceptSuggestionOnEnter: 'on',
            tabCompletion: 'on',
            wordBasedSuggestions: true,
            snippetSuggestions: 'inline',
        });
        editorReady = true;
        // Process any queued code
        editorQueue.forEach(code => editor.setValue(code));
        editorQueue = [];         
    });
}

function detectLang(filename) {
    if (!filename) return 'plaintext';
    if (filename.endsWith('.js')) return 'javascript';
    if (filename.endsWith('.css')) return 'css';
    if (filename.endsWith('.html')||filename.endsWith('.htm')) return 'html';
    if (filename.endsWith('.php')) return 'php';
    if (filename.endsWith('.json')) return 'json';
    if (filename.endsWith('.md')) return 'markdown';
    return 'plaintext';
}

// Load tree
async function loadTree() {
    const res = await fetch('{{ route("editor.tree") }}');
    const data = await res.json();
    const container = document.getElementById('fileTree');
    container.innerHTML = '';
    renderTree(data, container);    
}

// Recursive tree render
function renderTree(items, parent) {
    const ul = document.createElement('ul');
    ul.style.listStyle = 'none';
    ul.style.paddingLeft = '16px';
    ul.style.maxHeight = '65vh';
    ul.style.overflowY = 'scroll'; 

    items.forEach(i => {
        const li = document.createElement('li');
        li.dataset.path = i.path;
        li.style.cursor = 'pointer';
        li.classList.add('tree-item');

        const span = document.createElement('span');
        span.textContent = i.is_dir ? '📁 ' + i.name : '📄 ' + i.name;
        li.appendChild(span);

        li.onclick = (event) => {
            event.stopPropagation();

            // Highlight selection
            if (selectedItem) selectedItem.classList.remove('selected-item');
            li.classList.add('selected-item');
            selectedItem = li;
            selectedItemPath = i.path; // ✅ store selected path

            // Update current directory
            if (i.is_dir) {
                currentDir = i.path;
            } else {
                currentDir = i.path.substring(0, i.path.lastIndexOf('/'));
            }

            // Handle expand/collapse
            if (i.is_dir) {
                li.classList.toggle('expanded');

                if (li.classList.contains('expanded')) {
                    expandedPaths.add(i.path); // ✅ mark as expanded
                } else {
                    expandedPaths.delete(i.path); // ✅ remove if collapsed
                }

                if (!li.dataset.loaded) {
                    renderTree(i.children, li);
                    li.dataset.loaded = true;
                } else {
                    const sub = li.querySelector('ul');
                    if (sub) sub.style.display = sub.style.display === 'none' ? 'block' : 'none';
                }
            } else {
                openFile(i.path);
            }
        };


        ul.appendChild(li);
    });

    parent.appendChild(ul);
}

// Open file
async function openFile(path){
    currentFile=path; document.getElementById('currentPath').textContent=path;
    const res=await fetch('{{ route("editor.read") }}?file='+encodeURIComponent(path));
    const json=await res.json();
    if(json.error){ alert(json.error); return; }
    setEditorContent(json.content, path);
    loadBreadcrumbs(path);
}

// Set editor content & language
/* function setEditorContent(code,filename){
    const lang=detectLang(filename);
    if(!editor) initMonaco(code);
    editor.setValue(code);
    if(editor) monaco.editor.setModelLanguage(editor.getModel(),lang);
} */

    // Set content safely
function setEditorContent(code, filename) {
    const lang = detectLang(filename);

    if (!editorReady) {
        // Queue the code until editor is ready
        editorQueue.push(code);
        if (!editor) initMonaco(code);
        return;
    }

    editor.setValue(code);
    monaco.editor.setModelLanguage(editor.getModel(), lang);
}

// Breadcrumbs
async function loadBreadcrumbs(path){
    const res=await fetch('{{ route("editor.breadcrumbs") }}?path='+encodeURIComponent(path));
    const json=await res.json();
    const bc=document.getElementById('breadcrumbs'); bc.innerHTML='';
    json.forEach(b=>{
        const span=document.createElement('span'); span.style.cursor='pointer'; span.style.color='blue';
        span.textContent=b.name; span.onclick=()=>loadTree();
        bc.appendChild(span); bc.appendChild(document.createTextNode(' / '));
    });
}

// Save
// document.getElementById('btn-save').addEventListener('click', async ()=>{
//     if(!currentFile) return alert('No file open');
//     const form=new FormData(); form.append('_token','{{ csrf_token() }}'); form.append('file',currentFile); form.append('content',editor.getValue());
//     const res=await fetch('{{ route("editor.save") }}',{method:'POST',body:form});
//     const json=await res.json(); alert(json.success?'Saved ✓':(json.error||'Error'));
// });





document.getElementById('btn-save').addEventListener('click', async () => {
    if (!currentFile) return alert('No file open');

    const form = new FormData();
    form.append('_token', '{{ csrf_token() }}');
    form.append('file', currentFile);
    form.append('content', editor.getValue());

    const res = await fetch('{{ route("editor.save") }}', { method: 'POST', body: form });
    const json = await res.json();
    alert(json.success?'Saved ✓':(json.error||'Error'));
    // Remove existing alerts first (optional)
    document.querySelectorAll('.dynamic-alert').forEach(e => e.remove());

    // Create a new alert div
    const alertDiv = document.createElement('div');
    const type = json.success ? 'success' : 'danger';
    const message = json.success ? 'Saved ✓' : (json.error || 'Error');

    alertDiv.className = `
        dynamic-alert text-capitalize alert alert-dismissible fade show 
        border-${type} border-left border-width-4 px-4 py-3 mx-3 mb-3 bg-white text-black shadow-sm animated flipInX delay-02s
    `;
    alertDiv.role = 'alert';
    alertDiv.innerHTML = `
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <i class="fas fa-exclamation opacity-05 mr-3 text-${type}"></i>
        ${message}
    `;

    // Append it where you show alerts (same place as your Blade alerts)
    const container = document.querySelector('#alert-container') || document.body;
    container.prepend(alertDiv);
});





















// Download
document.getElementById('btn-download').addEventListener('click',()=>{ if(!currentFile) return alert('No file open'); window.open('{{ route("editor.download") }}?file='+encodeURIComponent(currentFile)); });

// Preview
// document.getElementById('btn-preview').addEventListener('click',()=>{ if(!currentFile) return alert('No file open'); document.getElementById('previewFrame').src='{{ route("editor.preview") }}?file='+encodeURIComponent(currentFile); });

// New file/folder buttons (reuse previous logic)
document.getElementById('btn-new-file').addEventListener('click', async ()=>{
    const name=prompt('File name'); if(!name)return; const dir=prompt('Parent folder',currentDir )||currentDir ;
    const form=new FormData(); form.append('_token','{{ csrf_token() }}'); form.append('dir',dir); form.append('name',name);
    const res=await fetch('{{ route("editor.createFile") }}',{method:'POST',body:form}); const json=await res.json(); alert(json.success?'File created':json.error||'Error'); loadTree();
});
document.getElementById('btn-new-dir').addEventListener('click', async ()=>{
    const name=prompt('Folder name'); if(!name)return; const dir=prompt('Parent folder',currentDir )||currentDir ;
    const form=new FormData(); form.append('_token','{{ csrf_token() }}'); form.append('dir',dir); form.append('name',name);
    const res=await fetch('{{ route("editor.createDir") }}',{method:'POST',body:form}); const json=await res.json(); alert(json.success?'Folder created':json.error||'Error'); loadTree();
});
// Init
window.addEventListener('DOMContentLoaded', loadTree);
// rename
document.addEventListener('contextmenu', (e) => {
    if (e.target.closest('.tree-item')) {
        e.preventDefault();
        const item = e.target.closest('.tree-item');
        selectedItemPath = item.dataset.path;
        const oldName = item.textContent.replace('📁 ', '').replace('📄 ', '');
        const newName = prompt('Rename', oldName);
        if (!newName || newName === oldName) return;        
        renameItem(selectedItemPath, newName);
    }
});
async function renameItem(pathN, newName) {    
    const form = new FormData();
    form.append('_token', '{{ csrf_token() }}');  
    form.append('pathN', pathN);
    form.append('newName', newName);
    const res = await fetch('{{ route("editor.rename") }}', { method: 'POST', body: form });
    const json = await res.json();
    if (json.success) {        
        alert('Renamed successfully');
        await loadTree();
    } else {
        alert(json.error || 'Rename failed');
    }
}

/* delete  */
document.getElementById('btn-delete').addEventListener('click', async () => {
    const selected = document.querySelector('.selected-item');
    if (!selected) {
        alert('Select a file or folder to delete');
        return;
    }

    const path = selected.dataset.path;
    if (!confirm('Are you sure you want to delete this item?')) return;

    const form = new FormData();
    form.append('_token', '{{ csrf_token() }}');
    form.append('path', path);

    const res = await fetch('{{ route("editor.delete") }}', {
        method: 'POST',
        body: form
    });

    const json = await res.json();
    if (json.success) {
        alert('Deleted successfully');
        loadTree(); // Refresh your file tree
    } else {
        alert(json.error || 'Delete failed');
    }
});
</script>
 
 
@endsection