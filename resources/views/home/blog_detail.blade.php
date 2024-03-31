@extends('home.masterpage')
@section('meta-description-keywords')

    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap4" />

@stop
@section('css')

<style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    .b-example-divider {
      height: 3rem;
      background-color: rgba(0, 0, 0, .1);
      border: solid rgba(0, 0, 0, .15);
      border-width: 1px 0;
      box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
    }

    .b-example-vr {
      flex-shrink: 0;
      width: 1.5rem;
      height: 100vh;
    }

    .bi {
      vertical-align: -.125em;
      fill: currentColor;
    }

    .nav-scroller {
      position: relative;
      z-index: 2;
      height: 2.75rem;
      overflow-y: hidden;
    }

    .nav-scroller .nav {
      display: flex;
      flex-wrap: nowrap;
      padding-bottom: 1rem;
      margin-top: -1px;
      overflow-x: auto;
      text-align: center;
      white-space: nowrap;
      -webkit-overflow-scrolling: touch;
    }
    .bg-img {
            position: relative;
            overflow: hidden;
            background-size: contain; 
        }

    .text-overlay {
            position: absolute;
            top: 50%;
            /* left: 50%; */
            transform: translate(-50%, -50%);
            color: white;
            text-align: center;
            background-color: red;
        }   
</style>

@stop
@section('title', 'blog')

@section('content')

    <!-- Start Blog Section -->
    <div class="blog-section">
        <main class="container-lg">
          <div class="row">
            <div class="col-md-8">
              <div class="rounded text-bg-dark position-relative">
                <img src="{{asset('admin/assets/blog_img/')}}/{{$data->blog_img}}" alt="Image" class="img-fluid" width="100%" height="50%">

                <article class="blog-post border-bottom mt-5">
                  <h2 class="display-5 fw-bold blog-post-title mb-1">{{$data->title}}</h2>
                  <p class="blog-post-meta">{{$data->created_at->format('F d, Y')}} by {{$data->user->name}}</p>
                    <div class="mb-5 mt-5">
                        {!!$data->content!!}
                    </div>
                </article>
          
                <nav class="blog-pagination mt-5" aria-label="Pagination">
                  <a class="btn btn-outline-primary rounded-pill" href="#">Older</a>
                  <a class="btn btn-outline-secondary rounded-pill disabled">Newer</a>
                </nav>
              </div>
            </div>
            <div class="col-md-4">
              <div class="position-sticky" style="top: 2rem;">
                <div class="p-4 mb-3 bg-light rounded">
                  <h4 class="">Author</h4>
                  <p class="mb-0">Customize this section to tell your visitors a little bit about your publication, writers, content, or something else entirely. Totally up to you.</p>
                </div>
        
                <div class="p-4">
                  <h4 class="">Archives</h4>
                  <ol class="list-unstyled mb-0">
                    <li><a href="#">March 2021</a></li>
                    <li><a href="#">February 2021</a></li>
                    <li><a href="#">January 2021</a></li>
                    <li><a href="#">December 2020</a></li>
                    <li><a href="#">November 2020</a></li>
                    <li><a href="#">October 2020</a></li>
                    <li><a href="#">September 2020</a></li>
                    <li><a href="#">August 2020</a></li>
                    <li><a href="#">July 2020</a></li>
                    <li><a href="#">June 2020</a></li>
                    <li><a href="#">May 2020</a></li>
                    <li><a href="#">April 2020</a></li>
                  </ol>
                </div>
        
                <div class="p-4">
                  <h4 class="">Elsewhere</h4>
                  <ol class="list-unstyled">
                    <li><a href="#">GitHub</a></li>
                    <li><a href="#">Twitter</a></li>
                    <li><a href="#">Facebook</a></li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <h3 class="pb-4 mb-4 mt-5  border-bottom">
                Recent the Blogs
          </h3>
          <div class="row mb-2 mt-5">
              @foreach ($recent as $blog)
                
              <div class="col-12 col-sm-6 col-md-4 mb-4 mb-md-0">
                  <div class="post-entry">
                    @if ($blog->blog_img == null)
                      <a href="{{url('/blog_detail')}}/{{$blog->id}}" class="post-thumbnail"><img src="{{asset('home/images/post-1.jpg')}}" alt="Image" class="img-fluid"></a>
                    @else

                      <a href="{{url('/blog_detail')}}/{{$blog->id}}" class="post-thumbnail"><img src="{{asset('admin/assets/blog_img/')}}/{{$blog->blog_img}}" alt="Image" class="img-fluid"></a>
                    @endif
                      <div class="post-content-entry">
                          <h3><a href="#">{{$blog->title}}</a></h3>
                          <div class="meta">
                            <span>by <a href="#">{{$blog->user->name}}</a></span> <span>on <a href="#">{{$blog->created_at->format('M d, Y')}}</a></span>
                          </div>
                      </div>
                  </div>
              </div>
              @endforeach
          </div>  
        </main>
    </div>
    <!-- End Blog Section -->



@stop

@section('js')


@stop
