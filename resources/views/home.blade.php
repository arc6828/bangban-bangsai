<x-leaf.theme mode="navbar-light">
    <!-- Hero -->
    <section class="section section-lg py-6 bg-soft text-dark">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 text-center">
                    <!-- <h1 class="pt-4">
                        <img src="{{ url('img/LOGO_KU_Flood-02.png') }}" width="100" /> ML Flood by KU
                    </h1> -->
                </div>
                <div class="col-12 d-md-none d-none">
                    <!-- <h1 class="display-2 font-weight-bold mb-0">
                        ML Flood by KU
                    </h1> -->
                </div>
                <div class="col-8 col-md-7 col-lg-6 order-lg-1 d-none">
                    <!-- Heading -->
                    <!-- <h1 class="display-2 font-weight-bold d-none d-md-inline">We<span class="font-weight-bold">
                                safeguard </span> the environment.</h1> -->
                    <h1 class=" display-2 font-weight-bold d-none d-md-inline ">
                        ML Flood by KU
                    </h1>

                    <!-- Text -->
                    <!-- <p class="lead text-muted mt-4">Over the past several decades, as the world has <br
                                class="d-none d-lg-inline">increasingly warmed, so has its potential to burn.</p> -->
                    <p class="lead text-muted mt-4">
                        แสดงภาพแผนที่น้ำท่วมบริเวณใกล้เคียงกับที่อยู่อาศัยของคุณร่วมกับแผนที่
                        GIS
                        พร้อมทั้งทำนายเหตุการณ์ที่จะเกิดในอนาคตอันใกล้ด้วยเทคนิคจักกลเรียนรู้
                        (Machine Learning)
                    </p>

                    <!-- Buttons -->
                    <!-- <div class="mt-4 mt-lg-5 mb-5 mb-lg-0">
                            <a href="./html/pages/our-mission.html" class="btn btn-md btn-primary animate-up-2 mr-3">
                                <span class="btn-inner-text"><i class="fas fa-book-reader mr-2"></i>Our mission</span>
                            </a>
                            <a href="#" class="btn btn-md btn-white animate-up-2 d-none d-lg-inline-block">
                                <span class="btn-inner-text"><i class="fas fa-file-download mr-2"></i>Download
                                    report</span>
                            </a>
                        </div> -->
                    <div class="mt-4 mt-lg-5 mb-5 mb-lg-0">
                        <a href="./html/pages/our-mission.html" class=" btn btn-md btn-primary animate-up-2 mr-3 ">
                            <span class="btn-inner-text"><i class="fas fa-book-reader mr-2"></i>ดูการพยากรณ์</span>
                        </a>
                        <a href="#" class=" btn btn-md btn-white animate-up-2 d-none d-lg-inline-block ">
                            <span class="btn-inner-text"><i class="fas fa-file-download mr-2"></i>Download รายงาน</span>
                        </a>
                    </div>
                </div>
                <div class="col-4 col-md-5 col-lg-6 order-lg-2 d-none">
                    <!-- Image -->
                    <!-- <img src="./assets/img/forest.svg" class="img-fluid mb-lg-6 mb-0" alt="Forest Illustration" /> -->
                    <img src="{{ asset('leaf/assets/img/forest.svg') }}" class="img-fluid mb-lg-6 mb-0"
                        alt="Forest Illustration" />
                </div>
            </div>
        </div>
    </section>
    
    <x-leaf.statistic.number></x-leaf.statistic.number>

    <x-leaf.predict.map2 :wl="$wl" :rain="$rain"></x-leaf.predict.map2>

    <section class="section section-lg py-6 bg-soft">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center text-dark">
                    <h2>วิธีการที่เราใช้</h2>
                    <p class="lead text-gray my-4">
                        ระบบนี้เป็นรวมงานวิศวกรรมด้านเซนเซอร์
                        และการทำโมเดลน้ำท่วม
                        และการทำจักรกลเรียนรู้ทั้งสามด้านเข้าด้วยกัน
                    </p>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12 col-lg-4 mb-5">
                    <a class="card animate-up-3 shadow-sm border-soft" href="#">
                        <div class="px-5 pt-4 pb-5" style="min-height: 300px;">
                            <span class=" badge badge-secondary badge-pill mb-2 ">
                                Sensoring
                            </span>
                            <!-- ตอนเเรกเป็น h5 เปลี่ยนเพราะ พื้นที่เกินไม่สวย -->
                            <h6 class="mb-3">
                                การจัดเก็บข้อมูลจากเซนเซอร์
                            </h6>
                            <p class="text-gray mb-0">
                                ข้อมูลจากเซนเซอร์ต่างๆ
                                จะได้รับมาจากหน่วยงานที่ดูแลด้านข้อมูลซึ่งข้อมูลที่เราใช้จะเป็นข้อมูล ทุติยภูมิ
                            </p>
                        </div>
                        <div>
                            <img src="{{ asset('leaf/assets/img/illustrations/evidence.svg') }}"
                                class="img-fluid img-center" alt="Illustration" />
                        </div>
                    </a>
                </div>
                <div class="col-12 col-lg-4 mb-5">
                    <a class="card animate-up-3 shadow-sm border-soft" href="#">
                        <div class="px-5 pt-4 pb-5" style="min-height: 300px;">
                            <span class=" badge badge-primary badge-pill mb-2 ">Modeling</span>
                            <!-- ตอนเเรกเป็น h5 -->
                            <h6 class="mb-3">การสร้างโมเดลน้ำท่วม</h6>
                            <p class="text-gray mb-0">
                                การจัดทำแผนที่น้ำท่วม โดยใช้ข้อมูลจากระดับน้ำและปริมาณฝนที่ได้รับมาทำการแสดงเป็นแผนที่
                                GIS และแสดงผลผลเว็บแอพพลิเคชั่นโดยใช้ซอฟแวร์ด้านวิศวกรรมน้ำ
                            </p>
                        </div>
                        <div>
                            <img src="{{ asset('leaf/assets/img/illustrations/causes.svg') }}"
                                class="img-fluid img-center" alt="Illustration" />
                        </div>
                    </a>
                </div>
                <div class="col-12 col-lg-4 mb-5">
                    <a class="card animate-up-3 shadow-sm border-soft" href="#">
                        <div class="px-5 pt-4 pb-5" style="min-height: 300px;">
                            <span class=" badge badge-tertiary badge-pill mb-2 ">Machine Learning</span>
                            <h5 class="mb-3">จักรกลเรียนรู้</h5>
                            <p class="text-gray mb-0">
                                เลียนแบบการทำงานและวิธีออกผลลัพธ์ของซอฟแวร์ด้านวิศวกรรมน้ำ
                                โดยในอนาคตจะเป็นซอฟแวร์ที่มาแทนที่ ซอฟแวร์ด้านวิศกรรมน้ำ
                            </p>
                        </div>
                        <div>
                            <img src="{{ asset('leaf/assets/img/illustrations/solution.svg') }}"
                                class="img-fluid img-center" alt="Illustration" />
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="section section-lg py-6 ">
        <div class="container">
            <div class="row justify-content-center mb-4">
                <div class="col-lg-10 text-center">
                    <h2> บทความ </h2>
                </div>
            </div>
            @php
                $blogs = $blogObject['channel']['item'];
                $overlays = ['overlay-primary', 'overlay-secondary', 'overlay-tertiary'];
                
            @endphp
            <div class="row">
                @foreach ($blogs as $item)
                    <div class="col-12 col-md-6 d-flex">
                        <!-- Card -->
                        <a class=" card mb-5 {{ $overlays[$loop->index] }} rounded bg-image animate-up-3 "
                            href="{{ $item['link'] }}">
                            <!-- Body -->
                            <div class="card-body z-2 my-auto text-white">
                                <!-- Heading -->
                                <h4 class="font-weight-normal mt-4 mb-3">
                                    {{ $item['title'] }}
                                </h4>


                                <img src="{{ $item['image_url'] }}" class="card-img-top" alt="{{ $item['title'] }}"
                                    height=300 />

                                <!-- Text -->
                                <p class="my-2">
                                    <i class="far fa-calendar-alt mr-2"></i>{{ $item['pubDate'] }}
                                </p>
                                <p class="card-text my-2">{{ $item['first_paragraph'] }}</p>
                                <small class="d-block mb-2">
                                    <i class="fas fa-user mr-2"></i>
                                    {{-- January 20, <span class="current-year">2022</span> --}}
                                    {{ $item['creator'] }}
                                </small>
                                <span>
                                    <i class="fas fa-dot-circle mr-2"></i>
                                    @php
                                        $category_string = join(', ', $item['category']);
                                    @endphp
                                    {{ $category_string }}
                                </span>
                            </div>
                        </a>
                    </div>
                @endforeach
                {{-- <div class="col-12 col-md-6 col-lg-4 d-flex">
                    <!-- Card -->
                    <a class=" card mb-4 mb-lg-0 pb-11 overlay-secondary rounded bg-image animate-up-3 "
                        href="./html/pages/update.html" data-background="./assets/img/activity-2.jpg">
                        <!-- Body -->
                        <div class="card-body z-2 my-auto text-white">
                            <span class="font-weight-bold"><i class="fas fa-dot-circle mr-2"></i>Lead Author
                                Meetings</span>
                            <!-- Heading -->
                            <h4 class="font-weight-normal mt-4 mb-3">
                                Third Lead Author Meeting of the IPCC
                                Working Group I Sixth Assessment Report
                            </h4>

                            <!-- Text -->
                            <p class="mb-0">
                                <i class="far fa-calendar-alt mr-2"></i>August 26,
                                <span class="current-year"></span>
                            </p>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-md-6 col-lg-4 d-flex">
                    <!-- Card -->
                    <a class=" card mb-4 mb-lg-0 pb-11 overlay-tertiary rounded bg-image animate-up-3 "
                        href="./html/pages/update.html" data-background="./assets/img/activity-3.jpg">
                        <!-- Body -->
                        <div class="card-body z-2 my-auto text-white">
                            <span class="font-weight-bold"><i class="fas fa-dot-circle mr-2"></i>Meeting</span>
                            <!-- Heading -->
                            <h4 class="font-weight-normal mt-4 mb-3">
                                Second Joint Session of IPCC Working
                                Groups I, II and III, in cooperation
                                with the TFI and IPCC 50
                            </h4>

                            <!-- Text -->
                            <p class="mb-0">
                                <i class="far fa-calendar-alt mr-2"></i>August 1,
                                <span class="current-year"></span>
                            </p>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-md-6 col-lg-4 d-flex d-lg-none">
                    <!-- Card -->
                    <a class=" card  mb-5 mb-lg-0  pb-11  overlay-primary rounded  bg-image animate-up-3 "
                        href="./html/pages/update.html" data-background="./assets/img/activity-3.jpg">
                        <!-- Body -->
                        <div class="card-body z-2 my-auto text-white">
                            <span class="font-weight-bold"><i class="fas fa-dot-circle mr-2"></i>Meeting</span>
                            <!-- Heading -->
                            <h4 class="font-weight-normal mt-4 mb-3">
                                Second Joint Session of IPCC Working
                                Groups I, II and III, in cooperation
                                with the TFI and IPCC 50
                            </h4>

                            <!-- Text -->
                            <p class="mb-0">
                                <i class="far fa-calendar-alt mr-2"></i>August 1,
                                <span class="current-year"></span>
                            </p>
                        </div>
                    </a>
                </div> --}}
            </div>
            <div class="col text-center mt-4">
                <a href="{{ url('blog') }}" class="btn btn-md btn-primary animate-hover mr-3">
                    <span class="btn-inner-text">
                        ดูกิจกรรมทั้งหมดของเรา
                        <i class=" fas fa-arrow-right animate-right-3 ml-2 "></i>
                    </span>
                </a>
            </div>
        </div>
    </section>
    <x-leaf.gallery.gallery :images="$images"></x-leaf.gallery.gallery>
    <section class="section section-lg py-6 pb-5 mb-5">
        <div class="container">

        </div>
    </section>

    <!-- End of section -->



</x-leaf.theme>
