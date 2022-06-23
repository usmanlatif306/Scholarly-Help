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
                        <a href="{{route('order_page')}}" aria-controls="wizard_advanced-p-0"><span class="number">1</span> <span class="title">Place Order</span></a>
                     </li>
                     <li role="tab" class="" aria-disabled="false" aria-selected="true"><a id="wizard_advanced-t-1" href="#" aria-controls="wizard_advanced-p-1"><span class="number">2</span> <span class="title">Additional Details</span></a></li>
                     <li role="tab" class="last current" aria-disabled="true"><a id="wizard_advanced-t-2" href="#" aria-controls="wizard_advanced-p-2"><span class="number">3</span> <span class="title">Pay
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
               @if(session('fail'))
               <div class="alert alert-danger">{{session('fail')}}</div>
               @endif
               @if(session('error'))
               <div class="alert alert-danger">{{session('error')}}</div>
               @endif
               <div class="d-flex justify-content-between">
                  <h4 class="h4">Total</h4>
                  <div class="h4 showAmount">{{
                     format_money($data['total']) }}
                  </div>
               </div>
               <hr />
               <!-- promo code  -->
               <form id='promo-form' action="{{route('apply_promo_code_payment')}}" method="POST" class="mt-3">
                  <div class="mb-3">
                     <div class="alert d-none" id="promoAlert" role="alert"></div>
                     <label for="card-element">Apply Coupon Code</label>
                     <div class="d-flex">
                        {{ csrf_field() }}
                        <input type="hidden" name="total" value="{{$data['total']}}">
                        <input type="text" name="code" class="form-control mr-3" placeholder="Enter Coupon Code" required>
                        <button id="promoBtn" class="btn btn-success">Apply</button>
                     </div>
                  </div>
               </form>
               <!-- promo code end -->
               <hr />
               @foreach($data['payment_options']['online'] as $option)
               <!-- stripe payment  -->
               @if($option->unique_name === 'stripe')
               <form id='payment-form' class="mb-4" style="display: none;">
                  <div class="mb-3">
                     <label for="card-element">Credit or debit card</label>
                     <div id="card-element"></div>
                     <div id="card-errors" class="invalid-feedback d-block"></div>
                  </div>
                  <button type="submit" class="btn btn-success btn-lg btn-block confirm-button" disabled><i class="fas fa-shopping-cart"></i> Confirm Payment</button>
               </form>
               <div class="text-center" id="loading">Please wait ...</div>
               @endif
               <!-- stripe payment end -->

               <!-- flutter payment -->
               @if($option->unique_name === 'flutterwave')
               <form method="POST" action="{{ route('flutter.pay') }}" id="paymentForm">
                  <label for="card-element">{{$option->name}}</label>
                  @csrf
                  <input type="hidden" name="name" value="{{auth()->user()->first_name}} {{auth()->user()->last_name}}" />
                  <input type="hidden" name="email" value="{{auth()->user()->email}}" />
                  <input type="hidden" name="phone" />
                  <input type="hidden" id="flutterAmount" name="amount" value="{{$data['total']}}" />
                  <button type="button" class="btn btn-success btn-lg btn-block confirm-button" onclick="makePayment()"><i class="fas fa-shopping-cart"></i> Confirm Payment</button>
               </form>
               @endif
               <!-- flutter payment end -->
               @endforeach

               @if(isset($data['payment_options']['offline']))
               <br>
               <p class="text-muted">Offline</p>
               <div class="list-group">
                  @foreach($data['payment_options']['offline'] as $option)
                  <a href="{{ route('pay_with_offline_method', $option->slug) }}" class="list-group-item list-group-item-action">
                     <div>{{ $option->name }}</div>
                     <small class="text-muted">{{ $option->description }}</small>
                  </a>
                  @endforeach
               </div>
               @endif
               <hr />
               @if($data['show_wallet_option'])
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
   <div id="publishable_key" data-publishablekey="{{ $data['publishable_key'] }}"></div>
   <div id="process_url" data-processurl="{{ route('stripe_process') }}"></div>
</div>

@endsection
@push('scripts')

<script src="https://js.stripe.com/v3/"></script>
<script src="https://checkout.flutterwave.com/v3.js"></script>
<script>
   function makePayment() {
      let token = $('input[name="_token"]').val();
      let name = $('input[name="name"]').val();
      let email = $('input[name="email"]').val();
      let phone = $('input[name="phone"]').val();
      let amount = $('input[name="amount"]').val();

      const model = FlutterwaveCheckout({
         public_key: "{{env('FLW_PUBLIC_KEY')}}",
         tx_ref: token,
         amount: amount,
         currency: "USD",
         payment_options: "card",
         redirect_url: "{{route('flutter.callback')}}",
         customer: {
            email: email,
            phone_number: phone,
            name: name,
         },
         customizations: {
            title: "Scholarly Help",
            description: "Payment for Scholarly Help",
            logo: "https://scholarlyhelp.com/storage/uploads/scholarlyhelp-logo-web-White.svg",
         },
         onclose: function(incomplete) {
            if (incomplete === true) {
               // Record event in analytics
               model.close();
            }
         }
      });
   }
   // $(function() {
   //    $('#paymentForm').on('submit', function(e) {
   //       e.preventDefault();
   //       let data = $(this).serialize();
   //       $.post("{{ route('flutter.pay') }}", data,
   //          function(data, status) {
   //             console.log(data);
   //          });
   //    });
   // });
   $('.confirm-button').on('click', function() {
      gtag_report_conversion();
   });

   function gtag_report_conversion(url) {
      var callback = function() {
         if (typeof(url) != 'undefined') {
            window.location = url;
         }
      };
      // gtag('event', 'conversion', {
      //    'send_to': 'AW-344015901/7AeSCPSrj68DEJ2IhaQB',
      //    'event_callback': callback
      // });
      AeSCPSrj68DEJ2IhaQB
      gtag('event', 'conversion', {
         'send_to': 'AW-344015901/UpmsCLzU1bUDEJ2IhaQB',
         'event_callback': callback
      });
      return false;
   }

   document.addEventListener("DOMContentLoaded", function(event) {

      var publishableKey = document.getElementById('publishable_key').dataset.publishablekey;
      var process_url = document.getElementById('process_url').dataset.processurl;

      document.getElementById('payment-form').style.display = "block";
      document.getElementById('loading').style.display = "none";

      var stripe = Stripe(publishableKey);

      var elements = stripe.elements();

      // Set up Stripe.js and Elements to use in checkout form
      var style = {
         base: {
            color: "#32325d",
            fontFamily: '"Nunito", Helvetica, sans-serif',
            fontSmoothing: "antialiased",
            fontSize: "16px",
            "::placeholder": {
               color: "#aab7c4"
            }
         },
         invalid: {
            color: "#fa755a",
            iconColor: "#fa755a"
         },
      };

      var cardElement = elements.create('card', {
         hidePostalCode: true,
         style: style
      });
      cardElement.mount('#card-element');

      disableConfirmButton();

      displayError = document.getElementById('card-errors');

      // Handle real-time validation errors from the card Element.
      cardElement.on('change', function(event) {

         if (event.complete) {
            // enable payment button
            enableConfirmButton();
         } else if (event.error) {
            // show validation to customer
            displayError.textContent = event.error.message;
            disableConfirmButton();
         } else {
            displayError.textContent = '';
            enableConfirmButton();
         }

      });

      // Step: 1 Handle the Button Click
      var form = document.getElementById('payment-form');
      form.addEventListener('submit', function(event) {
         event.preventDefault();
         // Disable the confirm button    
         disableConfirmButton();

         stripe.createPaymentMethod({
            type: 'card',
            card: cardElement,
         }).then(stripePaymentMethodHandler);
      });

      // Step: 1 attempt to send paymentMethod.id to server
      function stripePaymentMethodHandler(result) {

         if (result.error) {
            if (result.error.hasOwnProperty('message')) {
               showError(result.error.message);
            } else {
               showError(result.error);
            }

            enableConfirmButton();
         } else {
            // Otherwise send paymentMethod.id to your server
            $("#loading").show();
            axios.post(process_url, {
                  payment_method_id: result.paymentMethod.id,
               })
               .then(function(response) {
                  $("#loading").hide();
                  handleServerResponse(response.data);
               })
               .catch(function(error) {
                  $("#loading").hide();
                  enableConfirmButton();
               });


         }
      }


      function handleServerResponse(response) {
         if (response.error) {
            // Show error from server on payment form
            showError(response.error);
            enableConfirmButton();

         } else if (response.requires_action) {
            // Use Stripe.js to handle required card action
            disableConfirmButton();
            stripe.handleCardAction(
               response.payment_intent_client_secret
            ).then(handleStripeJsResult);
         } else {
            // Show success message
            if (response.success) {
               window.location.href = response.redirect_url;
            }
         }
      }

      function handleStripeJsResult(result) {
         if (result.error) {
            // Show error in payment form
            showError(result.error.message);
            enableConfirmButton();
         } else {
            // The card action has been handled
            // The PaymentIntent can be confirmed again on the server
            disableConfirmButton();
            axios.post(process_url, {
                  payment_intent_id: result.paymentIntent.id
               })
               .then(function(response) {
                  handleServerResponse(response.data);
               })
               .catch(function(error) {
                  showError('Could not process your payment. Please try again.');
                  enableConfirmButton();
               });



         }
      }

      function disableConfirmButton() {
         document.getElementsByClassName('confirm-button')[0].disabled = true;
      }

      function enableConfirmButton() {
         document.getElementsByClassName('confirm-button')[0].disabled = false;
      }

      function showError(message) {
         const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
               confirmButton: 'btn btn-success',
               cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
         });

         swalWithBootstrapButtons.fire({
            text: message
         });
      }
   }); // End of script
   $('#promo-form').on('submit', function(e) {
      e.preventDefault();
      $("#promoBtn").attr("disabled", true);
      $("#promoAlert").addClass('d-none');
      $("#promoAlert").removeClass('alert-danger');
      $("#promoAlert").removeClass('alert-success');
      let data = $(this).serialize();
      $.ajax({
         url: "{{route('apply_promo_code_payment')}}",
         type: "POST",
         data: data,
         success: function(response) {
            $("#promoAlert").removeClass('d-none');
            if (!response.error) {
               $("input[name='total']").val(response.total)
               $("input[name='amount']").val(response.total)
               $("input[name='code']").val('')
               $('.showAmount').text(response.amount);
               $("#promoAlert").addClass('alert-success');
               $("#promoAlert").text(response.message);
               $("#promoBtn").attr("disabled", false);
            } else {
               $("#promoAlert").addClass('alert-danger');
               $("#promoAlert").text(response.message);
               $("#promoBtn").attr("disabled", false);
            }
         },
         error: function(err) {
            $("#promoBtn").attr("disabled", false);
            console.log(err)
         }
      });
   })
</script>
@endpush