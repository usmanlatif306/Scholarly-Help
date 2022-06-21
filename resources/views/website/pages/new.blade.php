@extends('website.layouts.template')
@section('title','Online Class')
@section('content')
@include('website.pages.particles.section_1',['title'=>'Do my online class and ace it!','content'=>'Your day isn’t long
enough to worry about online classes. Focus on the rest while we ensure your online classes are done right!'])
{!! $class->content
!!}
@endsection