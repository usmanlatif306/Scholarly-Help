<!-- slider_area_start -->
<div class="slider_area">
    <div class="single_slider d-flex align-items-center justify-content-center pb-5 slider_background">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-center">

                <div class="col-xl-6 col-md-6">
                    @php
                    $image = homepage('hero_image')
                    @endphp

                    <div class="illastrator_png">
                        <img src="{{asset('storage/uploads/'.$image)}}" alt="image" class="img-fluid" width="80%"
                            height="100%">
                        <h1 class="text-center text-white">{!! homepage('hero_title_1') !!}</h1>
                        <p class="text-center text-white" style="font-size: 16px;">{!! homepage('hero_content_1')
                            !!}</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-4">
                    @include('website.partials.order')
                </div>
            </div>
        </div>
    </div>
</div>
<!-- slider_area_end -->