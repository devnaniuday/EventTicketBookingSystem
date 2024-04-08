<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        {{-- <x-app.navbar /> --}}
        <section class="h-100 h-custom">
            <div class="container-fluid py-4 px-5">
                <div class="row">
                    <div class="col-12">
                        <h3>Events Created by {{ $username }}</h3>
                        {{-- <div class="card card-background card-background-after-none align-items-start mt-4 mb-5"
                            id="zoomin">
                            <div class="full-background"
                                style="background-image: radial-gradient( circle farthest-corner at 12.3% 19.3%,  rgba(85,88,218,1) 0%, rgba(95,209,249,1) 100.2% );">
                            </div>
                            <div class="card-body text-start p-4 w-100">
                                <h3 class="text-white mb-2">Book. Click. Enjoy 🔥</h3>
                                <p class="mb-4 font-weight-semibold">
                                    Create your own Evnets
                                </p>
                                <a href="{{ route('OrganizerOrderDetails') }}" style="text-decoration: none;">
                                    <button type="button"
                                        class="btn btn-outline-white btn-blur btn-icon d-flex align-items-center mb-0 p-2">
                                        <span class="btn-inner--icon me-2">
                                            <i class="fa-solid fa-chart-line"></i>
                                        </span>
                                        <span class="btn-inner--text">Event Statistics </span>
                                    </button>
                                </a>
                                <img src="{{ asset('eventmanage.png') }}" alt="Event"
                                    class="position-absolute top-0 end-1 w-30 mb-0 max-width-250 mt-0 d-sm-block d-none" />
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="row justify-content-center mb-2">
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
                <div class="row">
                    <div class="col-12">
                        <div class="card border shadow-xs mb-4">
                            <div class="card-header bg-gray-200 border-bottom pb-0">
                                <div class="d-sm-flex align-items-center">
                                    <div>
                                        <h6 class="font-weight-semibold text-lg mb-0">Event list of user</h6>
                                        <p class="text-sm">See information about all Events created by
                                            {{ $username }}</p>
                                    </div>

                                </div>
                            </div>
                            <div class="card-body px-0 py-0">

                                <div class="table p-0">
                                    @if ($events->isEmpty())
                                        <p class="text-center p-5">No Events Available</p>
                                    @else
                                        <table class="table align-items-center mb-0 w-100">
                                            <thead class="bg-gray-100">
                                                <tr>
                                                    <th class="align-middle ps-5 ">Name</th>
                                                    <th class="align-middle text-center ">Vanue</th>
                                                    <th class="align-middle text-center ">Time</th>
                                                    <th class="align-middle text-center ">Date</th>
                                                    <th class="align-middle text-center ">Price</th>
                                                    <th class="align-middle text-center">Created at</th>
                                                    <th class="align-middle text-center ">Action</th>






                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($events as $event)
                                                    <tr class="justify-content-center" id="zoomin">
                                                        <td class="align-middle p-3">
                                                            <p class="text-sm text-dark ms-3 mb-0">{{ $event->name }}
                                                            </p>
                                                        </td>
                                                        <td class="align-middle text-center p-3">
                                                            <p class="text-sm text-dark max-width-100  mb-0"
                                                                style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">
                                                                {{ $event->venue }}
                                                            </p>
                                                        </td>
                                                        <td class="align-middle text-center p-3 ">
                                                            <p class="text-sm text-dark  mb-0">{{ $event->time }}
                                                            </p>
                                                        </td>
                                                        <td class="align-middle text-center p-3 ">
                                                            <p class="text-sm text-dark  mb-0">{{ $event->date }}

                                                            </p>
                                                        </td>
                                                        <td class="align-middle text-center p-3 ">
                                                            <p class="text-sm text-dark  mb-0">₹{{ $event->price }}
                                                            </p>
                                                        </td>
                                                        <td class="align-middle text-center p-3 ">
                                                            <p class="text-sm text-dark  mb-0">{{ $event->created_at }}
                                                            </p>
                                                        </td>
                                                        <td class="align-middle text-center p-3 ">
                                                            <p class="text-sm text-dark  mb-0">
                                                                <a href="/purchasedBy/{{ $event->id }}"
                                                                    class="text-secondary font-weight-bold  me-2">
                                                                    <i class="fa-solid fa-eye"></i>
                                                                </a>
                                                            </p>

                                                        </td>


                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    @endif
                                </div>

                                <div class="d-flex ms-3">
                                    {{ $events->links('pagination::bootstrap-5') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <x-app.footer />
    </main>

</x-app-layout>
