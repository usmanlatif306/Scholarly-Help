@extends('website.layouts.template')
@section('title','Tools')
@section('content')
@include('website.pages.particles.section_1',['title'=>$page->top_heading,'content'=>$page->top_content])

<!-- service area -->
<section class="guarantees section-bg">
    <div class="container">
        <div class="section-title">
            <h2>{{$page->top_heading}} </h2>
            <p>{{$page->top_section_content}}</p>
        </div>

        <div class="row">
            <div class="col-md-6 col-xl-4 mt-3">
                <div class="icon-box">
                    <i class="bi bi-people"></i>
                    <h4><a href="#">{{$page->way_1_heading}}</a></h4>
                    <p style="text-align:justify;">{{$page->way_1_content}}</p>
                    <p><a href="mailto:{{$page->way_1_email}} ">{{$page->way_1_email}} </a></p>
                </div>
            </div>
            <div class="col-md-6 col-xl-4 mt-3">
                <div class="icon-box">
                    <i class="bi bi-envelope"></i>
                    <h4><a href="#">{{$page->way_2_heading}}</a></h4>
                    <p style="text-align:justify;">{{$page->way_2_heading}}</p>
                    <p><a href="mailto:{{$page->way_2_email}}">{{$page->way_2_email}}</a></p>
                </div>
            </div>
            <div class="col-md-6 col-xl-4 mt-3">
                <div class="icon-box">
                    <i class="bi bi-telephone"></i>
                    <h4><a href="#">{{$page->way_3_heading}}</a></h4>
                    <p style="text-align:justify;">{{$page->way_3_heading}}</p>
                    <p><a href="callto:{{$page->way_3_number}}">{{$page->way_3_number}}</a></p>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<section class="guarantees section-bg pt-0">
    <div class="container">
        <div class="section-title">
            <h2>{{$page->hub_heading}}</h2>
            <p></p>
        </div>
        <div class="row">
            <div class="col-12 col-md-10 offset-md-1">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5>{{$page->hub_1_heading}}</h5>
                                <p>{{$page->hub_1_content}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5>{{$page->hub_2_heading}}</h5>
                                <p>{{$page->hub_2_content}}</p>
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