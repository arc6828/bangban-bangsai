<header class="header-global">
    <style>
        .navbar-brand img {
            height: 40px ;
            width: 200px; 
            object-fit: cover;
        }
    </style>
    <nav id="navbar-main" class=" navbar navbar-main navbar-expand-lg navbar-transparent {{ $mode }} navbar-theme-primary headroom py-lg-2 px-lg-6 ">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img class="navbar-brand-dark" src="{{ asset('img/LOGO_KU_Flood_hollow-04.png') }}" alt="Logo light" />
                <img class="navbar-brand-light" src="{{ asset('img/LOGO_KU_Flood-01.png') }}" alt="Logo dark"  />
                {{-- <img class="navbar-brand-dark" src="{{ asset('img/logo/LOGO-Eng-White.png') }}" alt="Logo light" height="150" />
                <img class="navbar-brand-light" src="{{ asset('img/logo/LOGO-Eng.png') }}" alt="Logo dark" height="150" /> --}}
                <!-- <img class="navbar-brand-dark" src="{{ asset('leaf/assets/img/brand/light.svg') }}" alt="Logo light" />
                <img class="navbar-brand-light" src="{{ asset('leaf/assets/img/brand/primary.svg') }}" alt="Logo dark" /> -->
            </a>
            <div class="navbar-collapse collapse" id="navbar_global">
                <div class="navbar-collapse-header">
                    <div class="row">
                        <div class="col-6 collapse-brand">
                            <a href="{{ url('/') }}">
                                <img src="{{ asset('img/LOGO_KU_Flood-01.png') }}" alt="menu image"  />
                                {{-- <img src="{{ asset('leaf/assets/img/brand/primary.svg') }}" alt="menuimage" /> --}}
                            </a>
                        </div>
                        <div class="col-6 collapse-close">
                            <a href="#navbar_global" role="button"  data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
                                <i class="fas fa-times"></i>          
                            </a>
                        </div>
                    </div>
                </div>
                <ul class="navbar-nav navbar-nav-hover m-auto">
                    <li class="nav-item">
                        <a href="{{ url('/') }}" class="nav-link">
                            <span class="nav-link-inner-text">หน้าหลัก</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/about') }}" class="nav-link">
                            <span class="nav-link-inner-text">เกี่ยวกับเรา</span>
                        </a>
                    </li>
                    <!-- <li class="nav-item">
                        <a href="{{ url('/predict') }}" class="nav-link">
                            <span class="nav-link-inner-text">แจ้งเตือน</span>
                        </a>
                    </li> -->
                    <li class="nav-item">
                        <a href="{{ url('/statistic') }}" class="nav-link">
                            <span class="nav-link-inner-text">ตัวเลขและสถิติ</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/blog') }}" class="nav-link">
                            <span class="nav-link-inner-text">บทความ</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/gallery') }}" class="nav-link">
                            <span class="nav-link-inner-text">คลังภาพ</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/contact') }}" class="nav-link">
                            <span class="nav-link-inner-text">ติดต่อเรา</span>
                        </a>
                    </li>
                    <!-- <li class="nav-item dropdown">
                        <a href="#" class="nav-link" data-toggle="dropdown" role="button">
                            <span class="nav-link-inner-text mr-1">Pages</span>
                            <i class="fas fa-angle-down nav-link-arrow"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="nav-item">
                                <a href="{{ asset('leaf/html/pages/about.html') }}" class="dropdown-item">About</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ asset('leaf/html/pages/our-mission.html') }}" class="dropdown-item">Our Mission</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ asset('leaf/html/pages/donate.html') }}" class="dropdown-item">Donate</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ asset('leaf/html/pages/updates.html') }}" class="dropdown-item">Updates</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ asset('leaf/html/pages/update.html') }}" class="dropdown-item">Update Single</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ asset('leaf/html/pages/contact.html') }}" class="dropdown-item">Contact</a>
                            </li>
                            <li class="dropdown-submenu">
                                <a href="#" class="
                                                dropdown-toggle dropdown-item
                                                d-flex
                                                justify-content-between
                                                align-items-center
                                            " aria-haspopup="true" aria-expanded="false">Authentication<i class="
                                                    fas
                                                    fa-angle-right
                                                    nav-link-arrow
                                                "></i></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ asset('leaf/html/pages/sign-in.html') }}" class="dropdown-item">Sign In</a>
                                    </li>
                                    <li>
                                        <a href="{{ asset('leaf/html/pages/sign-up.html') }}" class="dropdown-item">Sign Up</a>
                                    </li>
                                    <li>
                                        <a href="{{ asset('leaf/html/pages/forgot-password.html') }}" class="dropdown-item">Forgot password</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <a href="#" class="
                                                dropdown-toggle dropdown-item
                                                d-flex
                                                justify-content-between
                                                align-items-center
                                            " aria-haspopup="true" aria-expanded="false">Special<i class="
                                                    fas
                                                    fa-angle-right
                                                    nav-link-arrow
                                                "></i></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ asset('leaf/html/pages/coming-soon.html') }}" class="dropdown-item">Coming Soon</a>
                                    </li>
                                    <li>
                                        <a href="{{ asset('leaf/html/pages/404.html') }}" class="dropdown-item">404 Not Found</a>
                                    </li>
                                    <li>
                                        <a href="{{ asset('leaf/html/pages/500.html') }}" class="dropdown-item">500 Server Error</a>
                                    </li>
                                    <li>
                                        <a href="{{ asset('leaf/html/pages/terms.html') }}" class="dropdown-item">Terms of Service</a>
                                    </li>
                                    <li>
                                        <a href="{{ asset('leaf/html/pages/blank.html') }}" class="dropdown-item">Blank page</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link" data-toggle="dropdown" role="button">
                            <span class="nav-link-inner-text mr-1">Support</span>
                            <i class="fas fa-angle-down nav-link-arrow"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg">
                            <div class="col-auto px-0" data-dropdown-content>
                                <div class="list-group list-group-flush">
                                    <a href="{{ asset('leaf/docs/introduction.html') }}" class="
                                                    list-group-item
                                                    list-group-item-action
                                                    d-flex
                                                    align-items-center
                                                    p-0
                                                    py-3
                                                    px-lg-4
                                                ">
                                        <span class="
                                                        icon
                                                        icon-sm
                                                        icon-secondary
                                                    "><i class="fas fa-file-alt"></i></span>
                                        <div class="ml-4">
                                            <span class="
                                                            text-dark
                                                            d-block
                                                        ">Documentation<span class="
                                                                badge
                                                                badge-sm
                                                                badge-secondary
                                                                ml-2
                                                            ">v1.2</span></span>
                                            <span class="small">Examples and
                                                guides</span>
                                        </div>
                                    </a>
                                    <a href="https://themesberg.com/contact" target="_blank" class="
                                                    list-group-item
                                                    list-group-item-action
                                                    d-flex
                                                    align-items-center
                                                    p-0
                                                    py-3
                                                    px-lg-4
                                                ">
                                        <span class="
                                                        icon
                                                        icon-sm
                                                        icon-primary
                                                    "><i class="
                                                            fas
                                                            fa-microphone-alt
                                                        "></i></span>
                                        <div class="ml-4">
                                            <span class="
                                                            text-dark
                                                            d-block
                                                        ">Support</span>
                                            <span class="small">Looking for answers?
                                                Ask us!</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li> -->
                </ul>
            </div>
            <div class="d-lg-block">
                {{-- <a href="{{ asset('leaf/html/pages/donate.html') }}" role="button" class="btn btn-sm btn-warning animate-up-2">
                <i class="fas fa-donate mr-2"></i>Contribute
                </a>
                <a href="{{ asset('leaf/html/pages/sign-in.html') }}" role="button" class="btn btn-sm btn-secondary animate-up-2 ml-3">
                    <i class="fas fa-sign-in-alt mr-2"></i>Sign In
                </a> --}}
            </div>
            <div class="d-flex d-lg-none align-items-center">
                {{-- <a href="{{ asset('leaf/html/pages/donate.html') }}" role="button" class="btn btn-sm btn-warning animate-up-2">
                <i class="fas fa-donate mr-1"></i>Donate
                </a>
                <a href="{{ asset('leaf/html/pages/sign-in.html') }}" role="button" class="btn btn-sm btn-secondary animate-up-2 ml-2">
                    <i class="fas fa-sign-in-alt mr-1"></i>Sign In
                </a> --}}
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </div>
    </nav>
</header>