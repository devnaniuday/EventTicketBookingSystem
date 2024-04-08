<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="container-fluid ">
            <form action={{ route('user.PhotoUpdate') }} method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mt-5 mb-5 mt-lg-7 row justify-content-center">
                    <div class="col-lg-9 col-12">
                        <div class="card card-body"
                            style="background-image: radial-gradient( circle farthest-corner at 12.3% 19.3%,  rgba(85,88,218,1) 0%, rgba(95,209,249,1) 100.2% );"
                            id="zoomin">
                            <div class="row z-index-2 justify-content-start align-items-center">
                                <div class="col-sm-auto col-4">
                                    <div class="avatar avatar-2xl position-relative">
                                        <div class="position-relative">
                                            @if (auth()->user()->pfp)
                                                <img src="{{ url('storage/' . auth()->user()->pfp) }}"
                                                    alt="Profile Photo"
                                                    class="w-100 h-100 object-fit-cover border-radius-2xl shadow-sm"
                                                    id="preview">
                                            @else
                                                <img src="{{ asset('profileimg.png') }}" alt="Default Profile Photo"
                                                    class="w-100 h-100 object-fit-cover border-radius-2xl shadow-sm"
                                                    id="preview">
                                            @endif
                                            <div class="edit-icon" hidden>
                                                <i class="fas fa-pencil-alt"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-auto col-8 my-auto">
                                    <div class="h-100">
                                        <h2 class="  font-weight-bolder">
                                            {{ auth()->user()->name }}
                                        </h2>
                                        <p>{{ auth()->user()->email }}</p>
                                    </div>
                                </div>
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
                <div class="container">
                    <div class="row mx-0 justify-content-center">
                        <div class="col-md-7 col-lg-5 px-lg-2 col-xl-4 px-xl-0 px-xxl-3">
                            <label class="d-block mb-4">
                                <span class="form-label d-block">Your photo</span>
                                <input name="photo" type="file" class="form-control" accept="image/*" />
                            </label>
                            <small id="helpId" class="text-muted">
                                @error('photo')
                                    {{ $message }}
                                @enderror
                            </small>
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-10">
                                        <button type="submit"
                                            class="btn btn-outline-success btn-sm float-end">Upload</button>
                                    </div>
                                    <div class="col-2">
                                        <button type="button" class="btn btn-outline-danger btn-sm float-start"
                                            onclick="window.location.href='{{ route('user.profile') }}'">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <x-app.footer />
        </div>
    </main>
</x-app-layout>
