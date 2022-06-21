@extends('website.layouts.template')
@section('content')
@include('website.partials.home_page_section_1')
@include('website.partials.home_page_section_2')
@include('website.partials.home_page_section_3')

<!-- ======= Order Section ======= -->
<!-- End Order Section -->

<!-- ======= best totur Section ======= -->
@include('website.partials.tutors')
<!-- End best totur Section -->

<!-- ======= guarantees Section ======= -->
@include('website.partials.guarantees')
<!-- End guarantees Section -->

<!-- ======= How it works? Section ======= -->
@include('website.partials.works')
<!-- End How it works? -->

<!-- ======= Services Section ======= -->
@include('website.partials.services')
<!-- End Services Section -->

<!-- ======= Popular Categories among Students  ======= -->
@include('website.partials.categories')
<!-- End Popular Categories among Students -->

<!--testimonials-->
@include('website.partials.testimonials')
<!--/end testimonials-->

<!-- ======= Frequently Asked Questions Section ======= -->
@include('website.partials.faqs')
<!-- End Frequently Asked Questions Section -->



@endsection
@push('scripts')
<script>
    $('.select-subject').on('change', function () {
        if ($(this).val()) {
            return $(this).css('color', 'black');
        } else {
            return $(this).css('color', 'gray');

        }
    });
</script>
@endpush