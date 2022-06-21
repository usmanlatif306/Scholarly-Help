@extends('website.layouts.template')
@section('title','Exams')
@section('content')
@include('website.pages.particles.section_1',['title'=>$exam->top_heading,'content'=>$exam->top_content])

<section class="slider_area section-bg">
    <div class="single_slider">
        <div class="container">
            <div class="section-title">
                <h2>{{$exam->section1_heading}}</h2>
                <p></p>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <h3>{{$exam->choose1_heading}}</h3>
                    <p class="section-about">{{$exam->choose1_content}}
                    </p>
                </div>
                <div class="col-md-6">
                    <h3>{{$exam->choose2_heading}}</h3>
                    <p class="section-about">{{$exam->choose2_content}}
                    </p>
                </div>
                <div class="col-md-6">
                    <h3>{{$exam->choose3_heading}}</h3>
                    <p class="section-about">{{$exam->choose3_content}}
                    </p>
                </div>
                <div class="col-md-6">
                    <h3>{{$exam->choose4_heading}}</h3>
                    <p class="section-about">{{$exam->choose4_content}}
                    </p>
                </div>

            </div>
            <div class="text-center mt-4">
                <a href="#order" class="btn btn-sm btn-primary text-capitalize">{{$exam->choose4_btn_text}}</a>
            </div>
        </div>
    </div>
</section>

<section class="slider_area section-bg pt-0">
    <div class="single_slider">
        <div class="container">
            <div class="section-title">
                <h2>{{$exam->guarantee_heading}}</h2>
                <p></p>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <h3>{{$exam->guarantee1_heading}}</h3>
                    <p class="section-about">{{$exam->guarantee1_content}}
                    </p>
                </div>
                <div class="col-md-6">
                    <h3>{{$exam->guarantee2_heading}}</h3>
                    <p class="section-about">{{$exam->guarantee2_content}}
                    </p>
                </div>
                <div class="col-md-6">
                    <h3>{{$exam->guarantee3_heading}}</h3>
                    <p class="section-about">{{$exam->guarantee3_content}}
                    </p>
                </div>
                <div class="col-md-6">
                    <h3>{{$exam->guarantee4_heading}}</h3>
                    <p class="section-about">{{$exam->guarantee4_content}}
                    </p>
                </div>
                <div class="col-md-6">
                    <h3>{{$exam->guarantee5_heading}}</h3>
                    <p class="section-about">{{$exam->guarantee5_content}}
                    </p>
                </div>
                <div class="col-md-6">
                    <h3>{{$exam->guarantee6_heading}}</h3>
                    <p class="section-about">{{$exam->guarantee6_content}}
                    </p>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="#order" class="btn btn-sm btn-primary text-capitalize">{{$exam->guarantee_btn_text}}</a>
            </div>
        </div>
    </div>
</section>

<section class="slider_area section-bg pt-0">
    <div class="single_slider">
        <div class="container">
            <div class="section-title">
                <h2>{{$exam->exam_type_heading}}</h2>
                <p></p>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <h3>{{$exam->exam_type1_heading}}</h3>
                    <p class="section-about">{{$exam->exam_type1_content}}
                    </p>
                </div>
                <div class="col-md-6">
                    <h3>{{$exam->exam_type2_heading}}</h3>
                    <p class="section-about">{{$exam->exam_type2_content}}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- subject area -->
<section class="guarantees section-bg">
    <div class="container">
        <div class="section-title">
            <h2>List of subjects</h2>
            <p>We can help you with almost every subject. Let us know the subject for which you catechize us to take my
                exam.</p>
        </div>

        <div class="row">
            @foreach($data['subjs'] as $item)
            <div class="col-md-4 col-lg-3 mt-3">
                <div class="icon-box" style="min-height: 50px;">
                    <i class="bi bi-book"></i>
                    <h4 style="padding-top: 3px;"><a href="{{route('exam_page_sub',$item->slug)}}"
                            class="text-capitalize">{{$item->name}}</a></h4>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- subject area end -->
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
<!-- faqs -->
<section id="faq" class="faq section-bg pt-0">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>FAQs</h2>
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
            <p></p>
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
            <h2>{{$exam->last_heading}}</h2>
            <p></p>
        </div>
        <div class="text-center mt-4">
            <a href="#order" class="btn btn-sm btn-primary text-center text-capitalize">{{$exam->last_btn_text}}</a>
        </div>
    </div>
</section>
@endsection