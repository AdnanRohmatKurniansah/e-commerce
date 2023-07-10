@extends('layout.main')

@section('content')
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Detail Blog</h1>
                    <nav class="d-flex align-items-center">
                        <a href="/"><span class="lnr lnr-arrow-right"></span>Home</a>
                        <a href="/blog"><span class="lnr lnr-arrow-right"></span>Blog</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section class="blog_area single-post-area section_gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 posts-list">
                    <div class="single-post row">
                        <div class="col-lg-12">
                            <div class="feature-img">
                                <img class="img-fluid" src="{{ asset('storage/' . $blog->image) }}" alt="">
                            </div>
                        </div>
                        <div class="col-lg-12  col-md-3">
                            <div class="blog_info text-left">
                                <ul class="blog_meta list d-flex">
                                    <li><a><i class="lnr lnr-flag mr-2"></i> Category : {{ $blog->blogCategory->name }}</a></li>
                                    <li><a><i class="lnr lnr-user mr-2"></i> Author : {{ $blog->author }}</a></li>
                                    <li><a><i class="lnr lnr-calendar-full mr-2"></i> Created at : {{ $blog->created_at->format('d F Y') }}</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-9 blog_details">
                            <h2>{{ $blog->title }}</h2>
                            <p class="excert">{!! $blog->body !!}</p>
                        </div>
                    </div>
                    <div class="comments-area">
                        @if ($blogComments->count())  
                            <h4>{{ $blogComments->count() }} Comments</h4>
                            @foreach ($blogComments as $blogComment) 
                                <div class="comment-list">
                                    <div class="single-comment justify-content-between d-flex">
                                        <div class="user justify-content-between d-flex">
                                            <div class="desc">
                                                <h5><a>{{ $blogComment->name }}</a></h5>
                                                <p class="date">{{ $blogComment->created_at->format('F j, Y \a\t g:i a') }}</p>
                                                <p class="comment">
                                                    {{ $blogComment->message }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            <div class="text-center mt-5">
                                <button id="loadMore" class="primary-btn border-0">Load More</button>
                            </div>

                        @else
                            <h2 class="my-5 text-center">There are no comments for now</h2>
                        @endif
                    </div>
                    <div class="comment-form">
                        <h4>Leave a Comment</h4>
                        <form action="/addComment" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="blog_id" value="{{ $blog->id}}">
                                <textarea class="form-control @error('message') is-invalid @enderror mb-10" rows="5" name="message" placeholder="Message"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Message'" required></textarea>
                                @error('message')
                                    <div class="invalid-feedback">  
                                      {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <button type="submit" class="primary-btn border-0 submit_btn">Post Comment</button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4 mb-5">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget search_widget">
                            <div class="input-group">
                                <form action="/blog" class="input-group">
                                    <input name="search" value="{{ request('search') }}" type="text" class="form-control" placeholder="Search Posts" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search Blogs'">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="submit"><i class="lnr lnr-magnifier"></i></button>
                                    </span>
                                </form>
                            </div>
                            <div class="br"></div>
                        </aside>
                        <aside class="single_sidebar_widget popular_post_widget">
                            <h3 class="widget_title">Latest Blogs</h3>
                            @foreach ($lblogs as $lblog)
                                <div class="media post_item">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <img class="img-fluid" src="{{ asset('storage/' . $lblog->image) }}" alt="post">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="media-body">
                                                <a href="/blogDetail/{{ $lblog->slug }}">
                                                    <h3>{{ $lblog->title }}</h3>
                                                </a>
                                                <p>{{ $lblog->created_at->format('d F Y') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="br"></div>
                        </aside>
                        <aside class="single_sidebar_widget post_category_widget">
                            <h4 class="widget_title">Blog Categories</h4>
                            <ul class="list cat-list">
                                @foreach ($blogCategories as $blogCategory) 
                                <li>
                                    <a href="/blog?blogCategory={{ $blogCategory->slug }}" class="d-flex justify-content-between">
                                        <p>{{ $blogCategory->name }}</p>
                                        @php
                                            $count = \App\Models\Blog::where('blogCategory_id', $blogCategory->id)->count()
                                        @endphp
                                        <p>{{ $count }}</p>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(function() {
			let commentPerPage = 3;
			let commentItem = $("div.comment-list");
			let totalComment = commentItem.length;
			let displayedComment = commentPerPage;
	
			commentItem.slice(commentPerPage).hide();
	
			if (totalComment <= commentPerPage) {
				$("#loadMore").hide();
			}
	
			$("#loadMore").on('click', function(e) {
				e.preventDefault();
				commentItem.slice(displayedComment, displayedComment + commentPerPage).slideDown();
				displayedComment += commentPerPage;
	
				if (displayedComment >= totalComment) {
					$("#loadMore").hide();
				}
			});
		});
    </script>

@endsection