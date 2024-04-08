<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        {{-- <x-app.navbar /> --}}
        <section class="h-100 h-custom">
            <div class="container-fluid py-4 px-5">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-background card-background-after-none align-items-start mt-4 mb-5"
                            id="zoomin">
                            <div class="full-background"
                                style="background-image: radial-gradient( circle farthest-corner at 12.3% 19.3%,  rgba(85,88,218,1) 0%, rgba(95,209,249,1) 100.2% );">
                            </div>
                            <div class="card-body text-start p-4 w-100">
                                <h3 class="text-white mb-2">Book. Click. Enjoy 🔥</h3>
                                <p class="mb-4 font-weight-semibold">
                                    Check your Purchase Ticket
                                </p>
                                <img src="{{ asset('ticket-header.png') }}" alt="Event"
                                    class="position-absolute top-0 end-1 w-15 mb-0 max-width-250 mt-3 d-sm-block d-none" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card border shadow-xs mb-4">
                            <div class="card-header bg-gray-200 border-bottom pb-0">
                                <div class="d-sm-flex align-items-center">
                                    <div>
                                        <h6 class="font-weight-semibold text-lg mb-0">Purchase Tickets list</h6>
                                        <p class="text-sm">See information about all Purchased Tickets</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body px-0 py-0">
                                @if ($orders->isEmpty())
                                    <tr>
                                        <td colspan="8" class="text-center py-4">No orders available.
                                        </td>
                                    </tr>
                                @else
                                    <div class="table-responsive p-0">
                                        <table class="table align-items-center mb-0">
                                            <thead class="bg-gray-100">
                                                <tr>
                                                    <th class="align-middle text-center  ">Name</th>
                                                    <th class="align-middle text-center ">Vanue</th>
                                                    <th class="align-middle text-center ">Time</th>
                                                    <th class="align-middle text-center ">Date</th>
                                                    <th class="align-middle text-center ">Price</th>
                                                    <th class="align-middle text-center ">Quantity</th>
                                                    <th class="align-middle text-center ">Purchase Time</th>
                                                    <th class="align-middle text-center ">View</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($orders as $order)
                                                    <tr class="justify-content-center" id="zoomin">
                                                        <td class="align-middle text-center p-3">
                                                            <p class="text-sm text-dark font-weight-semibold mb-0">
                                                                {{ $order->event->name }}
                                                            </p>
                                                        </td>
                                                        <td class="align-middle text-center p-3">
                                                            <p class="text-sm text-dark font-weight-semibold mb-0">
                                                                {{ $order->event->venue }}
                                                            </p>
                                                        </td>
                                                        <td class="align-middle text-center p-3 ">
                                                            <p class="text-sm text-dark font-weight-semibold mb-0">
                                                                {{ date('h:i A', strtotime($order->event->time)) }}
                                                            </p>
                                                        </td>
                                                        <td class="align-middle text-center p-3 ">
                                                            <p class="text-sm text-dark font-weight-semibold mb-0">
                                                                {{ date('d-m-Y', strtotime($order->event->date)) }}
                                                            </p>
                                                        </td>
                                                        <td class="align-middle text-center p-3 ">
                                                            <p class="text-sm text-dark font-weight-semibold mb-0">
                                                                ₹{{ number_format($order->price, 2) }}
                                                            </p>
                                                        </td>
                                                        <td class="align-middle text-center p-3 ">
                                                            <p class="text-sm text-dark font-weight-semibold mb-0">
                                                                {{ $order->quantity }}
                                                            </p>
                                                        </td>
                                                        <td class="align-middle text-center p-3 ">
                                                            <p class="text-sm text-dark font-weight-semibold mb-0">
                                                                {{ date('d-m-Y h:i:s A', strtotime($order->created_at)) }}
                                                            </p>
                                                        </td>
                                                        <td class="align-middle text-center p-3 ">
                                                            <p class="text-sm text-dark font-weight-semibold mb-0">
                                                                <a href="/PurchasedTicket/{{ $order->id }}"
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
                            <div class="d-flex ms-3 mt-4">
                                {{ $orders->links('pagination::bootstrap-5') }}
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
