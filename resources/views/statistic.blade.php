<x-leaf.theme mode="navbar-dark" title="ตัวเลขและสถิติ" description="ข้อมูลปัจจุบัน ข้อมูลย้อนหลัง ผลการวิเคราะห์ ตัวเลขและสถิติ แผนที่ GIS" image="{{ url('leaf/assets/img/our-mission.jpg') }}">
    <!-- Hero -->
    <section class="section section-lg bg-secondary overlay-primary text-white" data-background="{{ asset('leaf/assets/img/our-mission.jpg') }}">
        <div class="container">
            <div class="row justify-content-center pt-5">
                <div class="col-10 mx-auto text-center">
                    <!-- Heading -->
                    <h1 class="display-1 font-weight-bold">
                        ตัวเลขและสถิติ
                    </h1>
                    <p class="lead mb-4 font-weight-bold">
                        ข้อมูลย้อนหลังอาจบอกใบ้ถึงสิ่งที่กำลังจะเกิดขึ้นในอนาคต ข้อมูลระดับน้ำ ข้อมูลน้ำฝน จะถูกนำมาใช้เป็นวัตถุดิบในการประมวลผลสำหรับระบบพยากรณ์และการแจ้งเตือน
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- Section -->
    <div class="section pt-0">
        <div class="container mt-n5">
            <div class="row">
                <div class="col">
                    <x-leaf.predict.map3 :wl="$wl" :rain="$rain"></x-leaf.predict.map3>
                </div>
                <div class="col d-none">
                    <!-- Tab -->
                    <nav>
                        <div class="nav nav-tabs flex-column flex-md-row shadow-sm border-soft justify-content-around bg-white rounded mb-3 py-3" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-evidence-tab" data-toggle="tab" href="#nav-evidence" role="tab" aria-controls="nav-evidence" aria-selected="true"><i class="fas fa-file-alt"></i>Evidence</a>
                            <a class="nav-item nav-link" id="nav-causes-tab" data-toggle="tab" href="#nav-causes" role="tab" aria-controls="nav-causes" aria-selected="false"><i class="fas fa-chart-pie"></i>Causes</a>
                            <a class="nav-item nav-link" id="nav-effects-tab" data-toggle="tab" href="#nav-effects" role="tab" aria-controls="nav-effects" aria-selected="false"><i class="fas fa-square-root-alt"></i>Effects</a>
                            <a class="nav-item nav-link" id="nav-scientific-tab" data-toggle="tab" href="#nav-scientific" role="tab" aria-controls="nav-scientific" aria-selected="false"><i class="fas fa-journal-whills"></i>Scientific Consensus</a>
                            <a class="nav-item nav-link" id="vital-signs-tab" data-toggle="tab" href="#vital-signs" role="tab" aria-controls="vital-signs" aria-selected="false"><i class="fas fa-file-medical-alt"></i>Vital Signs</a>
                            <a class="nav-item nav-link" id="nav-questions-tab" data-toggle="tab" href="#nav-questions" role="tab" aria-controls="nav-questions" aria-selected="false"><i class="fas fa-question-circle"></i>Questions (FAQ)</a>
                        </div>
                    </nav>
                    <!-- Tab -->
                    <div class="tab-content mt-4 mt-lg-5" id="nav-tabContent">
                        <x-leaf.statistic.tab-content></x-leaf.statistic.tab-content>
                    </div>
                    <!-- End of tab -->
                </div>
            </div>
        </div>
    </div>

</x-leaf.theme>
