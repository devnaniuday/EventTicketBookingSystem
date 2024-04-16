<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        {{-- <x-app.navbar /> --}}
        <section class="h-100 h-custom ">
            <div class="container-fluid py-4 px-5">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-background card-background-after-none align-items-start mt-4 mb-4"
                            id="zoomin">
                            <div class="full-background"
                                style="background-image: radial-gradient( circle farthest-corner at 12.3% 19.3%,  rgba(85,88,218,1) 0%, rgba(95,209,249,1) 100.2% );">
                            </div>
                            <div class="card-body text-start p-4 w-100">
                                <h3 class="text-white mb-2">Book. Click. Enjoy 🔥</h3>
                                <p class="mb-4 font-weight-semibold">
                                    Check all the Events and choose the best.
                                </p>

                                <a href="{{ route('userPurchaseOrder') }}">
                                    <button type="button"
                                        class="btn btn-outline-white btn-blur btn-icon d-flex align-items-center mb-0 p-2">
                                        <span class="btn-inner--icon me-2">
                                            <i class="fa-solid fa-store"></i>
                                        </span>
                                        <span class="btn-inner--text">Your Order</span>
                                    </button>
                                </a>
                                <img src="{{ asset('event.png') }}" alt="Event" id="Dashboardheaderimg"
                                    class="position-absolute top-0 end-1 w-28 mb-0 max-width-250  d-sm-block d-none" />

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-lg-9 col-12">
                        @if (session('error'))
                            <div class="alert alert-danger" role="alert" id="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success" role="alert" id="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                </div>
                <link rel="stylesheet" href="{{ asset('assets/css/Ticketinfo.css') }}">
                <div class="row">
                    <div class="col-md-2 mb-3 d-flex align-items-start">
                        <select class="form-select" id="sort-by-select" aria-label="Default select example">
                            <option>Sort By</option>
                            <option value="date_asc">Time New to Old</option>
                            <option value="date_desc">Time Old to New</option>
                            <option value="price_asc">Price Low to High</option>
                            <option value="price_desc">Price High to Low</option>
                        </select>
                    </div>
                    <div class="col-md-10">
                        <div class="input-group">
                            <input type="text" class="form-control" id="search-input" placeholder="Search Ticket" />
                            <button class="btn btn-primary" id="search-button" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <section class="">
                    <div class="container py-2">
                        @foreach ($tickets as $ticket)
                            <article class="postcard TicketCard blue" id="TicketCard">
                                <a class="postcard__img_link" href="#">
                                    @if ($ticket->image)
                                        <img class="postcard__img" src="{{ asset('storage/' . $ticket->image) }}"
                                            alt="Image Title" />
                                    @else
                                        <div class="postcard__img"> No Image Available</div>
                                    @endif

                                </a>
                                <div class="postcard__text t-dark"style="font-family: Arial, sans-serif;">
                                    <h1 class="postcard__title blue"><a href="#"> {{ $ticket->name }}</a></h1>
                                    <div class="postcard__subtitle small">
                                        <time datetime="2020-05-25 12:00:00">
                                            <i class="fas fa-calendar-alt me-2"></i>
                                            {{ date('d-m-Y', strtotime($ticket->date)) }}
                                        </time>
                                    </div>
                                    <div class="postcard__bar"></div>
                                    <div class="postcard__preview-txt">{{ $ticket->about }}
                                        <h6 class="mt-3" style="font-family: Arial, sans-serif;">Venue :
                                            {{ $ticket->venue }}</h6>
                                        <h6 class="mt-3" style="font-family: Georgia">Price :
                                            ₹{{ number_format($ticket->price, 2) }}</h6>
                                        <h6 class="">Time : {{ date('h:i A', strtotime($ticket->time)) }}</h6>
                                        <p style="font-family: Arial, sans-serif; font-size:15px">Tickets left :
                                            <span style="color: red;">{{$ticket->quantity }}</span></p>
                                    </div>


                                    <ul class="postcard__tagbox">

                                        <li class="tag__item play blue">
                                            <a href="" onclick="addtoCart('{{ $ticket->id }}')"><i
                                                    class="fa-solid fa-sm fa-cart-shopping me-2"></i>Add To
                                                Cart</a>
                                        </li>
                                    </ul>
                                </div>
                            </article>
                        @endforeach
                        <div class="d-flex">
                            {{ $tickets->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </section>
            </div>  
        </section>
        <x-app.footer />
    </main>
    <script>
        const sortBySelect = document.getElementById('sort-by-select');

        sortBySelect.addEventListener('change', function() {
            const selectedSortOption = sortBySelect.value;
            const url = new URL(window.location.href);
            url.searchParams.set('sort_by', selectedSortOption);
            window.location.href = url.toString();
        });
    </script>
    <script>
    const searchInput = document.getElementById('search-input');
    let timer;

    searchInput.addEventListener('keyup', function(event) {
        clearTimeout(timer); // Clear the previous timer
        timer = setTimeout(function() {
            const searchTerm = searchInput.value.trim();
            const url = new URL(window.location.href);
            url.searchParams.set('search', searchTerm);
            window.location.href = url.toString();
        }, 750); // Wait for 2 seconds before updating the URL
    });
</script>


</x-app-layout>
