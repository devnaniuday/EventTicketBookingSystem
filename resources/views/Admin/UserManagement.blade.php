<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="px-5 py-4 container-fluid">
            <div class="mt-4 row">
                <div class="col-12">
                    {{-- <div class="alert alert-dark text-sm" role="alert">
                        <strong>Add, Edit, Delete features are not functional!</strong> This is a
                        <strong>PRO</strong> feature! Click <a href="#" target="_blank" class="text-bold">here</a>
                        to see the <strong>PRO</strong> product!
                    </div> --}}
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
                                    Create your own Evnets
                                </p>
                                <a href="{{ route('UserStatistics') }}" style="text-decoration: none;">
                                    <button type="button"
                                        class="btn btn-outline-white btn-blur btn-icon d-flex align-items-center mb-0 p-2">
                                        <span class="btn-inner--icon me-2">
                                            <i class="fa-solid fa-chart-line"></i>
                                        </span>
                                        <span class="btn-inner--text">User Statistics </span>
                                    </button>
                                </a>
                                <img src="{{ asset('eventmanage.png') }}" alt="Event"
                                    class="position-absolute top-0 end-1 w-30 mb-0 max-width-250 mt-0 d-sm-block d-none" />
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="card">
                        <div class="pb-0 card-header">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="">User Management</h5>
                                    <p class="mb-0 text-sm">
                                        Here you can manage your users.
                                    </p>
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
                                {{-- <div class="col-6 text-end">
                                    <a href="#" class="btn btn-dark btn-primary">
                                        <i class="fas fa-user-plus me-2"></i> Add Member
                                    </a>
                                </div> --}}
                            </div>
                        </div>



                        <div class="table-responsive">
                            <table class="table text-secondary text-center">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            ID</th>
                                        <th
                                            class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Photo</th>
                                        <th
                                            class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary ">
                                            Name</th>
                                        <th
                                            class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Email</th>
                                        <th
                                            class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Creation Date</th>
                                        <th
                                            class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td class="align-middle bg-transparent border-bottom">{{ $user->id }}
                                            </td>
                                            <td class="align-middle bg-transparent border-bottom">
                                                <div class="d-flex justify-content-center align-items-center">
                                                    @if ($user->pfp)
                                                        <img src="{{ url('storage/' . $user->pfp) }}"
                                                            class="rounded-circle mr-2" alt="Profile Photo"
                                                            style="height: 36px; width: 36px;">
                                                    @else
                                                        <img src="{{ asset('profileimg.png') }}"
                                                            class="rounded-circle mr-2" alt="Profile Photo"
                                                            style="height: 36px; width: 36px;">
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="align-middle bg-transparent border-bottom p-3">{{ $user->name }}
                                            </td>
                                            <td class="align-middle bg-transparent border-bottom">{{ $user->email }}
                                            </td>
                                            <td class="text-center align-middle bg-transparent border-bottom">
                                                {{ $user->created_at }}</td>
                                            <td class="text-center align-middle bg-transparent border-bottom">
                                                <a href="" onclick="deleteUser('{{ $user->id }}')"
                                                    class="delete-user-link" data-id="{{ $user->id }}">
                                                    <i class="fa-solid fa-trash-can text-dark"></i>
                                                </a>
                                                <a class="m-1" href="/viewEventsByUserId/{{ $user->id }}"
                                                    class="delete-user-link" data-id="{{ $user->id }}">
                                                    <i class="fa-solid fa-eye text-dark"></i>
                                                </a>

                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <div class="d-flex m-3">
                                {{ $users->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-app.footer />
    </main>
</x-app-layout>

<script src="/assets/js/plugins/datatables.js"></script>
<script>
    const dataTableBasic = new simpleDatatables.DataTable("#datatable-search", {
        searchable: true,
        fixedHeight: true,
        columns: [{
            select: [2, 6],
            sortable: false
        }]
    });
</script>
