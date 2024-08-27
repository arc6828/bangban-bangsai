<x-leaf.theme mode="navbar-dark">

    <!-- Hero -->
    <section class="section section-header bg-primary overlay-primary text-white" data-background="{{asset('leaf/assets/img/donate.jpg')}}">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 mx-auto text-center">
                    <!-- Heading -->
                    <h1 class="display-1 font-weight-bold">
                        ระบบแจ้งเตือนภัย
                    </h1>
                    <p class="lead mb-4 font-weight-bold">
                        ระบบคาดการณ์ล่วงหน้าและแจ้งเตือนจะพยากรณ์สิ่งที่กำลังจะเกิดขึ้นและแจ้งเตือนให้คุณทราบโดยเร็วที่สุด เพื่อยับยั้งและบรรเทาความสูญเสียที่อาจจะเกิดขึ้นต่อชีวิตและทรัพย์สิน
                    </p>
                    <!-- Text -->
                    <!-- <button type="button" class="btn btn-lg btn-secondary animate-up-2" data-toggle="modal" data-target="#modal-form"><i class="fas fa-donate mr-2"></i>Donate</button> -->
                    <!-- Modal Content -->
                    <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                            <div class="modal-content">
                                <div class="modal-body p-0">
                                    <div class="card bg-soft shadow-md border-0 p-3">
                                        <div class="card-header pt-3 pb-0">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                            <div class="text-center">
                                                <h3 class="text-dark">Make a Donation</h3>
                                                <p class="text-gray">Your donation will support nonprofits that prove community-led solutions are key to solving this challenge.</p>
                                            </div>
                                        </div>
                                        <div class="card-body text-dark text-left pt-2">
                                            <form>
                                                <div class="form-group">
                                                    <div class="input-group mb-4">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="far fa-user"></i></span>
                                                        </div>
                                                        <input class="form-control" name="name" placeholder="Name" type="text" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group mb-4">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="far fa-envelope"></i></span>
                                                        </div>
                                                        <input class="form-control" name="email" placeholder="Email" type="email" required>
                                                    </div>
                                                </div>
                                                <div class="form-check form-check-radio">
                                                    <label class="form-check-label mr-3">
                                                        <input class="form-check-input" type="radio" name="frequency" id="daily" value="daily" checked>
                                                        <span class="form-check-sign"></span>
                                                        Daily
                                                    </label>
                                                    <label class="form-check-label mr-3">
                                                        <input class="form-check-input" type="radio" name="frequency" id="weekly" value="weekly">
                                                        <span class="form-check-sign"></span>
                                                        Weekly
                                                    </label>
                                                    <label class="form-check-label mr-3">
                                                        <input class="form-check-input" type="radio" name="frequency" id="monthly" value="monthly">
                                                        <span class="form-check-sign"></span>
                                                        Monthly
                                                    </label>
                                                    <label class="form-check-label mr-3">
                                                        <input class="form-check-input" type="radio" name="frequency" id="yearly" value="yearly">
                                                        <span class="form-check-sign"></span>
                                                        Yearly
                                                    </label>
                                                </div>
                                                <div class="form-group my-4">
                                                    <label class="font-weight-bold h6 text-dark" for="reason">I want donate for:</label>
                                                    <select class="custom-select" id="reason">
                                                        <option>Education</option>
                                                        <option>Climate Change</option>
                                                        <option>Child Camps</option>
                                                        <option>Clean Water</option>
                                                    </select>
                                                </div>
                                                <label class="font-weight-bold h6 text-dark">How much do you want to donate?</label>
                                                <div class="form-check form-check-radio mt-0">
                                                    <label class="form-check-label mr-3">
                                                        <input class="form-check-input" type="radio" name="amount" value="20" checked>
                                                        <span class="form-check-sign"></span>
                                                        $20
                                                    </label>
                                                    <label class="form-check-label mr-3">
                                                        <input class="form-check-input" type="radio" name="amount" value="50">
                                                        <span class="form-check-sign"></span>
                                                        $50
                                                    </label>
                                                    <label class="form-check-label mr-3">
                                                        <input class="form-check-input" type="radio" name="amount" value="100">
                                                        <span class="form-check-sign"></span>
                                                        $100
                                                    </label>
                                                    <label class="form-check-label mr-3">
                                                        <input class="form-check-input" type="radio" name="amount" value="200">
                                                        <span class="form-check-sign"></span>
                                                        $200
                                                    </label>
                                                </div>
                                                <ul class="list-inline mt-4">
                                                    <li class="list-inline icon icon-md mr-1"><i class="fab fa-cc-visa"></i></li>
                                                    <li class="list-inline icon icon-md mr-1"><i class="fab fa-cc-mastercard"></i></li>
                                                    <li class="list-inline icon icon-md mr-1"><i class="fab fa-cc-amazon-pay"></i></li>
                                                    <li class="list-inline icon icon-md mr-1"><i class="fab fa-cc-stripe"></i></li>
                                                    <li class="list-inline icon icon-md mr-1"><i class="fab fa-cc-paypal"></i></li>
                                                    <li class="list-inline icon icon-md mr-1"><i class="fab fa-cc-amex"></i></li>
                                                    <li class="list-inline icon icon-md mr-1"><i class="fab fa-cc-discover"></i></li>
                                                </ul>
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-block btn-primary mt-4">Donate Now</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End of Modal Content -->
                </div>
            </div>
        </div>
    </section>
    <section class="section pt-0">
        <div class="container mt-n4 mt-xl-n8">
            <div class="row" classes="row d-none d-xl-block">
            <!-- <div class="row d-none d-xl-block"> -->
                <div class="col-12">
                    <!-- Card -->
                    <div class="card-group shadow-soft">
                        <div class="card border border-soft">
                            <div class="card-body p-5">
                                <x-leaf.predict.map></x-leaf.predict.map>
                                <h5 class="text-gray text-center">Country Contributions</h5>
                                <div class="d-flex flex-column flex-lg-row d-sm-flex justify-content-between align-items-center">
                                    <div class="my-5">
                                        <div id="vmap" style="width: 1012px; height: 500px;"></div>
                                    </div>
                                </div>
                                <div class="progress-wrapper mb-5">
                                    <div class="progress-info info-xl">
                                        <div class="progress-label">
                                            <h6 class="text-primary">Under implementation (8.127 b)</h6>
                                        </div>
                                        <div class="progress-percentage"><span class="text-gray">LEAF commitment: 16.53 b</span></div>
                                    </div>
                                    <div class="progress progress-xl">
                                        <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100" style="width: 55%;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-6 align-items-center justify-content-between">
                <div class="col-lg-6 pr-lg-5">
                    <h2>Top Country Contributions</h2>
                    <p class="lead lh-180 my-4">Since the LEAF was established in 2008, 14 donor countries have contributed over $8 billion in support of scaling up mitigation and adaptation action in developing and middle-income countries. These precious public resources are held in trust by the World Bank, and they are disbursed as grants, highly concessional loans, and risk mitigation instruments to recipient countries through multilateral development banks (MDBs).</p>
                </div>
                <div class="col-lg-5">
                    <div class="table-responsive">
                        <table class="table shadow-sm border border-soft">
                            <thead>
                                <tr>
                                    <th class="h5 border-0 pt-5 pl-5" scope="col">Country</th>
                                    <th class="h5 border-0 text-center" scope="col">Contribution</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="table-white">
                                    <td class="font-weight-bold pl-5">Australia</td>
                                    <td class="font-weight-normal text-center">$283.26m</td>
                                </tr>
                                <tr class="table-white">
                                    <td class="font-weight-bold pl-5">United Kingdom</td>
                                    <td class="font-weight-normal text-center">$2,830.80m</td>
                                </tr>
                                <tr class="table-white">
                                    <td class="font-weight-bold pl-5">France</td>
                                    <td class="font-weight-normal text-center">$136.17m</td>
                                </tr>
                                <tr class="table-white">
                                    <td class="font-weight-bold pl-5">Germany</td>
                                    <td class="font-weight-normal text-center">$680.67m</td>
                                </tr>
                                <tr class="table-white">
                                    <td class="font-weight-bold pl-5">Canada</td>
                                    <td class="font-weight-normal text-center">$277.03m</td>
                                </tr>
                                <tr class="table-white">
                                    <td class="font-weight-bold pl-5">Japan</td>
                                    <td class="font-weight-normal text-center">$1,234.14m</td>
                                </tr>
                                <tr class="table-white">
                                    <td class="font-weight-bold pb-5 pl-5">United States</td>
                                    <td class="font-weight-normal text-center">$2,000.04m</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-leaf.theme>