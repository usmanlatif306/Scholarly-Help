<div class="comment-box">
   @if($order->order_status_id != ORDER_STATUS_COMPLETE)
   <div class="row p-3">
      <div class="offset-md-3 col-md-6">
         <form action="{{ route('post_comment') }}" method="POST" autocomplete="off" enctype='multipart/form-data'>
            {{ csrf_field() }}
            <label>Your Message</label>
            <input type="hidden" name="order_id" value="{{ $order->id }}">
            <textarea class="form-control {{ showErrorClass($errors, 'message') }}" name="message"></textarea>
            <div class="invalid-feedback d-block">{{ showError($errors, 'message') }}</div>
            <br>
            <label>Attachment</label>
            <input type="file" class="form-control" name="file">
            <br>
            <input class="btn btn-success" type="submit" name="submit" value="Submit">
         </form>
      </div>
   </div>
   @endif
   @if(count($comments = $order->comments()->orderBy('id', 'DESC')->paginate()) > 0)
   <div id="comments" data-id="{{$order->id}}">
      @include('order.partials.comment_thread',['comments'=> $comments,'total'=>count($comments)])

   </div>
   @endif
</div>

@push('scripts')
<script>
   setInterval(function () {
      let total = $('#commentTotal').data("total");
      $('.circle').text(total)
      $.ajax({
         type: 'GET',
         url: "{{ route('order_messages',$order->id) }}",
         success: function (res) {
            $('#comments').html(res);
         }
      });
   }, 5000);
</script>
@endpush