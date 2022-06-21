<!doctype html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta http-equiv="X-UA-Compatible" content="IE=edge" />
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <title>@yield('title') - {{ get_company_name() }}</title>
   <link rel="icon" type="image/x-icon" href="{{asset('img/favicon-32x32.png')}}">
   <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
   <link href="{{ asset('css/app.min.css') }}" rel="stylesheet">
   <link href="{{ asset('css/newmenu.css') }}" rel="stylesheet">
   <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
   <link href="{{ asset('css/home.css') }}" rel="stylesheet">
   <!-- <link href="{{ asset('css/style.css') }}" rel="stylesheet"> -->
   <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
   <script src="https://kit.fontawesome.com/c3bd82c876.js" crossorigin="anonymous"></script>

   @stack('stylesheets')
</head>

<body class="body d-flex flex-column h-100" style="background-color: #f4f7f6;">
   <!-- Google Tag Manager (noscript) -->
   <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5ZHV46X" height="0" width="0"
         style="display:none;visibility:hidden"></iframe></noscript>
   <!-- End Google Tag Manager (noscript) -->

   <div id="app" class="flex-grow-1">
      <!-- @include('layouts.menu') -->
      <div id="wrapper">
         <div>
            @php
            $logo = homepage('company_logo')
            @endphp
            <nav class="navbar navbar-fixed-top">
               <div class="container-fluid">
                  <div class="navbar-btn"><button class="btn-toggle-offcanvas"><i
                           class="lnr lnr-menu fa fa-bars"></i></button></div>
                  <div class="navbar-brand">
                     <a href="{{ url('/') }}"><img src="{{asset('storage/uploads/scholarlyhelp-logo-web-black.svg')}}"
                           alt="{{ settings('company_name') }}" class="img-responsive logo"></a>
                  </div>
                  <div class="navbar-right">
                     <div id="navbar-menu">
                        <ul class="nav navbar-nav">
                           @unlessrole('admin')
                           <notify :get_messages_url="'{{ route('user_unread_messages') }}'"
                              :inbox="'{{ route('user_inbox') }}'" :sound="'{{asset('music/sound.mp3')}}'"
                              :logout_url="'{{ route('logout') }}'" :login_url="'{{ route('login') }}'" />
                           @endunlessrole

                           <li><a href="#" class="icon-menu" onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();"><i
                                    class="icon-login fa fa-sign-in"></i></a>
                           </li>
                           <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              @csrf
                           </form>
                        </ul>
                     </div>
                  </div>
               </div>
            </nav>
            <div id="left-sidebar" class="sidebar" style="z-index: 9;">
               <div class="sidebar-scroll">
                  <div class="user-account"><img src="{{ asset('storage/'.auth()->user()->photo) }}"
                        class="rounded-circle user-photo" alt="User Profile Picture">
                     <div class="dropdown"><span>Welcome,</span><a class="user-name dropdown-toggle"
                           aria-haspopup="true" aria-expanded="false" variant="none" id="dropdown-basic"><strong>{{
                              Auth::user()->first_name }}</strong></a>
                        <div id="userDropdown" class="user-dropdown d-none">
                           <ul>
                              <li><a href="{{ route('my_account') }}"><i class="icon-folder far fa-user"></i>My
                                    Account</a></li>
                              @hasanyrole('staff|admin')
                              <li><a href="{{ route('my_account',['group' => 'wallet']) }}"><i
                                       class="icon-folder fas fa-wallet"></i>My Wallet</a></li>
                              <li><a href="{{ route('my_orders') }}"><i class="icon-folder far fa-user"></i>My
                                    Orders</a></li>
                              <!-- <li><a href="{{ route('order_page') }}"><i class="icon-folder far fa-plus-square"></i>New
                                    Order</a></li> -->
                              @endhasanyrole
                              <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();"><i
                                       class="icon-folder fas fa-sign-out-alt"></i>Logout</a></li>
                              <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                 style="display: none;">
                                 @csrf
                              </form>
                           </ul>
                        </div>
                     </div>
                     <hr>
                  </div>
                  <div class="tab-content p-l-0 p-r-0">
                     <div class="tab-pane active show" id="menu">
                        <div class="sidebar-nav nav" id="left-sidebar-nav">
                           <ul id="main-menu" class="metismenu">
                              @role('admin')
                              <li class="" id="dashboard"><a href="{{ route('dashboard') }}"><i
                                       class="icon-home fa fa-home"></i>
                                    <span>Dashboard</span></a>
                              </li>
                              <li id="orders"><a href="{{ route('orders_list') }}"><i
                                       class="icon-home fa fa order-0"></i>
                                    <span>Orders</span></a>
                              </li>

                              <li id="users" class=""><a href="#" class="has-arrow"><i
                                       class="icon-globe fas fa-users"></i>
                                    <span>Users</span></a>
                                 <ul id="usersMenu" class="collapse">
                                    <li id="customers" class=""><a
                                          href="{{ route('users_list', ['type' => 'customer']) }}"><i
                                             class="icon-folder far fa-user"></i>
                                          <span>Customers</span></a>
                                    </li>
                                    <li id="writers" class=""><a
                                          href="{{ route('users_list', ['type' => 'staff']) }}"><i
                                             class="icon-globe fas fa-users"></i>
                                          <span>Writers</span></a>
                                    </li>
                                    <li id="writers" class=""><a href="{{route('user_calculates')}}"><i
                                             class="fas fa-user-friends"></i>
                                          <span>Calculates</span></a>
                                    </li>
                                 </ul>
                              </li>
                              <li id="paymers" class=""><a href="#" class="has-arrow"><i
                                       class="icon-diamond far fa-money-bill-alt"></i>
                                    <span>Payments</span></a>
                                 <ul id="paymersMenu" class="collapse">
                                    <li class=""><a href="{{ route('pending_payment_approvals') }}"> Pending
                                          Approval</a></li>
                                    <li class=""><a href="{{ route('payments_list') }}">Payments List</a></li>
                                    <li class=""><a href="{{ route('wallet_transactions') }}"> Wallet Transactions</a>
                                    </li>
                                 </ul>
                              </li>
                              <li id="manage" class=""><a href="#!" class="has-arrow"><i
                                       class="icon-puzzle fas fa-tasks "></i> <span>Manage</span></a>
                                 <ul id="manageMenu" class="collapse">
                                    <li class=""><a href="#">Bills from Writers </a></li>
                                    <li class=""><a href="{{ route('services_list') }}"> Settings</a></li>
                                    <li class=""><a href="#"> Admin
                                          Users</a></li>
                                    <li class=""><a href="{{ route('job_applicants') }}">Job Applicants</a></li>

                                 </ul>
                              </li>
                              <li id="reports" class=""><a href="#!" class="has-arrow"><i
                                       class="icon-lock far fa-flag"></i> <span>Reports</span></a>
                                 <ul id="reportsMenu" class="collapse">
                                    <li class=""><a href="{{ route('income_statement') }}">Income Statement</a></li>
                                    <li class=""><a href="{{ route('total_wallet_balance') }}">Total Wallet Balance</a>
                                    </li>

                                 </ul>
                              </li>
                              <li class=""><a href="{{ route('admin_messages_list') }}"><i
                                       class="icon-home icon-envelope far fa fa-envelope-o"></i>
                                    <span>Messages</span></a>
                              </li>
                              @endrole
                              @role('staff')
                              @if(strtolower(settings('enable_browsing_work')) == 'yes')
                              <li class=""><a href="{{ route('browse_work') }}"><i class="icon-home fa fa-home"></i>
                                    <span>Browse Work</span></a>
                              </li>
                              @endif
                              <li class=""><a href="{{ route('tasks_list') }}"><i class="icon-home fa fa-home"></i>
                                    <span>My Tasks</span></a>
                              </li>
                              <li id="manage" class=""><a href="#!" class="has-arrow"><i
                                       class="icon-lock far fa-flag"></i> <span>Request for payment</span></a>
                                 <ul id="manageMenu" class="collapse">
                                    <li class=""><a href="{{ route('request_for_payment') }}">Income Statement</a></li>
                                    <li class=""><a href="{{ route('my_requests_for_payment') }}">Total Wallet
                                          Balance</a></li>
                                 </ul>
                              </li>
                              <li class=""><a class="d-flex justify-content-between" href="{{ route('user_inbox') }}">
                                    <div>
                                       <i class="icon-home icon-envelope far fa fa-envelope-o"></i>
                                       <span>Messages </span>
                                    </div>
                                    <span id="messages" class="unread">0</span>
                                 </a>
                              </li>
                              @endrole
                              @auth
                              @unlessrole('staff|admin')
                              <li class=""><a href="{{ route('my_orders') }}"><i class="icon-home fa fa-home"></i>
                                    <span>My Orders</span></a>
                              </li>
                              <li class=""><a href="{{ route('order_page') }}"><i
                                       class="icon-home far fa-plus-square"></i>
                                    <span>New Order</span></a>
                              </li>
                              <li class=""><a href="{{ route('my_account',['group' => 'wallet']) }}"><i
                                       class="icon-home fas fa-wallet"></i>
                                    <span>My Wallet</span></a>
                              </li>
                              <li class=""><a class="d-flex justify-content-between" href="{{ route('user_inbox') }}">
                                    <div>
                                       <i class="icon-home icon-envelope far fa fa-envelope-o"></i>
                                       <span>Messages </span>
                                    </div>
                                    <span id="messages" class="unread">0</span>
                                 </a>
                              </li>
                              @endunlessrole
                              @endauth
                           </ul>
                        </div>
                     </div>
                  </div>
                  <!-- </div> -->
               </div>
            </div>

         </div>
      </div>
      <main class="main-content">@yield('content')</main>
   </div>
   @include('layouts.footer')

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script type="text/javascript">
      window.currencyConfig = {!! currencyConfig()!!};
   </script>
   <!-- <script src="{{ asset('js/app.js') }}"></script> -->
   <script src="{{ mix('/js/app.js') }}"></script>
   <script src="{{ asset('js/menu.js') }}"></script>
   @if($notification = growl_notification())
   <script type="text/javascript">
      $(function () {     
     <? php echo $notification; ?>     
   });
   </script>
   @endif
   @stack('scripts')
   <script>
      setInterval(function () {
         // $('.circle').text(total)
         $.ajax({
            type: 'GET',
            url: "{{ route('user_unread_messages') }}",
            success: function (res) {
               $('#messages').html(res.message)
            }
         });
      }, 5000);
   </script>
</body>

</html>