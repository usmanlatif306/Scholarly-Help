<!doctype html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta http-equiv="X-UA-Compatible" content="IE=edge" />
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <title>@yield('title') - {{ get_company_name() }}</title>
   <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
   <link href="{{ asset('css/app.min.css') }}" rel="stylesheet">
   <link href="{{ asset('css/newmenu.css') }}" rel="stylesheet">
   <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
   <script src="https://kit.fontawesome.com/c3bd82c876.js" crossorigin="anonymous"></script>
   @stack('stylesheets')
</head>

<body class="body d-flex flex-column h-100" style="background-color: #f4f7f6;">
   <div id="app" class="flex-grow-1">
      <!-- @include('layouts.menu') -->
      <div id="wrapper">
         <div>
            <nav class="navbar navbar-fixed-top">
               <div class="container-fluid">
                  <div class="navbar-btn"><button class="btn-toggle-offcanvas"><i
                           class="lnr lnr-menu fa fa-bars"></i></button></div>
                  <div class="navbar-brand"><a href="{{ url('/') }}"><img src="{{ asset('img/12.png') }}"
                           alt="{{ config('app.name', 'Eduintello') }}" class="img-responsive logo"></a>
                  </div>
                  <div class="navbar-right">

                     <div id="navbar-menu">
                        <ul class="nav navbar-nav">
                           <li><a href="#" class="icon-menu d-none d-sm-block d-md-none d-lg-block"><i
                                    class="fa fa-folder-open-o"></i></a></li>
                           <li><a href="#" class="icon-menu d-none d-sm-block d-md-none d-lg-block"><i
                                    class="icon-calendar far fa-calendar-alt"></i></a></li>
                           <li><a href="#" class="icon-menu d-none d-sm-block"><i
                                    class="icon-bubbles fa fa-comments-o"></i></a>
                           </li>
                           <li><a href="#" class="icon-menu d-none d-sm-block"><i
                                    class="icon-envelope far fa fa-envelope-o"></i><span
                                    class="notification-dot"></span></a>
                           </li>
                           <li class="dropdown"><a href="#!" class="dropdown-toggle icon-menu" data-toggle="dropdown"><i
                                    class="icon-bell far fa fa-bell-o"></i><span class="notification-dot"></span></a>
                              <ul class="dropdown-menu notifications">
                                 <li class="header"><strong>You have 4 new Notifications</strong></li>
                                 <li><a>
                                       <div class="media">
                                          <div class="media-left"><i class="icon-info text-warning"></i>
                                          </div>
                                          <div class="media-body">
                                             <p class="text">Campaign <strong>Holiday Sale</strong> is
                                                nearly reach budget limit.</p><span class="timestamp">10:00 AM
                                                Today</span>
                                          </div>
                                       </div>
                                    </a></li>
                                 <li><a>
                                       <div class="media">
                                          <div class="media-left"><i class="icon-like text-success"></i>
                                          </div>
                                          <div class="media-body">
                                             <p class="text">Your New Campaign <strong>Holiday
                                                   Sale</strong> is approved.</p><span class="timestamp">11:30 AM
                                                Today</span>
                                          </div>
                                       </div>
                                    </a></li>
                                 <li><a>
                                       <div class="media">
                                          <div class="media-left"><i class="icon-pie-chart text-info"></i>
                                          </div>
                                          <div class="media-body">
                                             <p class="text">Website visits from Twitter is 27% higher
                                                than last week.</p><span class="timestamp">04:00 PM
                                                Today</span>
                                          </div>
                                       </div>
                                    </a></li>
                                 <li><a>
                                       <div class="media">
                                          <div class="media-left"><i class="icon-info text-danger"></i>
                                          </div>
                                          <div class="media-body">
                                             <p class="text">Error on website analytics configurations
                                             </p><span class="timestamp">Yesterday</span>
                                          </div>
                                       </div>
                                    </a></li>
                                 <li class="footer"><a class="more">See all notifications</a></li>
                              </ul>
                           </li>
                           <li class="dropdown"><a href="#!" class="dropdown-toggle icon-menu" data-toggle="dropdown"><i
                                    class="icon-equalizer  fa fa-bars"></i></a>
                              <ul class="dropdown-menu user-menu menu-icon">
                                 <li class="menu-heading">ACCOUNT SETTINGS</li>
                                 <li><a><i class="icon-note fa fa-clipboard"></i> <span>Basic</span></a></li>
                                 <li><a><i class="icon-equalizer  fa fa-bars"></i>
                                       <span>Preferences</span></a></li>
                                 <li><a><i class="icon-lock fa fa-lock"></i> <span>Privacy</span></a></li>
                                 <li><a><i class="icon-bell far fa fa-bell-o"></i>
                                       <span>Notifications</span></a></li>
                                 <li class="menu-heading">BILLING</li>
                                 <li><a><i class="icon-credit-card fa fa-credit-card"></i>
                                       <span>Payments</span></a></li>
                                 <li><a><i class="icon-printer fa fa-print"></i> <span>Invoices</span></a>
                                 </li>
                                 <li><a><i class="icon-refresh fa fa-refresh"></i> <span>Renewals</span></a>
                                 </li>
                              </ul>
                           </li>

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
                  <div class="user-account"><img
                        src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8dXNlciUyMHByb2ZpbGV8ZW58MHx8MHx8&ixlib=rb-1.2.1&w=1000&q=80"
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
                              <li><a href="{{ route('order_page') }}"><i class="icon-folder far fa-plus-square"></i>New
                                    Order</a></li>
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
                              <!-- <li id="customers" class=""><a href="{{ route('users_list', ['type' => 'customer']) }}"><i
                                       class="icon-folder far fa-user"></i>
                                    <span>Customers</span></a>
                              </li> -->
                              <!-- <li id="writers" class=""><a href="{{ route('users_list', ['type' => 'staff']) }}"><i
                                       class="icon-globe fas fa-users"></i>
                                    <span>Writers</span></a>
                              </li> -->
                              <!-- <li id="paymers" class=""><a href="#" class="has-arrow"><i
                                       class="icon-diamond far fa-money-bill-alt"></i>
                                    <span>Payments</span></a>
                                 <ul id="paymersMenu" class="collapse">
                                    <li class=""><a href="{{ route('pending_payment_approvals') }}"> Pending
                                          Approval</a></li>
                                    <li class=""><a href="{{ route('payments_list') }}">Payments List</a></li>
                                    <li class=""><a href="{{ route('wallet_transactions') }}"> Wallet Transactions</a>
                                    </li>
                                 </ul>
                              </li> -->
                              <li id="manage" class=""><a href="#!" class="has-arrow"><i
                                       class="icon-puzzle fas fa-tasks "></i> <span>Manage</span></a>
                                 <ul id="manageMenu" class="collapse">
                                    <li class=""><a href="{{ route('bills_list') }}">Bills from Writers </a></li>
                                    <li class=""><a href="{{ route('settings_main_page') }}"> Settings</a></li>
                                    <li class=""><a href="{{ route('users_list', ['type' => 'admin']) }}"> Admin
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
                              <li id="requestForReport" class=""><a href="#!" class="has-arrow"><i
                                       class="icon-lock far fa-flag"></i> <span>Request for payment</span></a>
                                 <ul id="requestForReport" class="collapse">
                                    <li class=""><a href="#">Income Statement</a></li>
                                    <li class=""><a href="#">Total Wallet Balance</a></li>

                                 </ul>
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
</body>

</html>