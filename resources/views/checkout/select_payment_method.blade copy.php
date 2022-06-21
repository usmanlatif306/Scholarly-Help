@extends('layouts.app')
@section('title', 'Select a payment method')
@section('content')
<div class="container page-container">
   <div class="row">
      <div class="col-md-12">
         @if(isset($data['order_number']) && isset($data['order_link']))
         <div class="md-card-content">
            <div id="" class="wizard clearfix">
               <div class="steps clearfix">
                  <ul role="tablist">
                     <li role="tab" class="first" aria-disabled="false" aria-selected="true">
                        <a href="#" aria-controls="wizard_advanced-p-0"><span class="number">1</span> <span
                              class="title">Place Order</span></a>
                     </li>
                     <li role="tab" class="" aria-disabled="false" aria-selected="true"><a id="wizard_advanced-t-1"
                           href="#" aria-controls="wizard_advanced-p-1"><span class="number">2</span> <span
                              class="title">Additional Details</span></a></li>
                     <li role="tab" class="last current" aria-disabled="true"><a id="wizard_advanced-t-2" href="#"
                           aria-controls="wizard_advanced-p-2"><span class="number">3</span> <span class="title">Pay
                              Fee</span></a></li>
                  </ul>
               </div>
            </div>
         </div>
         <hr>
         @else
         <h3>Select a payment method</h3>
         @endif
      </div>
      <div class="col-md-6 d-none d-lg-block">
         <div class="checkout-image-cover">
            <img src="{{ asset('images/payment.svg') }}" class="img-fluid">
         </div>
      </div>
      <div class="col-md-6">
         <div class="card">
            <div class="card-body">
               <div class="d-flex justify-content-between">
                  <h4 class="h4">Total</h4>
                  <div class="h4">{{ format_money($data['total']) }}</div>
               </div>
               @if(isset($data['order_number']) && isset($data['order_link']))
               <small>Your order number is : <a href="{{ $data['order_link'] }}">{{ $data['order_number'] }}</a></small>
               @endif
               <hr>
               @if(isset($data['payment_options']['online']))
               <p class="text-muted">Online</p>
               <div class="list-group">
                  @foreach($data['payment_options']['online'] as $option)
                  <a href="{{ $option->url }}" class="list-group-item list-group-item-action">
                     {{ $option->name }}
                  </a>
                  @endforeach
               </div>
               @endif


               @if(isset($data['payment_options']['offline']))
               <br>
               <p class="text-muted">Offline</p>
               <div class="list-group">
                  @foreach($data['payment_options']['offline'] as $option)
                  <a href="{{ route('pay_with_offline_method', $option->slug) }}"
                     class="list-group-item list-group-item-action">
                     <div>{{ $option->name }}</div>
                     <small class="text-muted">{{ $option->description }}</small>
                  </a>
                  @endforeach
               </div>
               @endif
               @if($data['show_wallet_option'])
               <br>
               <p class="text-muted">Wallet- Balance: {{ format_money(auth()->user()->wallet()->balance()) }}</p>
               <div class="list-group">
                  <a href="{{ route('pay_with_wallet') }}" class="list-group-item list-group-item-action">
                     <div><i class="fas fa-wallet"></i> Pay using your wallet</div>
                  </a>
               </div>
               @endif

            </div>
         </div>
      </div>
   </div>

</div>

@endsection