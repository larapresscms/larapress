@extends('front.themes.default.layouts.master')

@section('content')
<!-- Page header with logo and tagline-->
        <!-- Page content-->
        <div class="container">
            <div class="row">
                <!-- Blog entries-->
                <div class="col-lg-8">
                    <!-- Featured blog post-->
                    @foreach($posts as $post)
                    <div class="card mb-4">
                        <a href="#!"><img class="card-img-top" src="{{$post->thumbnail_path}}" alt="..." /></a>
                        <div class="card-body">
                            <div class="small text-muted">{{ $post->created_at }}</div>
                            <h2 class="card-title">{{ $post->title }}</h2>
                            <p class="card-text">{!! $post->excerpt !!}</p>
                            <a class="btn btn-primary" href="{{ url('single/'.$post->id) }}">Read more →</a>
                        </div>
                    </div>
                    @endforeach
                
                    <nav aria-label="Pagination">
                        <hr class="my-0" />
                        <ul class="pagination justify-content-center my-4">
                        {{-- {!! $posts->links() !!} --}}

                        
                        </ul>
                    </nav>

                    <!-- Pagination-->
                    <!-- <nav aria-label="Pagination">
                        <hr class="my-0" />
                        <ul class="pagination justify-content-center my-4">
                            <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Newer</a></li>
                            <li class="page-item active" aria-current="page"><a class="page-link" href="#!">1</a></li>
                            <li class="page-item"><a class="page-link" href="#!">2</a></li>
                            <li class="page-item"><a class="page-link" href="#!">3</a></li>
                            <li class="page-item disabled"><a class="page-link" href="#!">...</a></li>
                            <li class="page-item"><a class="page-link" href="#!">15</a></li>
                            <li class="page-item"><a class="page-link" href="#!">Older</a></li>
                        </ul>
                    </nav> -->
                </div>
                <!-- sidebar -->
                @include('front.themes.default.sidebar')
            </div>
        </div>
@endsection      