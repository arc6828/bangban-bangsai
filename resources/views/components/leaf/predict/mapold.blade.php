<div class="section section-lg">
    <div class="container">
        <div class="display-5">
            ทุ่งสง
            เป็นอำเภอที่มีความเจริญเป็นอันดับสองของจังหวัดนครศรีธรรมราช
            รองจากอำเภอเมืองนครศรีธรรมราช
            เนื่องจากมีที่ตั้งอยู่ตรงกลางของภาคใต้และเป็นจุดศูนย์กลางคมนาคมทางบกทั้งรถยนต์และรถไฟ
            มีสถานีตรวจวัดระดับน้ำ 1 สถานี้
            และสถานีตรวจวัดระดับน้ำฝน 10 สถานี
        </div>
        <br />
        <div class="row mb-4 mb-lg-6">
            <!-- <div class="col-lg-6 pr-lg-5">
                            <p class="h5 font-weight-bold lh-180">
                                LEAF was created to provide policymakers with
                                regular scientific assessments on climate
                                change, its implications and potential future
                                risks, as well as to put forward adaptation and
                                mitigation options.
                            </p>
                        </div> -->
            <div class="col-lg-6 pr-lg-5">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">สถานี</th>
                            <th scope="col">ที่ตั้ง</th>
                            <th scope="col">ระดับน้ำ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>ทุ่งสง</td>
                            <td>
                                ต.ปากเเพรก อ.ทุ่งสง จ.นครศรีธรรมราช
                            </td>
                            <td>51.30</td>
                        </tr>
                        <!-- <tr>
                                        <th scope="row">2</th>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td colspan="2">Larry the Bird</td>
                                    </tr> -->
                    </tbody>
                </table>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">ชื่อสถานี</th>
                            <th scope="col">ที่ตั้ง</th>
                            <th scope="col">เวลา</th>
                            <th scope="col">ฝนล่าสุด</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>บ้านคลองตูกเหนือ</td>
                            <td>
                                ต.กะปาง อ.ทุ่งสง จ.นครศรีธรรมราช
                            </td>
                            <td>14.00</td>
                            <td>
                                <button type="button" class="btn btn-warning">
                                    51
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                หน่วยพิทักษ์อุทยานเเห่งชาติที่ ขป.๔
                                (บ้านน้ำตก)
                            </td>
                            <td>
                                ต.น้ำตก อ.ทุ่งสง จ.นครศรีธรรมราช
                            </td>
                            <td>16.00</td>
                            <td>
                                <button type="button" class="btn btn-primary">
                                    48.8
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>ทุ่งสง</td>
                            <td>
                                ต.ปากเเพรก อ.ทุ่งสง จ.นครศรีธรรมราช
                            </td>
                            <td>16.00</td>
                            <td>
                                <button type="button" class="btn btn-primary">
                                    43.8
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>บ้านหิวราว</td>
                            <td>
                                ต.เขาขาว อ.ทุ่งสง จ.นครศรีธรรมราช
                            </td>
                            <td>15.00</td>
                            <td>
                                <button type="button" class="btn btn-primary">
                                    41
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>ฝายคลองเปิก</td>
                            <td>
                                ต.ถ้ำใหญ่ อ.ทุ่งสง จ.นครศรีธรรมราช
                            </td>
                            <td>16.00</td>
                            <td>
                                <button type="button" class="btn btn-primary">
                                    40.8
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>รร.บ้านพูน</td>
                            <td>
                                ต.กะปาง อ.ทุ่งสง จ.นครศรีธรรมราช
                            </td>
                            <td>16.00</td>
                            <td>
                                <button type="button" class="btn btn-primary">
                                    37.4
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- <div class="col-lg-6">
                            <p class="lead lh-180">
                                Through its assessments, the LEAF determines the
                                state of knowledge on climate change. It
                                identifies where there is agreement in the
                                scientific community on topics related to
                                climate change, and where further research is
                                needed. The reports are drafted and reviewed in
                                several stages, thus guaranteeing objectivity
                                and transparency. The LEAF does not conduct its
                                own research.
                            </p>
                            <p class="lead lh-180">
                                LEAF reports are neutral, policy-relevant but
                                not policy-prescriptive. The assessment reports
                                are a key input into the international
                                negotiations to tackle climate change.
                            </p>
                        </div> -->
            <div class="col-lg-6">
                <div id="map"></div>
                <script>
                    var map = L.map("map").setView([0, 0], 1);
                    L.tileLayer(
                        "https://api.maptiler.com/maps/streets/{z}/{x}/{y}.png?key=4XVGrxzCZYBYVpqyAVTs", {
                            attribution: '<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>',
                        }
                    ).addTo(map);
                    var marker = L.marker([
                        8.169742463710204, 99.67182347414169,
                    ]).addTo(map);
                </script>
            </div>
        </div>
        <div class="col text-center">
            <a href="./html/pages/about.html" class="btn btn-md btn-primary animate-up-2 mr-3">
                <span class="btn-inner-text"><i class="fas fa-book-open mr-2"></i>
                    ดูข้อมูลย้อนหลัง
                </span>
            </a>
        </div>
    </div>
</div>