@extends('layout.main')

@section('content')
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Blog Page</h1>
                    <nav class="d-flex align-items-center">
                        <a href="/"><span class="lnr lnr-arrow-right"></span>Home</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="blog_categorie_area">
        <div class="container">
            <div class="row">
                @foreach ($blogCategories as $category)   
                <div class="col-lg-4">
                    <div class="categories_post">
                        <img src="https://source.unsplash.com/1600x950/?{{ $category->name }}">
                        <div class="categories_details">
                            <div class="categories_text">
                                <a href="/blog?blogCategory={{ $category->slug }}">
                                    <h5>{{ $category->name }}</h5>
                                </a>
                                <div class="border_line"></div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="blog_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog_left_sidebar">
                        @if ($blogs->count())
                            @foreach ($blogs as $blog)
                                <article class="row blog_item">
                                    <div class="col-md-3">
                                        <div class="blog_info text-right">
                                            <ul class="blog_meta list">
                                                <li><a href="/blog?blogCategory={{ $blog->blogCategory->slug }}">Category : {{ $blog->blogCategory->name }}<i class="lnr lnr-flag"></i></a></li>
                                                <li><a>Author : {{ $blog->author }}<i class="lnr lnr-user"></i></a></li>
                                                <li><a>Created at : {{ $blog->created_at->format('d F Y') }}<i class="lnr lnr-calendar-full"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="blog_post">
                                            <img src="{{ asset('storage/' . $blog->image ) }}" alt="">
                                            <div class="blog_details">
                                                <a><h2>{{ $blog->title }}</h2></a>
                                                <p>{!! Str::limit($blog->body, 300) !!}</p>
                                                <a href="/blogDetail/{{ $blog->slug }}" class="white_bg_btn">View More</a>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        @else
                            <h1 style="margin: 120px 0" class="mx-auto d-flex justify-content-center">Blog Not Found</h1>
                        @endif
                        @if ($blogs->lastPage() > 1)
                            <nav class="blog-pagination justify-content-center d-flex">
                                <ul class="pagination">
                                    <li class="page-item {{ ($blogs->currentPage() == 1) ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $blogs->previousPageUrl() }}"><i class="fa fa-long-arrow-left"></i></a>
                                    </li>
                                    @foreach ($blogs->getUrlRange(1, $blogs->lastPage()) as $page => $url)
                                        <li class="page-item {{ ($blogs->currentPage() == $page) ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endforeach
                                    <li class="page-item {{ ($blogs->currentPage() == $blogs->lastPage()) ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $blogs->nextPageUrl() }}"><i class="fa fa-long-arrow-right"></i></a>
                                    </li>
                                </ul>
                            </nav>
                        @endif
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