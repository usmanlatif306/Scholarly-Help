@extends('layouts.app')
@section('title', 'Choose Tutors')
@section('content')
<div class="container writer-page-container">
    <h2>Tutors who placed their offers</h2>
    <br>
    <!-- Showing bids -->
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="md-card-content">
                        <div id="" class="wizard clearfix">
                            <div class="steps clearfix">
                                <ul role="tablist">
                                    <li role="tab" class="first" aria-disabled="false" aria-selected="true">
                                        <a href="{{ route('order_page') }}" aria-controls="wizard_advanced-p-0"><span
                                                class="number">1</span>
                                            <span class="title">Place Order</span></a>
                                    </li>
                                    <li role="tab" class="current" aria-disabled="false" aria-selected="true">
                                        <a id="wizard_advanced-t-1" href="#" aria-controls="wizard_advanced-p-1"><span
                                                class="number">2</span>
                                            <span class="title">Choose Tutor</span></a>
                                    </li>
                                    <li role="tab" class="last" aria-disabled="true">
                                        <a id="wizard_advanced-t-2" href="#" aria-controls="wizard_advanced-p-2"><span
                                                class="number">3</span>
                                            <span class="title">Pay Fee</span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <form action="{{route('select_write',$order->id)}}" method="POST">
                        @csrf
                        <input type="text" style="opacity: 0;">
                        <button type="submit" class="btn btn-sm btn-primary mb-3 float-right">Select the best
                            Subject
                            Expert for me</button>
                    </form>
                    <bids :user="{{auth()->user()}}" :writers="{{$writers}}"
                        :add_message_url="'{{ route('message.save') }}'" :get_message_url="'{{ route('message.get') }}'"
                        :change_message_status_url="'{{ route('message.status') }}'" :order="{{$order}}"
                        :writer_choose_url="'{{ route('select_write',$order->id) }}'"
                        :sound="'{{asset('music/sound.mp3')}}'" />
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="">
                <div class="card">
                    <h5 class="card-title order-summary-title">Order Summary</h5>
                    <div class="card-body">
                        <div class="mb-4">
                            <p>
                                <b>Service</b>
                                <br />
                                {{ preg_replace('/_[0-9]*/', '', $order->service->name) }}
                                <br />
                                @if($order->sub_category)
                                <b>Sub Cetegory</b>
                                <br />
                                {{ $order->sub_category }}
                                <br />
                                @endif
                                <small class="form-text text-muted">{{ $order->work_level->name }} (Work
                                    level)</small>
                                <small class="form-text text-muted">
                                    {{ $order->guarantee }} (Guarantee)
                                </small>
                                <small class="form-text text-muted">
                                    {{ $order->subject }} (Subject)
                                </small>
                            </p>
                            <div>
                                <b>Deadline</b>
                                :
                                {{Carbon\Carbon::createFromFormat('Y-m-d H:i:s',
                                $order->dead_line)->format('Y-m-d H:i:s')}}

                            </div>
                            <div>
                                <b>Rate</b>
                                :
                                ${{$order->unit_price}}
                            </div>
                            @php
                            $type = $order->service->price_type_id;
                            @endphp
                            @if($type === PriceType::PerPage || $type === PriceType::PerSlide || $type ===
                            PriceType::PerWord)
                            <div>
                                <b>
                                    @if($type === PriceType::PerPage)
                                    Pages
                                    @elseif($type === PriceType::PerSlide)
                                    Slides
                                    @else
                                    Words
                                    @endif
                                </b>
                                :
                                {{ $order->quantity }}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection