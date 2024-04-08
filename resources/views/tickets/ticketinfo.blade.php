<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 bg-gray-200 h-100 border-radius-lg ">
        <section class="about-info-area section-gap bg-gray-100 mt-5 ">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 info-left">
                        <img class="img-fluid" src="{{ asset('event.png') }}" alt="">
                    </div>
                    <div class="col-lg-6 info-right">
                        <h1>Event Name</h1>
                        <p>
                            Here, I focus on a range of items and features that we use in life without giving them a
                            second thought. such as Coca Cola. Dolor sit amet, consectetur adipisicing elit, sed do
                            eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                            nostrud exercitation ullamco.
                        </p>
                        <h6>Time</h6>
                        <h6>Date</h6>
                        <h6>venue</h6>
                    </div>
                </div>
            </div>
        </section>
        <x-app.footer />
    </main>

</x-app-layout>
