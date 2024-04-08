<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 bg-slate-900 fixed-start" id="sidenav-main">
    <div class="sidenav-header">
        <a class="navbar-brand d-flex align-items-center h-auto w-auto m-0 justify-content-center" target="_blank">
            <img src="{{ asset('Logowhite.png') }}" alt="Your Logo" width="100%" height="100%" />
        </a>
    </div>
    <div class="collapse navbar-collapse px-4 w-auto mt-5 h-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item ps-2 d-flex flex-column align-items-center mb-3">
                <a href="{{ route('user.profile') }}" class="nav-link text-body p-0">
                    @if (auth()->user()->pfp)
                        <img src="{{ url('storage/' . auth()->user()->pfp) }}" alt="Profile Photo"
                            class="w-50 h-50 mx-auto mb-2 object-fit-cover border-radius-2xl shadow-sm" id="preview">
                    @else
                        <img src="{{ asset('profileimg.png') }}" alt="Default Profile Photo"
                            class="w-50 h-50 mx-auto mb-2 object-fit-cover border-radius-2xl shadow-sm" id="preview">
                    @endif
                </a>
                <span class="nav-link-text ms-1 text-white">{{ auth()->user()->name }}</span>
                <span class="nav-link-text ms-1 text-white">{{ auth()->user()->email }}</span>
            </li>



            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-list"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('event') }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-ticket"></i>
                    </div>
                    <span class="nav-link-text ms-1">My Event</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('cart') }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                    <span class="nav-link-text ms-1">Cart</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.profile') }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <i class="fa-regular fa-user"></i>
                    </div>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>
            @php
                $currentUserId = auth()->id();
            @endphp

            @if ($currentUserId == 0)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('users-management') }}">
                        <div
                            class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-list-check"></i>
                        </div>
                        <span class="nav-link-text ms-1">Manage User</span>
                    </a>
                </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </div>
                    <span class="nav-link-text ms-1">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
