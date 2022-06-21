<div class="card order-box shadow bg-white rounded">
   <div class="row">
      <div class="col-md-6">
         <a href="{{ route('orders_show', $order->id) }}">
            <h5>{{ $order->number }}</h5>
         </a>

      </div>
      <div class="col-md-6  text-right">
         <div><span class="badge {{ $order->status->badge }}">{{ $order->status->name }}</span></div>
      </div>
   </div>
   <div class="row mt-4">
      <div class="col-md-8">
         Client :
         @if(auth()->user()->hasRole('admin'))
         <a href="{{ route('user_profile', $order->customer_id) }}">
            {{ $order->customer->full_name }}
         </a>
         @else
         {{ $order->customer->full_name }}
         @endif
      </div>
      <div class="col-md-4 text-right">
         Budget {{ format_money($order->staff_payment_amount) }}
      </div>
   </div>
   <p class="order-instruction">
      <?php echo Str::words($order->instruction, 20, ' ...'); ?>
   </p>
   <div class="row order-overview">
      <div class="col-md-6"><span class="font-weight-bold">Service Type</span>
         <br>
         {{ $order->service->name }}
      </div>
      <div class="col-md-6"><span class="font-weight-bold">Sub Category</span>
         <br>
         {{ $order->sub_category }}
      </div>
   </div>
   <div class="row order-overview">
      <div class="col-md-6"><span class="font-weight-bold">Subject</span>
         <br>
         {{ $order->subject }}
      </div>
      <div class="col-md-6"><span class="font-weight-bold">Assigned To</span>
         <br>
         <?php 
            if(isset($order->assignee))
            {
                  echo '<a href="'.route('user_profile', $order->staff_id).'">'.$order->assignee->full_name.'</a>';                   
            }
            ?>
      </div>
   </div>
   <div class="row order-overview">
      <div class="col-md-6"><span class="font-weight-bold">Posted</span>
         <br>
         {{ $order->created_at->format('d-M-Y')}}
      </div>
      <div class="col-md-6"><span class="font-weight-bold">Deadline</span>
         <br>
         {{ $order->dead_line->format('d-M-Y')}}
      </div>
   </div>
</div>