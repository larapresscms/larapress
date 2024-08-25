@extends('admin.layouts.master')

@section('content')

@if(optional(auth()->user())->role == 111 || optional(auth()->user())->menus == 'menus')
       <!-- Page Heading -->
       <h1 class="h3 mb-2 text-gray-800">Menu Show</h1>
                    

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Menu</h6> <br/>
                            Menu Name: {{ $menu->title }} <br/><hr/>  

                            @foreach($categories as $categorie)
                                @if($menu->category_id == $categorie->id)
                                    Menu Category: {{$categorie->name}}<br/><hr/> 
                                @endif
                            @endforeach   

                            @foreach($menus as $menuC)
                                @if($menuC->id == $menu->sub_menu_id)
                                 Menu Parent: {{$menuC->title}}<br/><hr/>
                                @endif
                            @endforeach  
                            Menu URL: {{ $menu->url }} <br/><hr/> 
                            Menu Target: {{ $menu->target }} <br/><hr/> 
                            Status: {{ $menu->status == 0 ? 'Unpublish' : 'Publish' }}
                        </div>
                       
                    </div>
@else
You can't access this page. Please contact admin.
@endif
@endsection