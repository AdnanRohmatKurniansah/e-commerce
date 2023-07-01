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
                                    <li><a href="#"><i class="lnr lnr-flag mr-2"></i> Category : {{ $blog->blogCategory->name }}</a></li>
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
                        <h4>05 Comments</h4>
                        <div class="comment-list">
                            <div class="single-comment justify-content-between d-flex">
                                <div class="user justify-content-between d-flex">
                                    <div class="thumb">
                                        <img src="img/blog/c4.jpg" alt="">
                                    </div>
                                    <div class="desc">
                                        <h5><a href="#">Maria Luna</a></h5>
                                        <p class="date">December 4, 2018 at 3:12 pm </p>
                                        <p class="comment">
                                            Never say goodbye till the end comes!
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="comment-list">
                            <div class="single-comment justify-content-between d-flex">
                                <div class="user justify-content-between d-flex">
                                    <div class="thumb">
                                        <img src="img/blog/c5.jpg" alt="">
                                    </div>
                                    <div class="desc">
                                        <h5><a href="#">Ina Hayes</a></h5>
                                        <p class="date">December 4, 2018 at 3:12 pm </p>
                                        <p class="comment">
                                            Never say goodbye till the end comes!
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="comment-form">
                        <h4>Leave a Comment</h4>
                        <form>
                            <div class="form-group form-inline">
                                <div class="form-group col-lg-6 col-md-6 name">
                                    <input type="text" class="form-control" id="name" placeholder="Enter Name" onfocus="this.placeholder = ''"
                                        onblur="this.placeholder = 'Enter Name'">
                                </div>
                                <div class="form-group col-lg-6 col-md-6 email">
                                    <input type="email" class="form-control" id="email" placeholder="Enter email address"
                                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'">
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="subject" placeholder="Subject" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'Subject'">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control mb-10" rows="5" name="message" placeholder="Messege"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Messege'" required=""></textarea>
                            </div>
                            <a href="#" class="primary-btn submit_btn">Post Comment</a>
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
@endsection