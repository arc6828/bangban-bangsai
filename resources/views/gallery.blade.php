<x-leaf.theme mode="navbar-light" title="คลังภาพ" description="รวบรวมรูปภาพ และกิจกรรมที่ทำในระยะเวลาตลอดปีที่ผ่านมา ในพื้นที่อำเภอทุ่งสง จังหวัดนครศรีธรรมราช" image="{{ url('img/ground/LINE_ALBUM_Nakhon%20Sri%20_day%201_160222_220914_147.jpg') }}">
    <section class="section section-header">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1>คลังภาพ</h1>
                    
                    <hr class="my-4" />
                </div>
            </div>          

            <div class="row">
                @foreach ($images as $m)
                    <div class="col-12 col-md-6 col-lg-4 d-flex">
                        <!-- Card -->
                        <a class=" card mb-4 rounded bg-image animate-up-3 " href="{{ url('img/ground/' . $m) }}" target="_blank">
                            <!-- Body -->
                            <div class="card-body z-2 my-auto text-white">
                                <img src="{{ url('img/ground/' . $m) }}" class="card-img-top" alt="Related news image 1"
                                    height=200>
                            </div>
                        </a>
                    </div>
                @endforeach              
            </div>
        </div>
    </section>
</x-leaf.theme>
