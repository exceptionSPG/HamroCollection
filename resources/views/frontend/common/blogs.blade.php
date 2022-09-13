<section class="section latest-blog outer-bottom-vs wow fadeInUp">
    <h3 class="section-title">latest form blog</h3>
    <div class="blog-slider-container outer-top-xs">
        <div class="owl-carousel blog-slider custom-carousel">


            @foreach($blogs as $blog)

            <div class="item">
                <div class="blog-post">
                    <div class="blog-post-image">
                        <div class="image"> <a href="{{ route('post.details',$blog->id)}}"><img src="{{ asset($blog->post_image) }}" alt=""></a> </div>
                    </div>
                    <!-- /.blog-post-image -->

                    <div class="blog-post-info text-left">
                        <h3 class="name"><a href="{{ route('post.details',$blog->id)}}">@if(session()->get('language') == 'nepali'){{ $blog->post_title_nep }} @else {{ $blog->post_title_en }} @endif</a></h3>
                        <span class="info">By Admin &nbsp;|&nbsp; {{ Carbon\Carbon::parse($blog->created_at)->diffForHumans() }} </span>
                        <p class="text">@if(session()->get('language') == 'nepali'){!! Str::limit($blog->post_details_nep,100) !!} @else {!! Str::limit($blog->post_details_nep,100) !!} @endif....</p>
                        <a href="{{ route('post.details',$blog->id)}}" class="lnk btn btn-primary">Read more</a>
                    </div>
                    <!-- /.blog-post-info -->

                </div>
                <!-- /.blog-post -->
            </div>
            <!-- /.item -->

            @endforeach



        </div>
        <!-- /.owl-carousel -->
    </div>
    <!-- /.blog-slider-container -->
</section>