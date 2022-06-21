@extends('setup.index')
@section('title', 'Online Class')
@section('setting_page')
<form role="form" class="form-horizontal" action="{{ route('put_online_class_settings') }}" method="post"
    autocomplete="off">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    @include('setup.partials.action_toolbar', ['title' => 'Online Content'])
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Website Frontend</li>
            <li class="breadcrumb-item" aria-current="page">Online Class</li>
        </ol>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>{{ ucfirst(str_replace('_',' ', 'top_heading')) }}</label>
                    <input type="text" name="top_heading" class="form-control" value="{{$class->top_heading}}">
                </div>

                <div class="form-group">
                    <label>{{ ucfirst(str_replace('_',' ', 'top_content')) }}</label>
                    <textarea type="text" name="top_content" class="form-control">{{$class->top_content}}</textarea>
                </div>

                <div class="form-group">
                    <label>{{ ucfirst(str_replace('_',' ', 'section_1_heading')) }}</label>
                    <input type="text" name="section_1_heading" class="form-control"
                        value="{{$class->section_1_heading}}">
                </div>

                <div class="form-group">
                    <label>{{ ucfirst(str_replace('_',' ', 'section_1_point_1')) }}</label>
                    <textarea type="text" name="section_1_point_1"
                        class="form-control">{{$class->section_1_point_1}}</textarea>
                </div>
                <div class="form-group">
                    <label>{{ ucfirst(str_replace('_',' ', 'section_1_point_2')) }}</label>
                    <textarea type="text" name="section_1_point_2"
                        class="form-control">{{$class->section_1_point_2}}</textarea>
                </div>
                <div class="form-group">
                    <label>{{ ucfirst(str_replace('_',' ', 'section_1_point_3')) }}</label>
                    <textarea type="text" name="section_1_point_3"
                        class="form-control">{{$class->section_1_point_3}}</textarea>
                </div>
                <div class="form-group">
                    <label>{{ ucfirst(str_replace('_',' ', 'section_1_point_4')) }}</label>
                    <textarea type="text" name="section_1_point_4"
                        class="form-control">{{$class->section_1_point_4}}</textarea>
                </div>
                <div class="form-group">
                    <label>{{ ucfirst(str_replace('_',' ', 'section_1_point_5')) }}</label>
                    <textarea type="text" name="section_1_point_5"
                        class="form-control">{{$class->section_1_point_5}}</textarea>
                </div>
                <div class="form-group">
                    <label>{{ ucfirst(str_replace('_',' ', 'section_1_btn_text')) }}</label>
                    <input type="text" name="section_1_btn_text" class="form-control"
                        value="{{$class->section_1_btn_text}}">
                </div>
                <div class="form-group">
                    <label>{{ ucfirst(str_replace('_',' ', 'section_2_heading')) }}</label>
                    <input type="text" name="section_2_heading" class="form-control"
                        value="{{$class->section_2_heading}}">
                </div>
                <div class="form-group">
                    <label>{{ ucfirst(str_replace('_',' ', 'choose_1_heading')) }}</label>
                    <input type="text" name="choose_1_heading" class="form-control"
                        value="{{$class->choose_1_heading}}">
                </div>
                <div class="form-group">
                    <label>{{ ucfirst(str_replace('_',' ', 'choose_1_content')) }}</label>
                    <textarea type="text" name="choose_1_content"
                        class="form-control">{{$class->choose_1_content}}</textarea>
                </div>

                <div class="form-group">
                    <label>{{ ucfirst(str_replace('_',' ', 'choose_2_heading')) }}</label>
                    <input type="text" name="choose_2_heading" class="form-control"
                        value="{{$class->choose_2_heading}}">
                </div>

                <div class="form-group">
                    <label>{{ ucfirst(str_replace('_',' ', 'choose_2_content')) }}</label>
                    <textarea type="text" name="choose_2_content"
                        class="form-control">{{$class->choose_2_content}}</textarea>
                </div>
                <div class="form-group">
                    <label>{{ ucfirst(str_replace('_',' ', 'choose_3_heading')) }}</label>
                    <input type="text" name="choose_3_heading" class="form-control"
                        value="{{$class->choose_3_heading}}">
                </div>

                <div class="form-group">
                    <label>{{ ucfirst(str_replace('_',' ', 'choose_3_content')) }}</label>
                    <textarea type="text" name="choose_3_content"
                        class="form-control">{{$class->choose_3_content}}</textarea>
                </div>
                <div class="form-group">
                    <label>{{ ucfirst(str_replace('_',' ', 'choose_4_heading')) }}</label>
                    <input type="text" name="choose_4_heading" class="form-control"
                        value="{{$class->choose_4_heading}}">
                </div>

                <div class="form-group">
                    <label>{{ ucfirst(str_replace('_',' ', 'choose_4_content')) }}</label>
                    <textarea type="text" name="choose_4_content"
                        class="form-control">{{$class->choose_4_content}}</textarea>
                </div>
                <div class="form-group">
                    <label>{{ ucfirst(str_replace('_',' ', 'choose_5_heading')) }}</label>
                    <input type="text" name="choose_5_heading" class="form-control"
                        value="{{$class->choose_5_heading}}">
                </div>

                <div class="form-group">
                    <label>{{ ucfirst(str_replace('_',' ', 'choose_5_content')) }}</label>
                    <textarea type="text" name="choose_5_content"
                        class="form-control">{{$class->choose_5_content}}</textarea>
                </div>
                <div class="form-group">
                    <label>{{ ucfirst(str_replace('_',' ', 'choose_6_heading')) }}</label>
                    <input type="text" name="choose_6_heading" class="form-control"
                        value="{{$class->choose_6_heading}}">
                </div>

                <div class="form-group">
                    <label>{{ ucfirst(str_replace('_',' ', 'choose_6_content')) }}</label>
                    <textarea type="text" name="choose_6_content"
                        class="form-control">{{$class->choose_6_content}}</textarea>
                </div>
                <div class="form-group">
                    <label>{{ ucfirst(str_replace('_',' ', 'choose_7_heading')) }}</label>
                    <input type="text" name="choose_7_heading" class="form-control"
                        value="{{$class->choose_7_heading}}">
                </div>

                <div class="form-group">
                    <label>{{ ucfirst(str_replace('_',' ', 'choose_7_content')) }}</label>
                    <textarea type="text" name="choose_7_content"
                        class="form-control">{{$class->choose_7_content}}</textarea>
                </div>
                <div class="form-group">
                    <label>{{ ucfirst(str_replace('_',' ', 'choose_btn_text')) }}</label>
                    <input type="text" name="choose_btn_text" class="form-control" value="{{$class->choose_btn_text}}">
                </div>

                <div class="form-group">
                    <label>{{ ucfirst(str_replace('_',' ', 'work_heading')) }}</label>
                    <input type="text" name="work_heading" class="form-control" value="{{$class->work_heading}}">
                </div>
                <div class="form-group">
                    <label>{{ ucfirst(str_replace('_',' ', 'work_content')) }}</label>
                    <textarea type="text" name="work_content" class="form-control">{{$class->work_content}}</textarea>
                </div>

                <div class="form-group">
                    <label>{{ ucfirst(str_replace('_',' ', 'work_step1_heading')) }}</label>
                    <input type="text" name="work_step1_heading" class="form-control"
                        value="{{$class->work_step1_heading}}">
                </div>
                <div class="form-group">
                    <label>{{ ucfirst(str_replace('_',' ', 'work_step1_content')) }}</label>
                    <textarea type="text" name="work_step1_content"
                        class="form-control">{{$class->work_step1_content}}</textarea>
                </div>
                <div class="form-group">
                    <label>{{ ucfirst(str_replace('_',' ', 'work_step2_heading')) }}</label>
                    <input type="text" name="work_step2_heading" class="form-control"
                        value="{{$class->work_step2_heading}}">
                </div>
                <div class="form-group">
                    <label>{{ ucfirst(str_replace('_',' ', 'work_step2_content')) }}</label>
                    <textarea type="text" name="work_step2_content"
                        class="form-control">{{$class->work_step2_content}}</textarea>
                </div>
                <div class="form-group">
                    <label>{{ ucfirst(str_replace('_',' ', 'work_step3_heading')) }}</label>
                    <input type="text" name="work_step3_heading" class="form-control"
                        value="{{$class->work_step3_heading}}">
                </div>
                <div class="form-group">
                    <label>{{ ucfirst(str_replace('_',' ', 'work_step3_content')) }}</label>
                    <textarea type="text" name="work_step3_content"
                        class="form-control">{{$class->work_step3_content}}</textarea>
                </div>
                <div class="form-group">
                    <label>{{ ucfirst(str_replace('_',' ', 'work_btn_text')) }}</label>
                    <input type="text" name="work_btn_text" class="form-control" value="{{$class->work_btn_text}}">
                </div>

                <div class="form-group">
                    <label>{{ ucfirst(str_replace('_',' ', 'subject_expert_heading')) }}</label>
                    <input type="text" name="subject_expert_heading" class="form-control"
                        value="{{$class->subject_expert_heading}}">
                </div>
                <div class="form-group">
                    <label>{{ ucfirst(str_replace('_',' ', 'subject_expert_content')) }}</label>
                    <textarea type="text" id="subject_expert_content" name="subject_expert_content"
                        class="form-control">{{$class->subject_expert_content}}</textarea>
                </div>

                <div class="form-group">
                    <label>{{ ucfirst(str_replace('_',' ', 'service_heading')) }}</label>
                    <input type="text" name="service_heading" class="form-control" value="{{$class->service_heading}}">
                </div>
                <div class="form-group">
                    <label>{{ ucfirst(str_replace('_',' ', 'service_content')) }}</label>
                    <textarea type="text" name="service_content"
                        class="form-control">{{$class->service_content}}</textarea>
                </div>
                <div class="form-group">
                    <label>{{ ucfirst(str_replace('_',' ', 'service1_heading')) }}</label>
                    <input type="text" name="service1_heading" class="form-control"
                        value="{{$class->service1_heading}}">
                </div>
                <div class="form-group">
                    <label>{{ ucfirst(str_replace('_',' ', 'service1_content')) }}</label>
                    <textarea type="text" name="service1_content"
                        class="form-control">{{$class->service1_content}}</textarea>
                </div>
                <div class="form-group">
                    <label>{{ ucfirst(str_replace('_',' ', 'service2_heading')) }}</label>
                    <input type="text" name="service2_heading" class="form-control"
                        value="{{$class->service2_heading}}">
                </div>
                <div class="form-group">
                    <label>{{ ucfirst(str_replace('_',' ', 'service2_content')) }}</label>
                    <textarea type="text" name="service2_content"
                        class="form-control">{{$class->service2_content}}</textarea>
                </div>
                <div class="form-group">
                    <label>{{ ucfirst(str_replace('_',' ', 'service3_heading')) }}</label>
                    <input type="text" name="service3_heading" class="form-control"
                        value="{{$class->service3_heading}}">
                </div>
                <div class="form-group">
                    <label>{{ ucfirst(str_replace('_',' ', 'service3_content')) }}</label>
                    <textarea type="text" name="service3_content"
                        class="form-control">{{$class->service3_content}}</textarea>
                </div>
                <div class="form-group">
                    <label>{{ ucfirst(str_replace('_',' ', 'service4_heading')) }}</label>
                    <input type="text" name="service4_heading" class="form-control"
                        value="{{$class->service4_heading}}">
                </div>
                <div class="form-group">
                    <label>{{ ucfirst(str_replace('_',' ', 'service4_content')) }}</label>
                    <textarea type="text" name="service4_content"
                        class="form-control">{{$class->service4_content}}</textarea>
                </div>
                <div class="form-group">
                    <label>{{ ucfirst(str_replace('_',' ', 'service5_heading')) }}</label>
                    <input type="text" name="service5_heading" class="form-control"
                        value="{{$class->service5_heading}}">
                </div>
                <div class="form-group">
                    <label>{{ ucfirst(str_replace('_',' ', 'service5_content')) }}</label>
                    <textarea type="text" name="service5_content"
                        class="form-control">{{$class->service5_content}}</textarea>
                </div>
                <div class="form-group">
                    <label>{{ ucfirst(str_replace('_',' ', 'service_btn_text')) }}</label>
                    <input type="text" name="service_btn_text" class="form-control"
                        value="{{$class->service_btn_text}}">
                </div>
                <div class="form-group">
                    <label>{{ ucfirst(str_replace('_',' ', 'last_heading')) }}</label>
                    <textarea type="text" name="last_heading" class="form-control">{{$class->last_heading}}</textarea>
                </div>
                <div class="form-group">
                    <label>{{ ucfirst(str_replace('_',' ', 'last_btn_text')) }}</label>
                    <input type="text" name="last_btn_text" class="form-control" value="{{$class->last_btn_text}}">
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/31.1.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#subject_expert_content'),
            {
                alignment: {
                    options: ['left', 'right']
                },
            }
        );
</script>

@endpush