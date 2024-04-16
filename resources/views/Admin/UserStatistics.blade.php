<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        {{-- <x-app.navbar /> --}}
        <div class="container-fluid py-4 px-5">
            
            <!-- User Details Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div id="zoomin"
                            class="bg-gray-500 text-dark border-radius-2xl d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-user fa-beat-fade fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Paid Users</p>
                                <h6 class="mb-0">{{ $totalPaidUsers }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div id="zoomin"
                            class="bg-gray-500 text-dark border-radius-2xl d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-user fa-beat-fade fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Unverified Users</p>
                                <h6 class="mb-0">{{ $unverifiedUsers->count() }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div id="zoomin"
                            class="bg-gray-500 text-dark border-radius-2xl d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-user fa-beat-fade fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Users</p>
                                <h6 class="mb-0">{{ $totalPaidUsers+$unverifiedUsers->count() }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- User Details End -->

            <!-- Paid Users Table Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-gray-200 text-center border-radius-lg p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Paid Users</h6>
                    </div>
                    <div class="card-body px-0 py-0">

                        <div class="table p-0">

                            <table class="table align-items-center mb-0 w-100">
                                <thead class="bg-gray-200">
                                    <tr>
                                        <th class="align-middle text-center max-width-100">Sr. No.</th>
                                        <th class="align-middle text-left max-width-100">User Name</th>
                                        <th class="align-middle text-center ">Email</th>
                                        <th class="align-middle text-left ">Created At</th>
                                        <th class="align-middle text-center ">Verified</th>
                                        <th class="align-middle text-center ">Id</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($paidUsers as $index => $user)
                                        <tr class="justify-content-center" id="zoomin">
                                            <td class="text-center max-width-100">{{ $index + 1 }}</td>
                                            <td class="text-left">
                                                <p class="text-sm text-dark ms-3 mb-0 max-width-100">{{ $user->name }}</p>
                                            </td>
                                            <td class="align-middle text-centercenter p-3">
                                                <p class="text-sm text-dark max-width-100  mb-0">{{ $user->email }}</p>
                                            </td>
                                            <td class="align-middle text-center p-3">
                                                <p class="text-sm text-dark max-width-100  mb-0">{{ $user->created_at }}</p>
                                            </td>
                                            <td class="align-middle text-center p-3 ">
                                                <p class="text-sm text-dark  mb-0">{{ $user->email_verified_at ? 'Yes' : 'No' }}</p>
                                            </td>
                                            <td class="align-middle text-center p-3 ">
                                                
                                                <p class="text-sm text-dark mb-0">{{ $user->id }}</p>
                                            </td>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Paid Users Table End -->

            <!-- Unverified Users Table Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-gray-200 text-center border-radius-lg p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Unverified Users</h6>
                    </div>
                    <div class="card-body px-0 py-0">

                        <div class="table p-0">

                            <table class="table align-items-center mb-0 w-100">
                                <thead class="bg-gray-200">
                                    <tr>
                                        <th class="align-center text-center">Sr. No.</th>
                                        <th class="align-center text-center">User Name</th>
                                        <th class="align-middle text-center ">Email</th>
                                        <th class="align-middle text-left ">Created At</th>
                                        <th class="align-middle text-center ">Verified</th>
                                        <th class="align-middle text-center ">Id</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($unverifiedUsers as $index => $user)
                                        <tr class="justify-content-center" id="zoomin">
                                            <td class="align-middle text-center">{{ $index + 1 }}</td>
                                            <td class="align-middle">
                                                <p class="text-sm text-dark ms-3 mb-0 text-center">{{ $user->name }}</p>
                                            </td>
                                            <td class="align-middle text-center p-3">
                                                <p class="text-sm text-dark max-width-100  mb-0">{{ $user->email }}</p>
                                            </td>
                                            <td class="align-middle text-center p-3">
                                                <p class="text-sm text-dark max-width-100  mb-0">{{ $user->created_at }}</p>
                                            </td>
                                            <td class="align-middle text-center p-3 ">
                                                <p class="text-sm text-dark  mb-0">{{ $user->email_verified_at ? 'Yes' : 'No' }}</p>
                                            </td>
                                            <td class="align-middle text-center p-3 ">
                                                <p class="text-sm text-dark mb-0">{{ $user->id }}</p>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                                
                            </table>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="d-flex m-3">
                {{ $paidUsers->links('pagination::bootstrap-5') }}
            </div>
            <!-- Unverified Users Table End -->


            <x-app.footer />
        </div>
    </main>

</x-app-layout>
