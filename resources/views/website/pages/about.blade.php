@extends('website.layouts.template')
@section('title','Tools')
@section('content')
@include('website.pages.particles.section_1',['title'=>$page->top_heading,'content'=>$page->top_content])
<section class="guarantees">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8 offset-md-2">
                <div class="row">
                    <div class="col-12">
                        <h2 class="text-center pb-3">{{$page->top_heading}}</h2>
                        {!! $page->top_section_content !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- tutors area -->
<section id="testimonials" class="testimonials pt-0">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2>{{$page->subject_specialist_heading}}</h2>
            <p>{{$page->subject_specialist_content}}</p>
        </div>
        <div class="testimonials-slider swiper mt-5" data-aos="fade-up" data-aos-delay="100">
            <div class="swiper-wrapper">
                @foreach($data['writers'] as $item)
                <div class="swiper-slide">
                    <div class="testimonial-item">
                        <div class="pb-3">
                            <div class="d-flex justify-content-center align-items-center">
                                <img src="{{asset('storage/'.$item->photo)}}" class="testimonial-img" alt="">
                                <div class="ml-3 text-left">
                                    <h3>{{$item->first_name}} {{$item->first_name}}</h3>
                                    <span>{{number_format($item->ratings_received->avg('number'), 2, '.', ',')}}</span>
                                    <span class="text-warning">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        @if($item->ratings_received->avg('number') < 5) <i class="fas fa-star-half-alt">
                                            </i>
                                            </i>
                                            @elseif($item->ratings_received->avg('number') < 4.5) <i
                                                class="far fa-star"></i>
                                                @else
                                                <i class="fa fa-star"></i>
                                                @endif
                                                <!-- <i class="fas fa-star-half-alt"></i> -->
                                    </span>
                                    <span class="d-block text-right">
                                        ({{count($item->ratings_received)+$item->digit}} reviews)
                                    </span>
                                    <a href="#" class="btn btn-sm btn-primary float-right mt-2">Hire Me</a>
                                </div>
                            </div>
                            <div class="mt-3 d-flex tutor-degree mx-auto">
                                <span class="w-50 text-left">Degree:</span>
                                <span class="w-50 right-about">
                                    @if($item->meta('degree'))
                                    {{$item->meta('degree')}}
                                    @else
                                    Bechelor
                                    @endif
                                </span>
                            </div>

                        </div>

                        <p class="mt-3">
                            <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                            @if($item->meta('bio'))
                            {{$item->meta('bio')}}
                            @else
                            Sr. C# .Net Software Engineer with 9+ years experience in Web applications, Desktop
                            Applications, Android apps, IOS.
                            @endif
                            <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                        </p>

                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>

    </div>
</section>
<!-- tutors area end -->

<section class="guarantees pt-0">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-10 offset-md-1">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <h2 class="text-center">{{$page->mission_heading}}</h2>
                        <p>{{$page->mission_content}}</p>
                    </div>
                    <div class="col-12 col-md-6">
                        <h2 class="text-center">{{$page->vision_heading}}</h2>
                        <p>{{$page->vision_content}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="guarantees pt-0">
    <div class="container">
        <div class="section-title">
            <h2>Contact Us</h2>
            <p>Connect with us through official email or call us directly!</p>
        </div>
        <div class="row">
            <div class="col-12 col-md-10 offset-md-1">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5>Email Address</h5>
                                <p><a href="mailto:{{$page->email_1}}">{{$page->email_1}} </a></p>
                                <p><a href="mailto:{{$page->email_2}}">{{$page->email_2}}</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="card d-flex flex-wrap w-100 h-100">
                            <div class="card-body text-center">
                                <h5>Toll-free</h5>
                                <p><a href="callto:{{$page->number}}">{{$page->number}}</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="card d-flex flex-wrap w-100 h-100">
                            <div class="card-body text-center">
                                <h5>Social Media</h5>
                                <div class="">
                                    @if($link = settings('facebook'))
                                    <a href="{{$link}}" class="contact-icon mx-2">
                                        <i class="bi bi-facebook"></i>
                                    </a>
                                    @endif
                                    @if($link = settings('twitter'))
                                    <a href="{{$link}}" class="contact-icon mx-2">
                                        <i class="bi bi-twitter"></i>
                                    </a>
                                    @endif
                                    @if($link = settings('instagram'))
                                    <a href="{{$link}}" class="contact-icon mx-2">
                                        <i class="bi bi-instagram"></i>
                                    </a>
                                    @endif
                                    @if($link = settings('linkedin'))
                                    <a href="{{$link}}" class="contact-icon mx-2">
                                        <i class="bi bi-linkedin"></i>
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection