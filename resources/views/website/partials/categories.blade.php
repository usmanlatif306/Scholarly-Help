<section id="counts" class="counts">
    <div class="container">
        <div class="section-title">
            <h2>{!! homepage('counter_title')
                !!}</h2>
            <p></p>
        </div>
        <div class="row">

            <div class="col-lg-4 col-6">
                <div class="count-box">
                    <i class="bi bi-emoji-smile"></i>
                    <p>{!! homepage('counter1_text')
                        !!}</p>
                    <span data-purecounter-start="0" data-purecounter-end="{!! homepage('counter1_value')
                    !!}" data-purecounter-duration="1" class="purecounter"></span>

                </div>
            </div>

            <div class="col-lg-4 col-6">
                <div class="count-box">
                    <i class="bi bi-journal-richtext"></i>
                    <p>{!! homepage('counter2_text')
                        !!}</p>
                    <span data-purecounter-start="0" data-purecounter-end="{!! homepage('counter2_value')
                    !!}" data-purecounter-duration="1" class="purecounter"></span>

                </div>
            </div>

            <div class="col-lg-4 col-6 mt-5 mt-lg-0">
                <div class="count-box">
                    <i class="bi bi-headset"></i>
                    <p>{!! homepage('counter3_text')
                        !!}</p>
                    <span data-purecounter-start="0" data-purecounter-end="{!! homepage('counter3_value')
                    !!}" data-purecounter-duration="1" class="purecounter"></span>

                </div>
            </div>
        </div>
    </div>
</section>