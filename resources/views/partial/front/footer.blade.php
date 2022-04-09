<footer class="footer" id="footer">
    <div class="container">
        <div class="row">

        </div>
        <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="footer-widget about-widget">
                    <div class="footer-logo">
                        <a href="{{route('frontend.index')}}">
                            @php
								Session::has('language') ? $lid=Session::get('language') : $lid = (DB::table('languages')->where('is_default','=',1)->first()->id)
							@endphp
							
                            @php
                                $header_footer_logo = d_logo($lid);
                            @endphp
                            
                            @if (!empty($header_footer_logo[0]->footer_logo))
                                <img src="{{$header_footer_logo[0]->footer_logo ? asset('assets/images/logo/'.$header_footer_logo[0]->footer_logo) : asset('assets/front/images/logo.png')}}" alt="">
                            @else
                                <img src="{{asset('assets/images/logo/'.$gs->logo)}}" alt="">
                            @endif
                        </a>
                    </div>
                    <div class="text">
                        <p>
                            {!! strlen($gs->footer_text)>167 ? substr($gs->footer_text,0,166):$gs->footer_text !!}
                        </p>
                    </div>
                    <div class="social-links">
                        <h4 class="title">
                            {{__('Follow Us')}}:
                        </h4>
                    </div>
                </div>
                <div class="fotter-social-links">
                    <ul>
                        @foreach ($social_links as $social_link)
                            <li>
                                <a href="{{ $social_link->link}}" class="{{$social_link->name}} mb-2">
                                    <i class="{{$social_link->icon}}"></i>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-6 col-lg-2">
                <div class="footer-widget info-link-widget ilw1">
                    <h4 class="title">
                        {{__('CATEGORIES')}}
                    </h4>
                    <ul class="link-list">
                        @foreach ($default_language->categories()->inRandomOrder()->limit(8)->get() as $category)  
                            <li>
                                <a href="{{ route('frontend.category',$category->slug)}}">
                                    <span>
                                        {{ $category->title}}
                                    </span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="footer-widget blog-widget">
                    <h4 class="title">
                        {{__('Popular Post')}}
                    </h4>
                    
                    <ul class="post-list">
                        @foreach ($top_views as $top_view)
                            @php
                                $post = \App\Models\Post::where('id',$top_view->post_id)->where('language_id',$default_language->id)->first();
                            @endphp
                          @if ($post) 
                            <li>
                                <div class="post">
                                    <div class="post-img">
                                        @if ($post->image_big)
                                            <div class="img">
                                                <img src="{{asset('assets/images/post/'.$post->image_big)}}" alt="">
                                            </div>
                                        @else 
                                            <div class="img">
                                                <img src="{{$post->rss_image}}" alt="">
                                            </div>
                                        @endif
                                    </div>
                                    <div class="post-details">
                                        <a href="{{route('frontend.details',[$post->id,$post->slug])}}">
                                            <h4 class="post-title">
                                                {{ strlen($post->title)>30 ? mb_substr($post->title,0,30,'utf-8').'...' : $post->title}}
                                            </h4>
                                        </a>
                                    </div>
                                </div>
                            </li>
                          @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="footer-widget tags-widget">
                    <h4 class="title">
                        {{__('TAGS')}}
                    </h4>
                    <ul class="tag-list">
                        @foreach ($tags as $tag)
                            <li>
                                <a href="{{ route('tag.search',$tag)}}">
                                    {{$tag}}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="copy-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="content">
                        <div class="content">
                            <p><a href="{{route('frontend.index')}}">{{$gs->copyright_text}}</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="content">
                        <div class="content footerMenu">
                            <ul class="nav">
                                @php
                                    $footer_menus = \App\Models\Page::where('placement','footer')->where('status',1)->get();
                                @endphp
                                @foreach ($footer_menus as $menu)
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('dynamic.page',$menu->slug)}}">{{ $menu->title }}</a>
                                    </li>
                                @endforeach
                              </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>