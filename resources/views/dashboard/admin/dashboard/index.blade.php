@extends('dashboard.admin.index')
@section('content')
    <!-- Container -->
    <div class="container mt-xl-50 mt-sm-30 mt-15">
        <!-- Title -->
        <div class="hk-pg-header align-items-top">
            <div>
                <h2 class="hk-pg-title font-weight-600 mb-10">Market Management</h2>
                {{-- <p>Questions about onboarding lead data? <a href="#">Learn more.</a></p> --}}
            </div>
            {{-- <div class="d-flex w-500p">
                <select class="form-control custom-select custom-select-sm mr-15">
                    <option selected="">Latest Products</option>
                    <option value="1">CRM</option>
                    <option value="2">Projects</option>
                    <option value="3">Statistics</option>
                </select>
                <select class="form-control custom-select custom-select-sm mr-15">
                    <option selected="">USA</option>
                    <option value="1">USA</option>
                    <option value="2">India</option>
                    <option value="3">Australia</option>
                </select>
                <select class="form-control custom-select custom-select-sm">
                    <option selected="">December</option>
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="1">April</option>
                    <option value="2">May</option>
                    <option value="3">June</option>
                    <option value="1">July</option>
                    <option value="2">August</option>
                    <option value="3">September</option>
                    <option value="1">October</option>
                    <option value="2">November</option>
                    <option value="3">December</option>
                </select>
            </div> --}}
        </div>
        <!-- /Title -->

        <!-- Row -->
        <div class="row">
            <div class="col-xl-12">
                <div class="hk-row">
                    <div class="col-sm-12">
                        <div class="card-group hk-dash-type-2">
                            <!-- Kartu Total Pemesanan -->
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between mb-5">
                                        <div>
                                            <span class="d-block font-15 text-dark font-weight-500">Total Pemesanan</span>
                                        </div>
                                        <div>
                                            <span class="text-success font-14 font-weight-500">+12%</span>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="d-block display-4 text-dark mb-5">{{ $total_pemesanan }}</span>
                                        <small class="d-block">Target Pemesanan: 2000</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Kartu Total Produk -->
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between mb-5">
                                        <div>
                                            <span class="d-block font-15 text-dark font-weight-500">Total Produk
                                                Dipesan</span>
                                        </div>
                                        <div>
                                            <span class="text-success font-14 font-weight-500">+10%</span>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="d-block display-4 text-dark mb-5">{{ $total_produk }}</span>
                                        <small class="d-block">Target Produk: 15000</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Kartu Total Pendapatan -->
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between mb-5">
                                        <div>
                                            <span class="d-block font-15 text-dark font-weight-500">Total Pendapatan</span>
                                        </div>
                                        <div>
                                            <span class="text-success font-14 font-weight-500">+15%</span>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="d-block display-4 text-dark mb-5">Rp.
                                            {{ number_format($total_pendapatan, 0, ',', '.') }}</span>
                                        <small class="d-block">Target Pendapatan: Rp. 300.000.000</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                {{-- <div class="hk-row">
                    <div class="col-lg-6">
                        <div class="card card-refresh">
                            <div class="refresh-container">
                                <div class="loader-pendulums"></div>
                            </div>
                            <div class="card-header card-header-action">
                                <h6>Youtube Subscribers</h6>
                                <div class="d-flex align-items-center card-action-wrap">
                                    <a href="#" class="inline-block refresh mr-15">
                                        <i class="ion ion-md-radio-button-off"></i>
                                    </a>
                                    <div class="inline-block dropdown">
                                        <a class="dropdown-toggle no-caret" data-toggle="dropdown" href="#"
                                            aria-expanded="false" role="button"><i class="ion ion-md-more"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Separated link</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="hk-legend-wrap mb-20">
                                    <div class="hk-legend">
                                        <span
                                            class="d-10 bg-neon rounded-circle d-inline-block"></span><span>Desktop</span>
                                    </div>
                                    <div class="hk-legend">
                                        <span
                                            class="d-10 bg-neon-light-1 rounded-circle d-inline-block"></span><span>Mobile</span>
                                    </div>
                                </div>
                                <div id="area_chart" style="height: 240px;"></div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header card-header-action">
                                <h6>Country Stats</h6>
                                <div class="d-flex align-items-center card-action-wrap">
                                    <a href="#" class="inline-block refresh mr-15">
                                        <i class="ion ion-md-arrow-down"></i>
                                    </a>
                                    <a href="#" class="inline-block full-screen">
                                        <i class="ion ion-md-expand"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body pa-0">
                                <div class="pa-20">
                                    <div id="world_map_marker_1" style="height: 300px"></div>
                                </div>
                                <div class="table-wrap">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th class="w-25">Country</th>
                                                    <th>Sessions</th>
                                                    <th>Goals</th>
                                                    <th>Goals Rate</th>
                                                    <th>Bounce Rate</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Canada</td>
                                                    <td>55,555</td>
                                                    <td>210</td>
                                                    <td>2.46%</td>
                                                    <td>0.26%</td>
                                                </tr>
                                                <tr>
                                                    <td>India</td>
                                                    <td>24,152</td>
                                                    <td>135</td>
                                                    <td>0.58%</td>
                                                    <td>0.43%</td>
                                                </tr>
                                                <tr>
                                                    <td>UK</td>
                                                    <td>15,640</td>
                                                    <td>324</td>
                                                    <td>5.15%</td>
                                                    <td>2.47%</td>
                                                </tr>
                                                <tr>
                                                    <td>Botswana</td>
                                                    <td>12,148</td>
                                                    <td>854</td>
                                                    <td>4.19%</td>
                                                    <td>0.1%</td>
                                                </tr>
                                                <tr>
                                                    <td>UAE</td>
                                                    <td>11,258</td>
                                                    <td>453</td>
                                                    <td>8.15%</td>
                                                    <td>0.14%</td>
                                                </tr>
                                                <tr>
                                                    <td>Australia</td>
                                                    <td>10,786</td>
                                                    <td>376</td>
                                                    <td>5.48%</td>
                                                    <td>0.45%</td>
                                                </tr>
                                                <tr>
                                                    <td>Phillipines</td>
                                                    <td>9,485</td>
                                                    <td>63</td>
                                                    <td>3.51%</td>
                                                    <td>0.9%</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header card-header-action">
                                <h6>Linkedin Key Metrics</h6>
                                <div class="d-flex align-items-center card-action-wrap">
                                    <a href="#" class="inline-block refresh mr-15">
                                        <i class="ion ion-md-arrow-down"></i>
                                    </a>
                                    <a href="#" class="inline-block full-screen mr-15">
                                        <i class="ion ion-md-expand"></i>
                                    </a>
                                    <a class="inline-block card-close" href="#" data-effect="fadeOut">
                                        <i class="ion ion-md-close"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body pa-0">
                                <div class="table-wrap">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Metrics</th>
                                                    <th class="w-40">Period</th>
                                                    <th class="w-25">Past</th>
                                                    <th>Trend</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Clicks</td>
                                                    <td>
                                                        <div class="progress-wrap lb-side-left mnw-125p">
                                                            <div class="progress-lb-wrap">
                                                                <label class="progress-label mnw-50p">1,184</label>
                                                                <div
                                                                    class="progress progress-bar-rounded progress-bar-xs">
                                                                    <div class="progress-bar bg-primary w-70"
                                                                        role="progressbar" aria-valuenow="70"
                                                                        aria-valuemin="0" aria-valuemax="100">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>1,234</td>
                                                    <td>
                                                        <div id="sparkline_1"></div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Visits</td>
                                                    <td>
                                                        <div class="progress-wrap lb-side-left mnw-125p">
                                                            <div class="progress-lb-wrap">
                                                                <label class="progress-label mnw-50p">1,425</label>
                                                                <div
                                                                    class="progress progress-bar-rounded progress-bar-xs">
                                                                    <div class="progress-bar bg-neon-light-3 w-70"
                                                                        role="progressbar" aria-valuenow="70"
                                                                        aria-valuemin="0" aria-valuemax="100">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>3,458</td>
                                                    <td>
                                                        <div id="sparkline_2"></div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Views</td>
                                                    <td>
                                                        <div class="progress-wrap lb-side-left mnw-125p">
                                                            <div class="progress-lb-wrap">
                                                                <label class="progress-label mnw-50p">5,623</label>
                                                                <div
                                                                    class="progress progress-bar-rounded progress-bar-xs">
                                                                    <div class="progress-bar bg-neon-light-4 w-60"
                                                                        role="progressbar" aria-valuenow="70"
                                                                        aria-valuemin="0" aria-valuemax="100">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>53,637</td>
                                                    <td>
                                                        <div id="sparkline_3"></div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Returns</td>
                                                    <td>
                                                        <div class="progress-wrap lb-side-left mnw-125p">
                                                            <div class="progress-lb-wrap">
                                                                <label class="progress-label mnw-50p">4,851</label>
                                                                <div
                                                                    class="progress progress-bar-rounded progress-bar-xs">
                                                                    <div class="progress-bar bg-neon-light-1 w-55"
                                                                        role="progressbar" aria-valuenow="70"
                                                                        aria-valuemin="0" aria-valuemax="100">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>20,596</td>
                                                    <td>
                                                        <div id="sparkline_4"></div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header card-header-action">
                                <h6>Users by Gendar & Age</h6>
                                <div class="d-flex align-items-center card-action-wrap">
                                    <div class="inline-block dropdown">
                                        <a class="dropdown-toggle no-caret" data-toggle="dropdown" href="#"
                                            aria-expanded="false" role="button"><i class="ion ion-ios-more"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Separated link</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="m_chart_4" style="height:250px;"></div>
                                <div class="hk-legend-wrap mt-20">
                                    <div class="hk-legend">
                                        <span
                                            class="d-10 bg-primary rounded-circle d-inline-block"></span><span>18-24</span>
                                    </div>
                                    <div class="hk-legend">
                                        <span
                                            class="d-10 bg-neon-light-1 rounded-circle d-inline-block"></span><span>25-34</span>
                                    </div>
                                    <div class="hk-legend">
                                        <span
                                            class="d-10 bg-neon-light-2 rounded-circle d-inline-block"></span><span>35-44</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header card-header-action">
                                <h6>Analytics Audience Matrics</h6>
                                <div class="d-flex align-items-center card-action-wrap">
                                    <div class="inline-block dropdown">
                                        <a class="dropdown-toggle no-caret" data-toggle="dropdown" href="#"
                                            aria-expanded="false" role="button"><i class="ion ion-ios-more"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Separated link</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="hk-legend-wrap mb-20">
                                    <div class="hk-legend">
                                        <span
                                            class="d-10 bg-primary rounded-circle d-inline-block"></span><span>Users</span>
                                    </div>
                                    <div class="hk-legend">
                                        <span
                                            class="d-10 bg-neon-light-1 rounded-circle d-inline-block"></span><span>Sessions</span>
                                    </div>
                                </div>
                                <div id="e_chart_6" class="echart" style="height:225px;"></div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
        <!-- /Row -->
    </div>
    <!-- /Container -->


    <!-- /Main Content -->
@endsection
