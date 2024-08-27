<section class="section section-lg py-6 ">
    <div class="container">
        <div class="row justify-content-center mb-4">
            <div class="col-lg-10 text-center">
                <span class=" badge badge-secondary badge-pill badge-lg mb-4 ">กิจกรรมของเรา</span>
                <p class="h2">
                    กิจกรรมของเราที่ทำร่วมกับชาวบ้านในอำเภอทุ่งสง
                </p>
            </div>
        </div>

        <div class="row">
            @foreach ($images as $m)
                <div class="col-12 col-md-6 col-lg-4 d-flex">
                    <!-- Card -->
                    <a class=" card mb-4 rounded bg-image animate-up-3 " href="{{ url('img/ground/' . $m) }}"
                        target="_blank">
                        <!-- Body -->
                        <div class="card-body z-2 my-auto text-white">
                            <img src="{{ url('img/ground/' . $m) }}" class="card-img-top" alt="Related news image 1"
                                height=200>
                        </div>
                    </a>
                </div>
            @endforeach
            
        </div>
        <div class="col text-center mt-lg-6">
            <a href="{{ url('/gallery') }}" class="btn btn-md btn-secondary animate-hover mr-3">
                <span class="btn-inner-text">
                    ดูกิจกรรมทั้งหมดของเรา
                    <i class=" fas fa-arrow-right animate-right-3 ml-2 "></i>
                </span>
            </a>
        </div>
    </div>
</section>
