<section id="guarantees" class="guarantees section-bg">
    <div class="container">

        <div class="section-title">
            <h2>{!! homepage('service_title')
                !!}</h2>
            <p></p>
        </div>

        <div class="row">
            @foreach($data['services'] as $item)
            @if($loop->iteration < 5) <div class="col-md-6 mt-4 d-flex flex-wrap">
                <div class="icon-box">
                    <i class="{{$item->icon}}"></i>
                    <h4><a href="{{route($item->url)}}">{{$item->title}}</a></h4>
                    <p>{{$item->content}}</p>
                </div>
        </div>
        @elseif($loop->iteration ==5)
        <div class="col-md-12 mt-4">
            <div class="icon-box">
                <i class="{{$item->icon}}"></i>
                <h4><a href="{{route($item->url)}}">{{$item->title}}</a></h4>
                <p>{{$item->content}}</p>
            </div>
        </div>
        @endif


        @endforeach
    </div>

    </div>
</section>