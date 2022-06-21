@extends('website.layouts.template')
@section('content')
@include('website.pages.particles.section_1',['title'=>$class->top_heading,'content'=>$class->top_content])
<section class="slider_area section-bg">
    <div class="single_slider">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-6 col-xl-6">
                    <h2>{{$class->section_1_heading}}</h2>
                    {!! $class->section_1_content !!}
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
            @if($class->section_1_btn_text)
            <div class="text-center mt-5">
                <a href="#order" class="btn btn-sm btn-primary text-capitalize">{{$class->section_1_btn_text}}</a>
            </div>
            @endif
        </div>
    </div>
</section>


<section class="slider_area section-bg @if($class->section_1_heading) pt-0 @endif">
    <div class="single_slider">
        <div class="container">
            <div class="section-title">
                <h2>{{$class->section_2_heading}}</h2>
                <p></p>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <h3>{{$class->choose_1_heading}}</h3>
                    <p class="section-about">{{$class->choose_1_content}}
                    </p>
                </div>
                <div class="col-md-6">
                    <h3>{{$class->choose_2_heading}}</h3>
                    <p class="section-about">{{$class->choose_2_content}}
                    </p>
                </div>
                <div class="col-md-6">
                    <h3>{{$class->choose_3_heading}}</h3>
                    <p class="section-about">{{$class->choose_3_content}}
                    </p>
                </div>
                <div class="col-md-6">
                    <h3>{{$class->choose_4_heading}}</h3>
                    <p class="section-about">{{$class->choose_4_content}}
                    </p>
                </div>
                <div class="col-md-6">
                    <h3>{{$class->choose_5_heading}}</h3>
                    <p class="section-about">{{$class->choose_5_content}}
                    </p>
                </div>
                <div class="col-md-6">
                    <h3>{{$class->choose_6_heading}}</h3>
                    <p class="section-about">{{$class->choose_6_content}}
                    </p>
                </div>
                <div class="col-md-6">
                    <h3>{{$class->choose_7_heading}}</h3>
                    <p class="section-about">{{$class->choose_7_content}}
                    </p>
                </div>
                <div class="col-md-6">
                    <h3>{{$class->choose_8_heading}}</h3>
                    <p class="section-about">{{$class->choose_8_content}}
                    </p>
                </div>

            </div>
            <div class="text-center mt-5">
                <a href="#order" class="btn btn-sm btn-primary text-capitalize">{{$class->choose_btn_text}}</a>
            </div>
        </div>
    </div>
</section>

<!-- tutors area -->
<section id="testimonials" class="testimonials">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2>{{$class->subject_expert_heading}}</h2>
            <p></p>
        </div>
        <div class="col-md-10 offset-md-1">
            {!! $class->subject_expert_content !!}
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

<!-- how to work -->
<section id="what-we-do" class="what-we-do section-bg">
    <div class="container">

        <div class="section-title">
            <h2>{{$class->work_heading}}</h2>
            <p>{{$class->work_content}}</p>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                <div class="icon-box">
                    <div class="icon"><i class="bi bi-dribbble"></i></div>
                    <h4><a href="">{{$class->work_step1_heading}}</a></h4>
                    <p>{{$class->work_step1_content}}</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
                <div class="icon-box">
                    <div class="icon"><i class="bi bi-file-earmark"></i></div>
                    <h4><a href="">{{$class->work_step2_heading}}</a></h4>
                    <p>{{$class->work_step2_content}}</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
                <div class="icon-box">
                    <div class="icon"><i class="bi bi-speedometer"></i></div>
                    <h4><a href="">{{$class->work_step3_heading}}</a></h4>
                    <p>{{$class->work_step3_content}}</p>
                </div>
            </div>
        </div>
        <div class="text-center mt-5">
            <a href="#order" class="btn btn-sm btn-primary text-capitalize">{{$class->work_btn_text}}</a>
        </div>
    </div>
</section>
<!-- end how to work -->
<!-- Our Past Work -->
@if(count($data['works'])>0)
<section class="guarantees section-bg">
    <div class="container">
        <div class="section-title">
            <h2>OUR PAST WORK</h2>
            <p>If you are feeling confused or unable to decide whether to hand us your work or not, here is a glimpse of
                documents written by our subject experts in the past.</p>
        </div>

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
</section>
@endif
<!-- End our past work -->
<!-- service area -->
<section class="guarantees section-bg">
    <div class="container">
        <div class="section-title">
            <h2>{{$class->service_heading}}</h2>
            <p>{{$class->service_content}}</p>
        </div>

        <div class="row">
            <div class="col-md-6 col-xl-4 mt-3 d-flex flex-wrap">
                <div class="icon-box" style="min-height: 160px;">
                    <i class="bi bi-file-earmark-text"></i>
                    <h4><a href="#">{{$class->service1_heading}}</a></h4>
                    <p style="text-align:justify;">{{$class->service1_content}}</p>
                </div>
            </div>
            <div class="col-md-6 col-xl-4 mt-3 d-flex flex-wrap">
                <div class="icon-box" style="min-height: 160px;">
                    <i class="bi bi-file-earmark-text"></i>
                    <h4><a href="#">{{$class->service2_heading}}</a></h4>
                    <p style="text-align:justify;">{{$class->service2_content}}</p>
                </div>
            </div>
            <div class="col-md-6 col-xl-4 mt-3 d-flex flex-wrap">
                <div class="icon-box" style="min-height: 160px;">
                    <i class="bi bi-file-earmark-text"></i>
                    <h4><a href="#">{{$class->service3_heading}}</a></h4>
                    <p style="text-align:justify;">{{$class->service3_content}}</p>
                </div>
            </div>
            @if($class->service4_heading)
            <div class="col-md-6 col-xl-4 mt-3 d-flex flex-wrap">
                <div class="icon-box" style="min-height: 160px;">
                    <i class="bi bi-file-earmark-text"></i>
                    <h4><a href="#">{{$class->service4_heading}}</a></h4>
                    <p style="text-align:justify;">{{$class->service4_content}}</p>
                </div>
            </div>
            @endif
        </div>
        <div class="text-center mt-5">
            <a href="#order" class="btn btn-sm btn-primary text-capitalize">{{$class->service_btn_text}}</a>
        </div>
    </div>
</section>
<!-- service area end -->

<!-- subject area -->
<section class="guarantees section-bg">
    <div class="container">
        <div class="section-title">
            <h2>Subjects We Work On</h2>
            <p></p>
        </div>

        <div class="row">
            @foreach($data['subjs'] as $item)
            <div class="col-md-4 col-lg-3 mt-3">
                <div class="icon-box" style="min-height: 50px;">
                    <i class="bi bi-book"></i>
                    <h4 style="padding-top: 3px;"><a href="{{route('class_page_sub',$item->slug)}}"
                            class="text-capitalize">{{$item->name}}</a></h4>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- subject area end -->

<!-- customer review -->
<section id="Testimonials" class="testimonials">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Client Testimonials</h2>
            <p>We’re a trustworthy team of academics, take a look at what our clients have to say about us</p>
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
                                        ({{count($item->ratings_received)}} reviews)
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
<!-- customer review end -->

<!-- faqs -->
<section id="faq" class="faq section-bg">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Have Concerns?</h2>
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
<section class="faq section-bg pt-0">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2>{{$class->last_heading}}</h2>
            <p></p>
        </div>
        <div class="text-center mt-4">
            <a href="#order" class="btn btn-sm btn-primary text-center text-capitalize">{{$class->last_btn_text}}</a>
        </div>
    </div>
</section>
@endsection