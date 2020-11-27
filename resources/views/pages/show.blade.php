@extends('layout')

@section('content')
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <article class="post">
                    <div class="post-thumb">
                        <img src="{{ $post->getImage() }}" alt="">
                    </div>
                    <div class="post-content">
                        <header class="entry-header text-center text-uppercase">
                            @if ($post->hasCategory())
                                <h6>
                                    <a href="{{ route('post.category', $post->category->slug) }}">
                                        {{ $post->category->title }}
                                    </a>
                                </h6>
                            @endif
                            <h1 class="entry-title">{{ $post->title }}</h1>
                        </header>
                        <div class="entry-content">
                            {!! $post->content !!}
                        </div>
                        <div class="decoration">
                            @foreach ($post->tags as $tag)
                                <a href="{{ route('post.tag', $tag->slug) }}" class="btn btn-default">{{ $tag->title }}</a>                                
                            @endforeach
                        </div>
                        <div class="social-share">
							<span class="social-share-title pull-left text-capitalize">By Rubel On {{ $post->getDate() }}</span>
                            <ul class="text-center pull-right">
                                <li><a class="s-facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a class="s-twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a class="s-google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a class="s-linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a class="s-instagram" href="#"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </article>
                <div class="top-comment"><!--top comment-->
                    <img src="assets/images/comment.jpg" class="pull-left img-circle" alt="">
                    <h4>Rubel Miah</h4>
                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy hello ro mod tempor
                        invidunt ut labore et dolore magna aliquyam erat.</p>
                </div><!--top comment end-->
                <div class="row"><!--blog next previous-->
                    <div class="col-md-6">
                        @if ($post->hasPrevious())
                            <div class="single-blog-box">
                                <a href="{{ route('post.show', $prevPost->slug ) }}">
                                    <img src="{{ $prevPost->getImage() }}" alt="">
                                    <div class="overlay">
                                        <div class="promo-text">
                                            <p><i class=" pull-left fa fa-angle-left"></i></p>
                                            <h5>{{ $prevPost->title }}</h5>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-6">
                        @if ($post->hasNext())
                            <div class="single-blog-box">
                                <a href="{{ route('post.show', $nextPost->slug ) }}">
                                    <img src="{{ $nextPost->getImage() }}" alt="">
                                    <div class="overlay">
                                        <div class="promo-text">
                                            <p><i class=" pull-right fa fa-angle-right"></i></p>
                                            <h5>{{ $nextPost->title }}</h5>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                    </div>
                </div><!--blog next previous end-->
                <div class="related-post-carousel"><!--related post carousel-->
                    <div class="related-heading">
                        <h4>You might also like</h4>
                    </div>
                    <div class="items">
                        @foreach ($post->related() as $item)
                            <div class="single-item">
                                <a href="{{ route('post.show', $item->slug) }}">
                                    <img src="{{ $item->getImage() }}" alt="">
                                    <p>{{ $item->title }}</p>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div><!--related post carousel-->
                <div class="bottom-comment"><!--bottom comment-->
                    <h4>3 comments</h4>

                    <div class="comment-img">
                        <img class="img-circle" src="assets/images/comment-img.jpg" alt="">
                    </div>

                    <div class="comment-text">
                        <a href="#" class="replay btn pull-right"> Replay</a>
                        <h5>Rubel Miah</h5>

                        <p class="comment-date">
                            December, 02, 2015 at 5:57 PM
                        </p>


                        <p class="para">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                            diam nonumy
                            eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam
                            voluptua. At vero eos et cusam et justo duo dolores et ea rebum.</p>
                    </div>
                </div>
                <!-- end bottom comment-->


                <div class="leave-comment"><!--leave comment-->
                    <h4>Leave a reply</h4>


                    <form class="form-horizontal contact-form" role="form" method="post" action="#">
                        <div class="form-group">
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                            </div>
                            <div class="col-md-6">
                                <input type="email" class="form-control" id="email" name="email"
                                       placeholder="Email">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="text" class="form-control" id="subject" name="subject"
                                       placeholder="Website url">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
										<textarea class="form-control" rows="6" name="message"
                                                  placeholder="Write Massage"></textarea>
                            </div>
                        </div>
                        <a href="#" class="btn send-btn">Post Comment</a>
                    </form>
                </div><!--end leave comment-->
            </div>
            @include('pages._sidebar')
        </div>
    </div>
</div>

@parent

@endsection