<!-- footer -->
<footer class="footer slider_background">
   <div class="footer_top">
      <div class="container">
         <div class="row">
            <div class="col-xl-4 col-md-6 col-lg-4">
               <div class="footer_widget">
                  <div class="footer_logo">
                     @php
                     $logo = homepage('company_logo')
                     @endphp
                     <a href="{{ route('homepage') }}">
                        <img src="{{asset('storage/uploads/scholarlyhelp-logo-web-White.svg')}}"
                           alt="{{ settings('company_name')  }}" width="170" height="40">
                     </a>
                  </div>
                  <p>{!! nl2br(Purifier::clean(settings('company_about'))) !!}</p>
                  <div class="socail_links">
                     <ul>
                        @if($link = settings('facebook'))
                        <li>
                           <a href="{{ $link }}" target="_blank">
                              <i class="bi bi-facebook"></i>
                           </a>
                        </li>
                        @endif
                        @if($link = settings('twitter'))
                        <li>
                           <a href="{{ $link }}" target="_blank">
                              <i class="bi bi-twitter"></i>
                           </a>
                        </li>
                        @endif
                        @if($link = settings('instagram'))
                        <li>
                           <a href="{{ $link }}" target="_blank">
                              <i class="bi bi-instagram"></i>
                           </a>
                        </li>
                        @endif
                        @if($link = settings('linkedin'))
                        <li>
                           <a href="{{ $link }}" target="_blank">
                              <i class="bi bi-linkedin"></i>
                           </a>
                        </li>
                        @endif
                     </ul>
                  </div>
               </div>
            </div>
            <div class="col-xl-2 offset-xl-1 col-md-6 col-lg-3">
               <div class="footer_widget">
                  <h3 class="footer_title">
                     Main Menu
                  </h3>
                  <ul class="pl-0">
                     <li><a href="{{route('online_class_page')}}">Take My Online Class</a></li>
                     <li><a href="{{route('exam_page')}}">Do My Exam</a></li>
                     <li><a href="{{route('homework_page')}}">Homemork Help</a></li>
                     <li><a href="{{route('assignment_page')}}">
                           Assignmnet Help</a></li>
                     <li><a href="{{route('essay_writing_page')}}">Write My Essay</a></li>
                     <li><a href="{{route('blogs')}}">Blog</a></li>
                     <li><a href="{{route('tools')}}">Tools</a></li>
                     <!-- @if(!settings('disable_writer_application'))
                     <li><a href="{{ route('writer_application_page') }}">{{
                           settings('writer_application_page_link_title') }}</a></li>
                     @endif -->
                  </ul>
               </div>
            </div>
            <div class="col-xl-3 col-md-6 col-lg-2">
               <div class="footer_widget">
                  <h3 class="footer_title">
                     Legal Info
                  </h3>
                  <ul class="pl-0">
                     <li><a href="{{ route('about_page') }}">About Us</a></li>
                     <li><a href="{{ route('contact_page') }}">Contact Us</a></li>
                     <li><a href="{{ route('privacy_policy') }}">Privacy Policy</a></li>

                  </ul>
               </div>
            </div>
            <div class="col-xl-2 col-md-6 col-lg-3">
               <div class="footer_widget">
                  <h3 class="footer_title">
                     We accept
                  </h3>
                  <img src="{{asset('storage/uploads/card.png')}}" alt="Payment Methods" width="100%" height="100%">
                  <!-- <p class="font-24">
                     <i class="fab fa-cc-visa"></i>
                     <i class="fab fa-cc-mastercard"></i>
                     <i class="fab fa-cc-discover"></i>
                     @if(settings('enable_paypal'))
                     <i class="fab fa-cc-paypal"></i>
                     @endif
                  </p> -->
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="copy-right_text">
      <div class="container">
         <div class="footer_border"></div>
         <div class="row">
            <div class="col-xl-12">
               <p class="copy_right text-center">
                  {{ date("Y") }} {!! Purifier::clean(settings('footer_text')) !!}
               </p>
            </div>
         </div>
      </div>
   </div>
</footer>
<!-- footer -->