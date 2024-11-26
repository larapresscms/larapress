@extends('admin.layouts.master')
@section('content')

@if(optional(auth()->user())->role == 111)
 <!-- Nested Row within Card Body -->
 <div class="row">
        <div class="col-lg-12">
            <div class="p-5">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Edit a Home Page!</h1>
            </div>
            <form class="user" action="{{ url('/dashboard/settings/') }}/{{ $settings->id }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method('PATCH') 
                <div class="form-group row">
                    <div class="col-sm-8 mb-3 mb-sm-0">
                        <div class="form-group">
                            <label for="floatingSiteTitle" class="form-label">Site Title</label>
                            <input type="text" name='site_title' value="{{ $settings->site_title}}" class="form-control form-control-user" id="floatingSiteTitle"
                            placeholder="Site Title">
                        </div>
                        <div class="form-group">
                            <label for="floatingSubTitle" class="form-label">Sub Title</label>
                            <input type="text" name='sub_title' value="{{ $settings->sub_title}}" class="form-control form-control-user" id="floatingSubTitle"
                            placeholder="Sub Title">
                        </div>
                        <div class="form-group">
                            <label for="floatingInputDashboard" class="form-label">Dashboard Color</label>
                            <input type="color" name='dashboard_color' value="{{ $settings->dashboard_color}}" class="form-control form-control-user panel_color" id="floatingInputDashboard"
                                placeholder="Dashboard Color"> 
                        </div>
                        
                        <div class="form-group">
                        <label for="floatingText" class="form-label">Text Color</label>
                            <input type="color" name='text_color' value="{{ $settings->text_color}}" class="form-control form-control-user panel_color" id="floatingText"
                                    placeholder="Text Color">
                        </div>
                        <div class="form-group">
                        <label for="floatingInputHover" class="form-label">Text Hover Color</label>
                            <input type="color" name='text_hover' value="{{ $settings->text_hover}}" class="form-control form-control-user panel_color" id="floatingInputHover"
                                    placeholder="Text Hover Color">
                        </div>
                        <!-- //create theme name as folder name  -->
                        <div class="form-group">
                            <label for="floatingInput" class="form-label">Theme folder Name</label>
                            <select class="form-control" class="form-select form-select-sm" aria-label=".form-select-sm example" name="theme_url">
                                <option value="default" selected>No theme set</option> 
                                <?php
                                    $foler_names = [];
                                    $i = 0;                                    

                                    // Define the paths
                                    $mainResourceDir = resource_path('views/front/themes');
                                    $packageDir = base_path('packages/larapress/src/resources/views/front/themes');

                                    // Initialize an empty array to hold the merged directory list
                                    $mergedDirList = [];

                                    // Scan the main resource directory
                                    if (is_dir($mainResourceDir)) {
                                        $dirList = scandir($mainResourceDir);
                                        foreach ($dirList as $value) {
                                            if (strpos($value, '.') === false) {
                                                $mergedDirList[$value] = $value;
                                            }
                                        }
                                    }

                                    // Scan the package directory
                                    if (is_dir($packageDir)) {
                                        $dirList = scandir($packageDir);
                                        foreach ($dirList as $value) {
                                            if (strpos($value, '.') === false) {
                                                $mergedDirList[$value] = $value;
                                            }
                                        }
                                    }

                                    // Iterate through the merged directory list and output options
                                    foreach ($mergedDirList as $value) {
                                        ?>
                                        <option value="{{ $value }}" {{ $value == $settingsAdmin->theme_url ? 'selected' : '' }}>{{ $value }}</option>
                                        <?php
                                    } 
                                    ?>  
                            </select>                            
                        </div>  

                        <div class="form-group">
                            <label for="floatingInput" class="form-label">Home Page Name</label>
                            <select class="form-control" class="form-select form-select-sm" aria-label=".form-select-sm example" name="home_url">
                                <option value="0" selected>No Home page set</option>
                                @foreach($posts as $post)
                                <option value="{{ $post->id }}" {{ $post->id == $settingsAdmin->home_url ? 'selected' : '' }}>{{ $post->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="editor" class="form-label">Editor Choose</label>
                            <div class="form-group">
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label form-label mr-1" for="editor1">Classic </label>
                                    <input class="form-check-input" type="radio" name="editor" id="editor1" value="classic" {{ $settings->editor == "classic" ? 'checked' : ''}}>                                    
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label form-label mr-1" for="editor2">Visual </label>
                                    <input class="form-check-input" type="radio" name="editor" id="editor2" value="visual" {{ $settings->editor == "visual" ? 'checked' : ''}}>                                    
                                </div>
                            </div>                            
                        </div>


                    </div>
                    <div class="col-sm-4 mb-3 mb-sm-0 text-center">
                        <div class="form-group">
                            <label class="form-check-label form-label mr-1" for="">Website Logo</label><br>
                            <input type="hidden" id="type" name='site_logo' value="{{ $settings->site_logo }}" placeholder="Image Url" class="form-control" >                              
                            <img id="myImg" src="{{ $settings->site_logo == null ? asset('packages/larapress/src/Assets/admin/img/dummy-image-square.jpg') : asset('public/uploads/').'/'.$settings->site_logo }}" width="100%" height="auto" data-toggle="modal" data-target="#exampleModalCenter" class="border border-info">
                            <button type="button" onclick="removeValue('{{url('packages/larapress/src/Assets/admin/img/dummy-image-square.jpg')}}')" class="btn btn-secondary btn-sm mt-3">Remove Images</button>
                        </div> 
                        <!-- fevicon  -->
                        <div class="form-group">
                            <label for="floatingfevicon" class="form-label">Favicon Image Link:</label>
                            <input type="text" name='fav_icon' value="{{ $settings->fav_icon}}" class="form-control form-control-user" id="floatingfevicon"
                            placeholder="Example: 12423223.jpg">
                        </div>

                        <input type="hidden" name="header" value="{{ $settings->header}}" id="lp-orderInput">

                        <input type="hidden" name="footer" value="{{ $settings->footer}}" id="lp-orderInput-footer">

                    </div>        

                

                <div class="col-xl-6 col-lg-6">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Template</h6>                                      
                            <a href="https://larapress.org/template"><h6 class="m-0 font-weight-bold text-primary">View More Template</h6> </a>
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
                                            $backgroundImage = $screenshot ? url(str_replace(base_path(), '', $screenshot)) : 'default-image.jpg'; // Default image if no screenshot is found
                                            ?>
                                            <div class="lp-item card" data-id="{{ $dir }}">
                                                <img src="<?php echo $backgroundImage; ?>">
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
                                                            <p><a href="{{url('/dashboard/delete-template',$dir)}}" class="btn btn-danger">Delete</a></p>                                          
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

                <div class="row col-xl-6">
                    <div class="col-xl-12 col-lg-12">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Header Design</h6>                
                            </div>
                            <div class="card-body scroll-design">
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">                            
                                        <div id="lp-right-list" class="lp-drop-container">

                                            @php $tempate = explode(",",$settings->header); @endphp
                                            @foreach($tempate as $tempateName)
                                            @if($tempateName)
                                            <?php
                                            // Iterate through the merged directory list and output options
                                            foreach ($mergedDirList as $dir => $files) { 

                                                if($tempateName == $dir){

                                                    // Find the screenshot (png) file for background image
                                                    $screenshot = findScreenshot($files);
                                                    $backgroundImage = $screenshot ? url(str_replace(base_path(), '', $screenshot)) : 'default-image.jpg'; // Default image if no screenshot is found
                                                    ?>
                                                    <div class="lp-item card" data-id="{{ $dir }}">
                                                        
                                                        <img src="<?php echo $backgroundImage; ?>">
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
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                        </div>  
                                                        <button class="close-btn">×</button>                                       
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?> 
                                            @endif
                                            @endforeach 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-12 col-lg-12">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Footer Design</h6>                
                            </div>
                            <div class="card-body scroll-design">
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">                            
                                        <div id="lp-right-list-footer" class="lp-drop-container">

                                            @php $tempate = explode(",",$settings->footer); @endphp
                                            @foreach($tempate as $tempateName)
                                            @if($tempateName)
                                            <?php
                                            // Iterate through the merged directory list and output options
                                            foreach ($mergedDirList as $dir => $files) { 

                                                if($tempateName == $dir){

                                                    // Find the screenshot (png) file for background image
                                                    $screenshot = findScreenshot($files);
                                                    $backgroundImage = $screenshot ? url(str_replace(base_path(), '', $screenshot)) : 'default-image.jpg'; // Default image if no screenshot is found
                                                    ?>
                                                    <div class="lp-item card" data-id="{{ $dir }}">
                                                        
                                                        <img src="<?php echo $backgroundImage; ?>">
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
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                        </div>  
                                                        <button class="close-btn">×</button>                                       
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?> 
                                            @endif
                                            @endforeach 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                



            </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">Update</button>                            
            </form>            
            <hr>
        </div>
    </div>
</div> 

<!-- Insert Image from library -->
@include('admin.media.medialibrary')
@include('admin.media.mediauploads')
<!-- Modal -->
@else
You can't access this page. Please contact admin.
@endif
<script src="{{ asset('packages/larapress/src/Assets/admin/js/template_design.js')}}"></script>
@endsection