<?php

namespace App\Http\Controllers\Api;

use App\Attachment;
use App\Comment;
use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;
use App\NumberGenerator;
use Illuminate\Support\Facades\Http;
use Mews\Purifier\Facades\Purifier;
use App\Events\DeliveryAcceptedEvent;
use App\Events\RequestedForRevisionEvent;
use App\Mail\RequestReview;
use App\Rating;
use Illuminate\Support\Facades\Mail;
use App\Events\NewOrderEvent;
use App\OrderAdditionalService;

class CartController extends Controller
{

    public function storeOrder(Request $request)
    {
        $request['number'] = NumberGenerator::gen('App\Order');
        $request['service_type'] = 'double';
        $order = Order::create($request->all());

        // order extra services
        foreach ($request->added_services as $service) {
            $service = new OrderAdditionalService();
            $service->service_id = $service['service_id'];
            $service->type = $service['type'];
            $service->name = $service['name'];
            $service->rate = $service['rate'];
            $order->added_services()->save($service);
        }

        // order attachments
        foreach ($request->attachments as $item) {
            $attachment = new Attachment();
            $attachment->name = $item['name'];
            $attachment->display_name = $item['display_name'];
            $attachment->user_id = $request->customer_id;
            $order->attachments()->save($attachment);
        }

        //Dispatching Event
        event(new NewOrderEvent($order));

        return response()->json([
            'error' => false,
            'message' => 'order created'
        ]);
    }

    public function changeOrderStatus(Request $request)
    {
        $status = $request->status;

        // findind order and changing status
        $order = Order::where('api_order_id', $request->order_id)->first();

        $order->order_status_id = $status;
        $order->save();

        // dispatching events based on status

        // if status is ORDER_STATUS_COMPLETE
        if ($status === ORDER_STATUS_COMPLETE) {
            // Dispatching Event
            event(new DeliveryAcceptedEvent($order));
            Mail::to($order->customer->email)->send(new RequestReview($order));
        } elseif ($status === ORDER_STATUS_REQUESTED_FOR_REVISION) {
            // if status is ORDER_STATUS_REQUESTED_FOR_REVISION

            $submitted_work = $order->latest_submitted_work();
            if ($submitted_work->count() > 0) {
                $submitted_work->needs_revision = TRUE;
                $submitted_work->customer_message = Purifier::clean($request->message);
                $submitted_work->save();

                // Update Order Status
                $order->order_status_id = ORDER_STATUS_REQUESTED_FOR_REVISION;
                $order->save();

                // Dispatching Event
                event(new RequestedForRevisionEvent($order));
            }
        } else {
            return response()->json([
                'error' => false,
                'message' => 'No action'
            ]);
        }

        return response()->json([
            'error' => false,
            'message' => 'action is taken'
        ]);
    }

    // storing comments
    public function comments(Request $request)
    {
        // findind order
        $order = Order::where('api_order_id', $request->order_id)->first();

        $comment = new Comment();
        $comment->body = $request->body;
        $comment->attachment = $request->attachment;
        $comment->display_name = $request->display_name;
        $comment->type = $request->type;
        $comment->user_id = $request->user_id;
        $order->comments()->save($comment);

        return $comment;
    }

    // saving order rating
    public function orderRating(Request $request)
    {
        // findind order
        $order = Order::where('api_order_id', $request->order_id)->first();

        $request['order_id'] = $order->id;
        $request['user_id'] = $order->customer_id;

        // Log user's activity
        $subject = anchor($order->number, route('orders_show', $order->id));
        logActivity($order, 'submited review on ' . $subject);

        Rating::create($request->all());

        return response()->json([
            'error' => false,
            'message' => 'Thank you for your feedback!'
        ]);
    }
}
