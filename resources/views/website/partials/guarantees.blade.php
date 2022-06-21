<section id="guarantees" class="guarantees section-bg">
    <div class="container">

        <div class="section-title">
            <h2>{!! homepage('guarantee_title')
                !!}</h2>
            <p>{!! homepage('guarantee_content')
                !!}</p>
        </div>

        <div class="row">
            @foreach($data['guarantees'] as $item)
            <div class="col-md-6 mt-4 d-flex flex-wrap">
                <div class="icon-box ">
                    <i class="{{$item->icon}}"></i>
                    <h4><a href="#">{{$item->title}}</a></h4>
                    <p>{{$item->content}}</p>
                </div>
            </div>
            @endforeach

        </div>

    </div>
</section>