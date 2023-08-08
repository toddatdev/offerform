<x-guest-layout>
    <x-slot name="title">
        Contact
    </x-slot>

    <div class="container contact-us mt-5 " style="margin-bottom: 200px;">
        <div class="row">
            <div class="col-lg-6 align-self-center">
                <div class="d-flex justify-content-start mb-5"  data-aos="fade-right">
                    <div class="icon  bg-white shadow p-4 rounded-circle">
                        <img class="img-fluid" src="/img/contact/phone.svg" alt="">
                    </div>
                    <div class="contact-info align-self-center" >
                        <h2 class="fw-semibold">Call Us</h2>
                        <p><a class="text-decoration-none fs-17 text-dark" href="tel:5414065296">(541) 406-5296</a></p>
                    </div>
                </div>

                <div class="d-flex justify-content-start mb-5" data-aos="fade-left">
                    <div class="icon bg-white shadow p-4 rounded-circle">
                        <img class="img-fluid" src="/img/contact/mail.svg" alt="">
                    </div>
                    <div class="contact-info align-self-center">
                        <h2>Email Us</h2>
                        <p><a class="text-decoration-none fs-17 text-dark" href="mailto:cody@offerform.me">cody@offerform.me</a></p>
                    </div>
                </div>

            </div>

            <div class="col-lg-6 align-self-center"  data-aos="fade-up">
                @livewire('contact.form')
            </div>
        </div>
    </div>

</x-guest-layout>
