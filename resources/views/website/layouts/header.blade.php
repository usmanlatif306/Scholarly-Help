<header>
   <div class="header-area slider_background-1 fixed-top">
      <div id="sticky-header" class="main-header-area">
         <div class="container-fluid p-0">
            <nav class="navbar navbar-expand-lg">
               @php
               $logo = homepage('company_logo')
               @endphp
               <a class="navbar-brand ml-0 ml-md-5" href="{{ route('homepage') }}">
                  <!-- <img src="{{asset('storage/'.$logo)}}" alt="{{ settings('company_name') }}" width="170" height="40"> -->
                  <img src="{{asset('storage/uploads/scholarlyhelp-logo-web-White.svg')}}"
                     alt="{{ settings('company_name') }}" width="170" height="40">
               </a>
               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                  aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"><i class="bi bi-list pt-1 text-black"
                        style="font-size: 25px;"></i></span>
               </button>

               <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav ml-auto">
                     <li class="nav-item">
                        <a class="nav-link text-white" href="{{route('online_class_page')}}">Online Class</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link text-white" href="{{route('exam_page')}}">Exam</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link text-white" href="{{route('homework_page')}}">Homework</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link text-white" href="{{route('assignment_page')}}">Assignment</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link text-white" href="{{route('essay_writing_page')}}">Essay Writing</a>
                     </li>

                     @auth
                     <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route(get_default_route_by_user(auth()->user())) }}">My
                           Account</a>
                     </li>
                     @endauth
                     @guest
                     <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('login') }}">Login</a>
                     </li>
                     @endguest
                  </ul>
               </div>
            </nav>
         </div>
      </div>
   </div>
</header>