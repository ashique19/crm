<!-- Widget -->
<div class="widget">
    <h3 class="mt-0 mb-3">Search Blog</h3>
    <div class="search-blog-input">
        <form action="{{ route('blog','1') }}" method="post">
            {{ csrf_field() }}
            <div class="input"><input name="search" class="form-control" type="text" placeholder="Type and hit enter" value="{{ isset($search)?$search:'' }}" /></div>
        </form>
    </div>
    <div class="clearfix"></div>
</div>
<!-- Widget / End -->

<!-- Widget -->
<div class="widget mt-5">
    <h3>Got any questions?</h3>
    <div class="info-box mb-1">
        <p>Having any questions? Feel free to ask!</p>
        <a href="{{route('contact')}}" class="btn btn-primary btn-block mt-2"><i class="fa fa-envelope-o"></i> Drop Us a Line</a>
    </div>
</div>
<!-- Widget / End -->


<!-- Widget -->
<div class="widget mt-5">

    <h3>Popular Blogs</h3>
    <ul class="widget-tabs">

        @if(count($popularPosts)>0)
            @foreach($popularPosts as $post)
            <!-- Post #1 -->
            <li>
                <div class="widget-content">
                    <div class="widget-thumb">
                        <a href="{{url('/blog/'.$post->slug) }}">
                                <img src="{{ url('/storage/blog/'.$post->image) }}" alt="{{$post->title}}" class="img-fluid">
                        </a>
                    </div>

                    <div class="widget-text">
                        <h5><a href="{{url('/blog').'/'.$post->slug}}">{{$post->title}} </a></h5>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </li>
            @endforeach
        @endif

    </ul>

    @if(count($popularPosts)==0)
    <div class="col-sm-12 mb-5"><strong class="center-align">No Results</strong></div>
    @endif

</div>
<!-- Widget / End-->