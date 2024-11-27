 <!-- Navbar -->
 <header class="navbar navbar-expand-md d-print-none">
     <div class="container-xl">
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
             aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
         </button>
         <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
             <a href="{{ route('home') }}">
                 <img src="{{ asset('logo/core.png') }}" width="110" height="32" alt="Tabler"
                     class="navbar-brand-image">
             </a>
         </h1>
         <div class="navbar-nav flex-row order-md-last">
             @php
                 $user = App\Models\AccountModel::where('acc_id', session('acc_id'))->first();
             @endphp
             <div class="nav-item dropdown">
                 <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                     aria-label="Open user menu">
                     <span class="avatar avatar-sm"
                         style="background-image: url({{ $user->acc_pic === 'default_pic.jpg' ? asset('acc_profile_picture/default_pic.jpg') : asset('acc_profile_picture/updated/' . $user->acc_pic) }});"></span>
                     <div class="d-none d-xl-block ps-2">
                         <div>{{ $user->acc_username }}</div>
                         <div class="mt-1 small text-secondary">{{ $user->acc_type }}</div>
                     </div>
                 </a>
                 <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                     <a href="{{ route('Setting') }}" class="dropdown-item">Settings</a>
                     <a href="{{ route('template') }}" class="dropdown-item">Template</a>

                     <form action="{{ route('Logout') }}" method="POST">
                         @csrf
                         <button type="submit" class="dropdown-item dropdown-item-action">Logout</button>
                     </form>
                 </div>
             </div>
         </div>
     </div>
 </header>
 <header class="navbar-expand-md">
     <div class="collapse navbar-collapse" id="navbar-menu">
         <div class="navbar">
             <div class="container-xl">
                 <ul class="navbar-nav">
                     <li class="nav-item {{ $active == 'mailhome' ? 'active' : '' }}">
                         <a class="nav-link" href="{{ route('home') }}">
                             <span class="nav-link-icon d-md-none d-lg-inline-block">
                                 <!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                     viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round"
                                     class="icon icon-tabler icons-tabler-outline icon-tabler-chart-bar">
                                     <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                     <path
                                         d="M3 13a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                     <path
                                         d="M15 9a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                     <path
                                         d="M9 5a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                     <path d="M4 20h14" />
                                 </svg> </span>
                             <span class="nav-link-title">
                                 Dashboard
                             </span>
                         </a>
                     </li>
                     {{-- <li class="nav-item {{ $active == 'mailingpage' ? 'active' : '' }}">
                         <a class="nav-link" href="{{ route('singlemail') }}">
                             <span class="nav-link-icon d-md-none d-lg-inline-block">
                                 <!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                     viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round"
                                     class="icon icon-tabler icons-tabler-outline icon-tabler-mail">
                                     <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                     <path
                                         d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" />
                                     <path d="M3 7l9 6l9 -6" />
                                 </svg>
                             </span>
                             <span class="nav-link-title">
                                 Single Mail
                             </span>
                         </a>
                     </li>
                     <li class="nav-item {{ $active == 'singlebrochure' ? 'active' : '' }}">
                         <a class="nav-link" href="{{ route('singlemailbrochure') }}">
                             <span class="nav-link-icon d-md-none d-lg-inline-block">
                                 <!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                     viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round"
                                     class="icon icon-tabler icons-tabler-outline icon-tabler-mail">
                                     <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                     <path
                                         d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" />
                                     <path d="M3 7l9 6l9 -6" />
                                 </svg>
                             </span>
                             <span class="nav-link-title">
                                 Single Mail Brochure
                             </span>
                         </a>
                     </li> --}}
                     <li class="nav-item {{ $active == 'leads' ? 'active' : '' }}">
                         <a class="nav-link" href="{{ route('leadsrecord') }}">
                             <span class="nav-link-icon d-md-none d-lg-inline-block">
                                 <!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                     viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round"
                                     class="icon icon-tabler icons-tabler-outline icon-tabler-list-details">
                                     <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                     <path d="M13 5h8" />
                                     <path d="M13 9h5" />
                                     <path d="M13 15h8" />
                                     <path d="M13 19h5" />
                                     <path
                                         d="M3 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                     <path
                                         d="M3 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                 </svg>
                             </span>
                             <span class="nav-link-title">
                                 Leads & Campaigns
                             </span>
                         </a>
                     </li>

                     <li
                         class="nav-item dropdown {{ request()->routeIs('singlemail') || request()->routeIs('singlemailbrochure') ? 'active' : '' }}">
                         <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                             data-bs-auto-close="outside" role="button" aria-expanded="false">
                             <span class="nav-link-icon d-md-none d-lg-inline-block">
                                 <!-- SVG icon -->
                                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                     viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round"
                                     class="icon icon-tabler icons-tabler-outline icon-tabler-mailbox">
                                     <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                     <path d="M10 21v-6.5a3.5 3.5 0 0 0 -7 0v6.5h18v-6a4 4 0 0 0 -4 -4h-10.5" />
                                     <path d="M12 11v-8h4l2 2l-2 2h-4" />
                                     <path d="M6 15h1" />
                                 </svg>
                             </span>
                             <span class="nav-link-title ms-1 me-2">
                                 Single Mail
                             </span>
                         </a>
                         <div class="dropdown-menu">
                             <div class="dropdown-menu-columns">
                                 <div class="dropdown-menu-column">
                                     <div class="dropdown">
                                         <a class="dropdown-item {{ request()->routeIs('singlemail') ? 'active' : '' }}"
                                             href="{{ route('singlemail') }}" role="button" aria-expanded="false">
                                             <span class="nav-link-icon d-md-none d-lg-inline-block">
                                                 <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                     height="24" viewBox="0 0 24 24" fill="none"
                                                     stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                     stroke-linejoin="round"
                                                     class="icon icon-tabler icons-tabler-outline icon-tabler-mail-forward">
                                                     <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                     <path
                                                         d="M12 18h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v7.5" />
                                                     <path d="M3 6l9 6l9 -6" />
                                                     <path d="M15 18h6" />
                                                     <path d="M18 15l3 3l-3 3" />
                                                 </svg>
                                             </span>
                                             Send Single Email
                                         </a>
                                         <a class="dropdown-item {{ request()->routeIs('singlemailbrochure') ? 'active' : '' }}"
                                             href="{{ route('singlemailbrochure') }}" role="button"
                                             aria-expanded="false">
                                             <span class="nav-link-icon d-md-none d-lg-inline-block">
                                                 <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                     height="24" viewBox="0 0 24 24" fill="none"
                                                     stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                     stroke-linejoin="round"
                                                     class="icon icon-tabler icons-tabler-outline icon-tabler-mail-code">
                                                     <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                     <path
                                                         d="M11 19h-6a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v6" />
                                                     <path d="M3 7l9 6l9 -6" />
                                                     <path d="M20 21l2 -2l-2 -2" />
                                                     <path d="M17 17l-2 2l2 2" />
                                                 </svg>
                                             </span>
                                             Send Single Brochure
                                         </a>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </li>

                     <li
                         class="nav-item dropdown {{ request()->routeIs('massmailingword') || request()->routeIs('massmailigbrochure') ? 'active' : '' }}">
                         <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                             data-bs-auto-close="outside" role="button" aria-expanded="false">
                             <span class="nav-link-icon d-md-none d-lg-inline-block">
                                 <!-- SVG icon -->
                                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                     viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round"
                                     class="icon icon-tabler icons-tabler-outline icon-tabler-messages">
                                     <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                     <path d="M21 14l-3 -3h-7a1 1 0 0 1 -1 -1v-6a1 1 0 0 1 1 -1h9a1 1 0 0 1 1 1v10" />
                                     <path d="M14 15v2a1 1 0 0 1 -1 1h-7l-3 3v-10a1 1 0 0 1 1 -1h2" />
                                 </svg>
                             </span>
                             <span class="nav-link-title ms-1 me-2">
                                 Mass Mailing
                             </span>
                         </a>
                         <div class="dropdown-menu">
                             <div class="dropdown-menu-columns">
                                 <div class="dropdown-menu-column">
                                     <div class="dropdown">
                                         <a class="dropdown-item {{ request()->routeIs('massmailingword') ? 'active' : '' }}"
                                             href="{{ route('massmailingword') }}" role="button"
                                             aria-expanded="false">
                                             <span class="nav-link-icon d-md-none d-lg-inline-block">
                                                 <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                     height="24" viewBox="0 0 24 24" fill="none"
                                                     stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                     stroke-linejoin="round"
                                                     class="icon icon-tabler icons-tabler-outline icon-tabler-mail-bolt">
                                                     <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                     <path
                                                         d="M13 19h-8a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v5.5" />
                                                     <path d="M3 7l9 6l9 -6" />
                                                     <path d="M19 16l-2 3h4l-2 3" />
                                                 </svg>
                                             </span>
                                             Send Mass Email Campaign
                                         </a>
                                         <a class="dropdown-item {{ request()->routeIs('massmailigbrochure') ? 'active' : '' }}"
                                             href="{{ route('massmailigbrochure') }}" role="button"
                                             aria-expanded="false">
                                             <span class="nav-link-icon d-md-none d-lg-inline-block">
                                                 <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                     height="24" viewBox="0 0 24 24" fill="none"
                                                     stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                     stroke-linejoin="round"
                                                     class="icon icon-tabler icons-tabler-outline icon-tabler-mail-star">
                                                     <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                     <path
                                                         d="M10 19h-5a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v4.5" />
                                                     <path d="M3 7l9 6l9 -6" />
                                                     <path
                                                         d="M17.8 20.817l-2.172 1.138a.392 .392 0 0 1 -.568 -.41l.415 -2.411l-1.757 -1.707a.389 .389 0 0 1 .217 -.665l2.428 -.352l1.086 -2.193a.392 .392 0 0 1 .702 0l1.086 2.193l2.428 .352a.39 .39 0 0 1 .217 .665l-1.757 1.707l.414 2.41a.39 .39 0 0 1 -.567 .411l-2.172 -1.138z" />
                                                 </svg>
                                             </span>
                                             Send Brochure Email Campaign
                                         </a>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </li>

                     {{-- <li class="nav-item {{ $active == 'massword' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('massmailingword') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-mail">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" />
                                    <path d="M3 7l9 6l9 -6" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Mass Mailing Word
                            </span>
                        </a>
                    </li>
                    <li class="nav-item {{ $active == 'massbrochure' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('massmailigbrochure') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-mail">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" />
                                    <path d="M3 7l9 6l9 -6" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Mass Mailing Brochure
                            </span>
                        </a>
                    </li> --}}

                 </ul>
             </div>
         </div>
     </div>
 </header>
