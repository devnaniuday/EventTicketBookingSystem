<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <section class="h-100 h-custom">
            <div class="container-fluid py-4 px-5">
                <div class="row">
                    <div class="col-12">
                        <h3>Users who Purchased Tickets for {{ $event->name }}</h3>
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
                                        <h6 class="font-weight-semibold text-lg mb-0">List of Purchasers</h6>
                                        <p class="text-sm">See information about users who purchased tickets for this
                                            event.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body px-0 py-0">
                                <div class="table p-0">
                                    @if ($purchases->isEmpty())
                                        <p class="text-center p-5">No Purchases Available</p>
                                    @else
                                        <table class="table align-items-center mb-0 w-100">
                                            <thead class="bg-gray-100">
                                                <tr>
                                                    <th class="align-middle ps-5 ">User Name</th>
                                                    <th class="align-middle text-center ">Email</th>
                                                    <th class="align-middle text-center ">Purchase Date</th>
                                                    <th class="align-middle text-center ">Quantity</th>
                                                    <th class="align-middle text-center ">Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($purchases as $purchase)
                                                    <tr class="justify-content-center" id="zoomin">
                                                        <td class="align-middle p-3">
                                                            <p class="text-sm text-dark ms-3 mb-0">
                                                                {{ $purchase->user->name }}</p>
                                                        </td>
                                                        <td class="align-middle text-center p-3">
                                                            <p class="text-sm text-dark mb-0">
                                                                {{ $purchase->user->email }}</p>
                                                        </td>
                                                        <td class="align-middle text-center p-3">
                                                            <p class="text-sm text-dark mb-0">
                                                                {{ $purchase->created_at }}</p>
                                                        </td>
                                                        <td class="align-middle text-center p-3">
                                                            <p class="text-sm text-dark mb-0">{{ $purchase->quantity }}
                                                            </p>
                                                        </td>
                                                        <td class="align-middle text-center p-3">
                                                            <p class="text-sm text-dark mb-0">{{ $purchase->price }}</p>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif
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
