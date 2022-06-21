@extends('website.layouts.template')

@section('content')
@include('website.pages.particles.section_1',['title'=>$page->top_heading,'content'=>$page->top_content])

<section class="slider_area section-bg">
    <div class="single_slider">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-xl-7">
                    {!! $page->main_content !!}
                </div>

                <div class="col-md-6 col-xl-5">
                    @php
                    $image = homepage('section_image')
                    @endphp

                    <div class="illastrator_png">
                        <img src="{{asset('storage/uploads/'.$image)}}" alt="image" class="img-fluid">
                    </div>
                </div>
            </div>

            <!-- <div class="text-center mt-4">
                <a href="#order" class="btn btn-sm btn-primary text-capitalize">{{$page->top_btn}}</a>
            </div> -->
        </div>
    </div>
</section>

@if($page->main_extra_content)
<section class="guarantees section-bg pt-0 main_extra_content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                {!! $page->main_extra_content !!}
            </div>
        </div>
    </div>
</section>
@endif

<section class="slider_area section-bg pt-0">
    <div class="single_slider">
        <div class="container">
            <div class="section-title">
                <h2>{{$page->qualtity_heading}}</h2>
                <p>{{$page->qualtity_content}}</p>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <h3>{{$page->qualtity_heading_1}}</h3>
                    <p class="section-about">{{$page->qualtity_about_1}}
                    </p>
                </div>
                <div class="col-md-6">
                    <h3>{{$page->qualtity_heading_2}}</h3>
                    <p class="section-about">{{$page->qualtity_about_2}}
                    </p>
                </div>
                <div class="col-md-6">
                    <h3>{{$page->qualtity_heading_3}}</h3>
                    <p class="section-about">{{$page->qualtity_about_3}}
                    </p>
                </div>
                <div class="col-md-6">
                    <h3>{{$page->qualtity_heading_4}}</h3>
                    <p class="section-about">{{$page->qualtity_about_4}}
                    </p>
                </div>
                <div class="col-md-6">
                    <h3>{{$page->qualtity_heading_5}}</h3>
                    <p class="section-about">{{$page->qualtity_about_5}}
                    </p>
                </div>
                <div class="col-md-6">
                    <h3>{{$page->qualtity_heading_6}}</h3>
                    <p class="section-about">{{$page->qualtity_about_6}}
                    </p>
                </div>
                <div class="col-md-6">
                    <h3>{{$page->qualtity_heading_7}}</h3>
                    <p class="section-about">{{$page->qualtity_about_7}}
                    </p>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="#order" class="btn btn-sm btn-primary text-capitalize">{{$page->quality_cta_btn}}</a>
            </div>
        </div>
    </div>
</section>

<!-- how to work -->
<section id="what-we-do" class="what-we-do section-bg pt-0">
    <div class="container">
        <div class="section-title">
            <h2>{{$page->how_work_heading}}</h2>
            <p>{{$page->how_work_content}}</p>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                <div class="icon-box">
                    <div class="icon"><i class="bi bi-dribbble"></i></div>
                    <h4><a href="">{{$page->how_work_step_1}}</a></h4>
                    <p>{{$page->how_work_step_1_process}}</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
                <div class="icon-box">
                    <div class="icon"><i class="bi bi-file-earmark"></i></div>
                    <h4><a href="">{{$page->how_work_step_2}}</a></h4>
                    <p>{{$page->how_work_step_2_process}}</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
                <div class="icon-box">
                    <div class="icon"><i class="bi bi-speedometer"></i></div>
                    <h4><a href="">{{$page->how_work_step_3}}</a></h3>
                        <p>{{$page->how_work_step_3_process}}</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
                <div class="icon-box">
                    <div class="icon"><i class="bi bi-briefcase"></i></div>
                    <h4><a href="">{{$page->how_work_step_4}}</a></h4>
                    <p>{{$page->how_work_step_4_process}}</p>
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="#order" class="btn btn-sm btn-primary text-center text-capitalize">{{$page->work_cta_btn}}</a>
        </div>
    </div>
    </div>
</section>
<!-- end how to work -->

<!-- tutor area -->
<section id="testimonials" class="testimonials">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2>{{$page->subject_specialist_heading}}</h2>
            <p></p>
        </div>
        <div class="col-md-10 offset-md-1">
            {!! $page->subject_specialist_content !!}
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

<!-- subject area  -->
<section id="testimonials" class="testimonials pt-0">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2>{{$page->subject_area_heading}}</h2>
            <p></p>
        </div>
        <div class="col-md-10 offset-md-1">
            {!! $page->subject_area_content !!}
        </div>
    </div>
</section>
<!-- subject area end -->

<!-- subject services  -->
<section id="testimonials" class="testimonials pt-0">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2>{{$page->subject_service_heading}}</h2>
            <p></p>
        </div>
        <div class="col-md-10 offset-md-1">
            {!! $page->subject_service_content !!}
        </div>

        <div class="text-center mt-4">
            <a href="#order" class="btn btn-sm btn-primary text-center text-capitalize">{{$page->subject_area_btn}}</a>
        </div>
    </div>
</section>
<!-- subject services end -->

<!-- Our Past Work -->
@if(count($data['works'])>0)
<section class="guarantees section-bg">
    <div class="container">
        <div class="section-title">
            <h2>{{$page->subject_sample_heading}}</h2>
            <p>{{$page->subject_sample_content}}</p>
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

<!-- faqs -->
<section id="faq" class="faq section-bg">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2>{{$page->subject_faq_heading}}</h2>
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
        <!-- <div class="text-center mt-5">
            <a href="#order" class="btn btn-sm btn-primary text-center text-capitalize">{{$page->subject_cta_btn}}</a>
        </div> -->
    </div>
</section>
<!-- faqs end -->

<!-- customer review -->
<section id="Testimonials" class="testimonials">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>{{$page->subject_testimonial_heading}}</h2>
            <p>{{$page->subject_testimonial_about}}</p>
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
<!-- subject academic services -->
<section class="slider_area pt-0">
    <div class="single_slider">
        <div class="container">
            <div class="section-title">
                <h2>{{$page->academic_service_heading}}</h2>
                <p>{!! $page->academic_service_about !!}</p>
            </div>

            <div class="row">
                <div class="col-12 col-md-6 col-lg-4">
                    <h3>{{$page->academic_service_1_heading}}</h3>
                    <p class="section-about">{!! $page->academic_service_1_about !!}
                    </p>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <h3>{{$page->academic_service_2_heading}}</h3>
                    <p class="section-about">{!! $page->academic_service_2_about !!}
                    </p>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <h3>{{$page->academic_service_3_heading}}</h3>
                    <p class="section-about">{!! $page->academic_service_3_about !!}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- subject academic services end -->

<!-- page end btn and text -->
<section class="faq section-bg">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2>{{$page->cta_btn_heading}}</h2>
            <p></p>
        </div>
        <div class="text-center mt-3">
            <a href="#order" class="btn btn-sm btn-primary text-center text-capitalize">{{$page->cta_btn_content}}</a>
        </div>
    </div>
</section>
@endsection
<!-- @push('scripts')
<script>
    $('.select-subject').on('change', function () {
        if ($(this).val()) {
            return $(this).css('color', 'black');
        } else {
            return $(this).css('color', 'gray');

        }
    });
</script>
@endpush -->