@extends('website.layouts.template')
@section('title','Essay Writing')
@section('content')
@include('website.pages.particles.section_1',['title'=>$essay->top_heading,'content'=>$essay->top_content])

<section class="slider_area section-bg">
    <div class="single_slider">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-6 col-xl-6">
                    {!! $essay->section_content !!}
                </div>

                <div class="col-xl-5 col-md-6">
                    @php
                    $image = homepage('section_image')
                    @endphp

                    <div class="illastrator_png">
                        <img src="{{asset('storage/uploads/'.$image)}}" alt="image" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- why stydent trust us-->
<section class="slider_area section-bg pt-0">
    <div class="single_slider">
        <div class="container">
            <div class="section-title">
                <h2>{{$essay->section1_heading}}</h2>
                <p>{{$essay->section1_content}}</p>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <h3>{{$essay->choose1_heading}}</h3>
                    <p class="section-about">{{$essay->choose1_content}}
                    </p>
                </div>
                <div class="col-md-6">
                    <h3>{{$essay->choose2_heading}}</h3>
                    <p class="section-about">{{$essay->choose2_content}}
                    </p>
                </div>
                <div class="col-md-6">
                    <h3>{{$essay->choose3_heading}}</h3>
                    <p class="section-about">{{$essay->choose3_content}}
                    </p>
                </div>
                <div class="col-md-6">
                    <h3>{{$essay->choose4_heading}}</h3>
                    <p class="section-about">{{$essay->choose4_content}}
                    </p>
                </div>
                <div class="col-md-6">
                    <h3>{{$essay->choose5_heading}}</h3>
                    <p class="section-about">{{$essay->choose5_content}}
                    </p>
                </div>
                <div class="col-md-6">
                    <h3>{{$essay->choose6_heading}}</h3>
                    <p class="section-about">{{$essay->choose6_content}}
                    </p>
                </div>

            </div>
            <div class="text-center mt-5">
                <a href="#order" class="btn btn-sm btn-primary text-center text-capitalize">{{$essay->section_btn}}</a>
            </div>
        </div>
    </div>
</section>
<!-- why stydent trust us end -->

<!-- how to work -->
<section id="what-we-do" class="what-we-do section-bg pt-0">
    <div class="container">

        <div class="section-title">
            <h2>{{$essay->work_heading}}</h2>
            <p>{{$essay->work_sub_heading}}</p>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                <div class="icon-box">
                    <div class="icon"><i class="bi bi-dribbble"></i></div>
                    <h4><a href="">{{$essay->work_step1_heading}}</a></h4>
                    <p>{{$essay->work_step1_content}}</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
                <div class="icon-box">
                    <div class="icon"><i class="bi bi-file-earmark"></i></div>
                    <h4><a href="">{{$essay->work_step2_heading}}</a></h4>
                    <p>{{$essay->work_step2_content}}</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
                <div class="icon-box">
                    <div class="icon"><i class="bi bi-speedometer"></i></div>
                    <h4><a href="">{{$essay->work_step3_heading}}</a></h3>
                        <p>{{$essay->work_step3_content}}</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
                <div class="icon-box">
                    <div class="icon"><i class="bi bi-briefcase"></i></div>
                    <h4><a href="">{{$essay->work_step4_heading}}</a></h4>
                    <p>{{$essay->work_step4_content}}</p>
                </div>
            </div>
        </div>
        <div class="text-center mt-5">
            <a href="#order" class="btn btn-sm btn-primary text-center text-capitalize">{{$essay->work_btn}}</a>
        </div>
    </div>
    </div>
</section>
<!-- end how to work -->

<!-- free services -->
<section class="guarantees section-bg pt-0">
    <div class="container">
        <div class="section-title">
            <h2>{{$essay->guarantee_heading}}</h2>
            <p>Take advantage of numerous services which are absolutely free-of-cost for your convenience. </p>
        </div>

        <div class="row">
            <div class="col-md-6 col-lg-4 mt-3">
                <div class="icon-box" style="min-height: 110px;">
                    <span>Free</span>
                    <h4 style="padding-top: 3px;"><a href="#" class="text-capitalize">{{$essay->guarantee1_heading}}</a>
                    </h4>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mt-3">
                <div class="icon-box" style="min-height: 110px;">
                    <span>Free</span>
                    <h4 style="padding-top: 3px;"><a href="#" class="text-capitalize">{{$essay->guarantee2_heading}}</a>
                    </h4>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mt-3">
                <div class="icon-box" style="min-height: 110px;">
                    <span>Free</span>
                    <h4 style="padding-top: 3px;"><a href="#" class="text-capitalize">{{$essay->guarantee3_heading}}</a>
                    </h4>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mt-3">
                <div class="icon-box" style="min-height: 110px;">
                    <span>Free</span>
                    <h4 style="padding-top: 3px;"><a href="#" class="text-capitalize">{{$essay->guarantee4_heading}}</a>
                    </h4>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mt-3">
                <div class="icon-box" style="min-height: 110px;">
                    <span>Free</span>
                    <h4 style="padding-top: 3px;"><a href="#" class="text-capitalize">{{$essay->guarantee5_heading}}</a>
                    </h4>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mt-3">
                <div class="icon-box" style="min-height: 110px;">
                    <span>Free</span>
                    <h4 style="padding-top: 3px;"><a href="#" class="text-capitalize">{{$essay->guarantee6_heading}}</a>
                    </h4>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- free services end -->

<!-- tutors area -->
<section id="testimonials" class="testimonials">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2>{{$essay->expert_heading}}</h2>
            <p></p>
        </div>
        <div class="col-md-10 offset-md-1">
            {!! $essay->expert_content !!}
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
                                    <h3>{{$item->first_name}} {{$item->last_name}}</h3>
                                    <span>{{number_format($item->ratings_received->avg('number'), 2, '.', ',')}}</span>
                                    <span class="text-warning">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        @if($item->ratings_received->avg('number') === 5)
                                        <i class="fa fa-star"></i>
                                        @elseif($item->ratings_received->avg('number') > 4)
                                        <i class="fas fa-star-half-alt">
                                        </i>
                                        @else
                                        <i class="far fa-star"></i>
                                        @endif
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

<!-- subject area -->
<section class="guarantees section-bg">
    <div class="container">
        <div class="section-title">
            <h2>{{$essay->essay_type}}</h2>
            <p>{{$essay->essay_type_content}}</p>
        </div>

        <div class="row">
            <div class="col-md-4 col-lg-3 mt-3">
                <div class="icon-box" style="min-height: 50px;">
                    <i class="bi bi-book"></i>
                    <h4 style="padding-top: 3px;"><a href="#">{{$essay->essay1}}</a></h4>
                </div>
            </div>
            <div class="col-md-4 col-lg-3 mt-3">
                <div class="icon-box" style="min-height: 50px;">
                    <i class="bi bi-book"></i>
                    <h4 style="padding-top: 3px;"><a href="#">{{$essay->essay2}}</a></h4>
                </div>
            </div>
            <div class="col-md-4 col-lg-3 mt-3">
                <div class="icon-box" style="min-height: 50px;">
                    <i class="bi bi-book"></i>
                    <h4 style="padding-top: 3px;"><a href="#">{{$essay->essay3}}</a></h4>
                </div>
            </div>
            <div class="col-md-4 col-lg-3 mt-3">
                <div class="icon-box" style="min-height: 50px;">
                    <i class="bi bi-book"></i>
                    <h4 style="padding-top: 3px;"><a href="#">{{$essay->essay4}}</a></h4>
                </div>
            </div>
            <div class="col-md-4 col-lg-3 mt-3">
                <div class="icon-box" style="min-height: 50px;">
                    <i class="bi bi-book"></i>
                    <h4 style="padding-top: 3px;"><a href="#">{{$essay->essay5}}</a></h4>
                </div>
            </div>
            <div class="col-md-4 col-lg-3 mt-3">
                <div class="icon-box" style="min-height: 50px;">
                    <i class="bi bi-book"></i>
                    <h4 style="padding-top: 3px;"><a href="#">{{$essay->essay6}}</a></h4>
                </div>
            </div>
            <div class="col-md-4 col-lg-3 mt-3">
                <div class="icon-box" style="min-height: 50px;">
                    <i class="bi bi-book"></i>
                    <h4 style="padding-top: 3px;"><a href="#">{{$essay->essay7}}</a></h4>
                </div>
            </div>
            <div class="col-md-4 col-lg-3 mt-3">
                <div class="icon-box" style="min-height: 50px;">
                    <i class="bi bi-book"></i>
                    <h4 style="padding-top: 3px;"><a href="#">{{$essay->essay8}}</a></h4>
                </div>
            </div>
            <div class="col-md-4 col-lg-3 mt-3">
                <div class="icon-box" style="min-height: 50px;">
                    <i class="bi bi-book"></i>
                    <h4 style="padding-top: 3px;"><a href="#">{{$essay->essay9}}</a></h4>
                </div>
            </div>
            <div class="col-md-4 col-lg-3 mt-3">
                <div class="icon-box" style="min-height: 50px;">
                    <i class="bi bi-book"></i>
                    <h4 style="padding-top: 3px;"><a href="#">{{$essay->essay10}}</a></h4>
                </div>
            </div>
            <div class="col-md-4 col-lg-3 mt-3">
                <div class="icon-box" style="min-height: 50px;">
                    <i class="bi bi-book"></i>
                    <h4 style="padding-top: 3px;"><a href="#">{{$essay->essay11}}</a></h4>
                </div>
            </div>
            <div class="col-md-4 col-lg-3 mt-3">
                <div class="icon-box" style="min-height: 50px;">
                    <i class="bi bi-book"></i>
                    <h4 style="padding-top: 3px;"><a href="#">{{$essay->essay12}}</a></h4>
                </div>
            </div>
            <div class="col-md-4 col-lg-3 mt-3">
                <div class="icon-box" style="min-height: 50px;">
                    <i class="bi bi-book"></i>
                    <h4 style="padding-top: 3px;"><a href="#">{{$essay->essay13}}</a></h4>
                </div>
            </div>
            <div class="col-md-4 col-lg-3 mt-3">
                <div class="icon-box" style="min-height: 50px;">
                    <i class="bi bi-book"></i>
                    <h4 style="padding-top: 3px;"><a href="#">{{$essay->essay14}}</a></h4>
                </div>
            </div>
            <div class="col-md-4 col-lg-3 mt-3">
                <div class="icon-box" style="min-height: 50px;">
                    <i class="bi bi-book"></i>
                    <h4 style="padding-top: 3px;"><a href="#">{{$essay->essay15}}</a></h4>
                </div>
            </div>
            <div class="col-md-4 col-lg-3 mt-3">
                <div class="icon-box" style="min-height: 50px;">
                    <i class="bi bi-book"></i>
                    <h4 style="padding-top: 3px;"><a href="#">{{$essay->essay16}}</a></h4>
                </div>
            </div>
            <div class="col-md-4 col-lg-3 mt-3">
                <div class="icon-box" style="min-height: 50px;">
                    <i class="bi bi-book"></i>
                    <h4 style="padding-top: 3px;"><a href="#">{{$essay->essay17}}</a></h4>
                </div>
            </div>
            <div class="col-md-4 col-lg-3 mt-3">
                <div class="icon-box" style="min-height: 50px;">
                    <i class="bi bi-book"></i>
                    <h4 style="padding-top: 3px;"><a href="#">{{$essay->essay18}}</a></h4>
                </div>
            </div>

        </div>
        <div class="text-center mt-5">
            <a href="#order" class="btn btn-sm btn-primary text-center">{{$essay->essay_btn}}</a>
        </div>

    </div>
</section>
<!-- subject area end -->
<!-- Our Past Work -->
<section class="guarantees section-bg">
    <div class="container">
        <div class="section-title">
            <h2>{{$essay->sample_work_heading}}</h2>
            <p></p>
        </div>

        <div class="row">
            <div class="row">
                @foreach($data['works'] as $item)
                <div class="mt-3 @if(count($data['works'])!==1) col-md-6 col-xl-4 @else col-md-4 offset-md-4 @endif">
                    <div class="icon-box" style="min-height: 50px;">
                        <a href="{{asset($item->file)}}" download="">
                            <i class="bi bi-file-zip">
                            </i>
                        </a>
                        <h4 class="pt-0 pt-md-2"><a href="{{asset($item->file)}}">{{$item->name}}</a></h4>
                    </div>
                </div>
                @endforeach

            </div>

        </div>
    </div>
    </div>
</section>
<!-- End our past work -->


<!-- faqs -->
<section id="faq" class="faq section-bg">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>{{$essay->faqs_heading}}</h2>
            <p></p>
        </div>
        <div class="faq-list">
            <ul>
                @foreach($data['faqs'] as $faq)
                <li data-aos="fade-up" data-aos-delay="{{$loop->iteration}}00">
                    <i class=""></i> <a data-bs-toggle="collapse" class=""
                        data-bs-target="#faq-list-{{$faq->id}}">{{$faq->question}}<i class=""></i><i class=""></i></a>
                    <div id="faq-list-{{$faq->id}}" class="collapse" data-bs-parent=".faq-list">
                        <p>
                            {{$faq->answer}}
                        </p>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>
<!-- faqs end -->
<!-- customer review -->
<section id="Testimonials" class="testimonials">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2>Testimonials</h2>
        </div>
        <div class="testimonials-slider swiper mt-5" data-aos="fade-up" data-aos-delay="100">
            <div class="swiper-wrapper">
                @foreach($data['ratings'] as $item)
                <div class="swiper-slide">
                    <div class="testimonial-item">
                        <div class="pb-3">
                            <div class="d-flex justify-content-center align-items-center">
                                <img src="{{asset('storage/'.$item->user->photo)}}" class="testimonial-img" alt="">
                                <div class="ml-3 text-left">
                                    <h3>{{$item->user->first_name}}</h3>
                                    <span>{{number_format($item->number, 2, '.', ',')}}</span>
                                    <span class="text-warning">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        @if($item->number < 5) <i class="fas fa-star-half-alt">
                                            </i>
                                            </i>
                                            @elseif($item->number < 4.5) <i class="far fa-star"></i>
                                                </i>
                                                @else
                                                <i class="fa fa-star"></i>
                                                @endif
                                                <!-- <i class="fas fa-star-half-alt"></i> -->
                                    </span>
                                </div>
                            </div>
                        </div>
                        <p class="mt-3">
                            <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                            {{$item->comment}}
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
<!-- customer review end -->
<section class="faq section-bg">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2>{{$essay->last_heading}}</h2>
            <p></p>
        </div>
        <div class="text-center mt-4">
            <a href="#order" class="btn btn-sm btn-primary text-center text-capitalize">{{$essay->last_btn_text}}</a>
        </div>
    </div>
</section>
@endsection