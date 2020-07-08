@extends('layouts.home-template')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-7">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Task by Team</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div id="chart-task" style="height: 370px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                            <div class="iq-card-body tasks-box">
                                <div class="d-flex align-items-center">
                                    <a href="#" class="iq-icon-box rounded-circle iq-bg-primary mr-3">
                                        <i class="ri-file-shield-line"></i>
                                    </a>
                                    <div>
                                        <h6>Projects:</h6>
                                        <h3>2500</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                            <div class="iq-card-body tasks-box">
                                <div class="d-flex align-items-center">
                                    <a href="#" class="iq-icon-box rounded-circle iq-bg-success mr-3">
                                        <i class="ri-check-line"></i>
                                    </a>
                                    <div>
                                        <h6>Complited:</h6>
                                        <h3>1500</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                            <div class="iq-card-body tasks-box">
                                <div class="d-flex align-items-center">
                                    <a href="#" class="iq-icon-box rounded-circle iq-bg-info mr-3">
                                        <i class="ri-ball-pen-line"></i>
                                    </a>
                                    <div>
                                        <h6>In Progress:</h6>
                                        <h3>500</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                            <div class="iq-card-body tasks-box">
                                <div class="d-flex align-items-center">
                                    <a href="#" class="iq-icon-box rounded-circle iq-bg-danger mr-3">
                                        <i class="ri-close-line"></i>
                                    </a>
                                    <div>
                                        <h6>Overdue:</h6>
                                        <h3>500</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                            <div class="iq-card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">Top inquiries</h4>
                                </div>
                            </div>
                            <div class="iq-card-body tasks-box">
                                <div class="d-flex align-items-center judtify-content-between mb-3">
                                    <h5 class="col-sm-6 pl-0">UI/UX Design</h5>
                                    <div class="col-sm-6 p-0 iq-progress-bar">
                                        <span class="bg-primary" data-percent="65"></span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center judtify-content-between mb-3">
                                    <h5 class="col-sm-6 pl-0">Product Design</h5>
                                    <div class="col-sm-6 p-0 iq-progress-bar">
                                        <span class="bg-info" data-percent="35"></span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center judtify-content-between">
                                    <h5 class="col-sm-6 pl-0">Testing</h5>
                                    <div class="col-sm-6 p-0 iq-progress-bar">
                                        <span class="bg-success" data-percent="80"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                    <div class="iq-card-body">
                        <div id="chart-home3-01"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Ongoing Tsk</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <ul class="task-lists m-0 p-0">
                            <li class="d-flex mb-4 align-items-center">
                                <div class="user-img img-fluid"><img src="images/user/01.jpg" alt="story-img"
                                        class="rounded-circle avatar-40"></div>
                                <div class="media-support-info ml-3">
                                    <h6>Make New Home Page</h6>
                                    <p class="mb-0 font-size-12">Feb 14, 2020</p>
                                </div>
                            </li>
                            <li class="d-flex mb-4 align-items-center">
                                <div class="user-img img-fluid"><img src="images/user/02.jpg" alt="story-img"
                                        class="rounded-circle avatar-40"></div>
                                <div class="media-support-info ml-3">
                                    <h6>Redesign the Dashboard</h6>
                                    <p class="mb-0 font-size-12">Feb 12, 2020</p>
                                </div>
                            </li>
                            <li class="d-flex mb-4 align-items-center">
                                <div class="user-img img-fluid"><img src="images/user/03.jpg" alt="story-img"
                                        class="rounded-circle avatar-40"></div>
                                <div class="media-support-info ml-3">
                                    <h6>Analysis New Product</h6>
                                    <p class="mb-0 font-size-12">Feb 10, 2020</p>
                                </div>
                            </li>
                            <li class="d-flex mb-4 align-items-center">
                                <div class="user-img img-fluid"><img src="images/user/04.jpg" alt="story-img"
                                        class="rounded-circle avatar-40"></div>
                                <div class="media-support-info ml-3">
                                    <h6>Ubdate Dashboard 3</h6>
                                    <p class="mb-0 font-size-12">Feb 12, 2020</p>
                                </div>
                            </li>
                            <li class="d-flex align-items-center">
                                <div class="user-img img-fluid"><img src="images/user/05.jpg" alt="story-img"
                                        class="rounded-circle avatar-40"></div>
                                <div class="media-support-info ml-3">
                                    <h6>Salve Support Tikit</h6>
                                    <p class="mb-0 font-size-12">Feb 14, 2020</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Activity Feed</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <ul class="task-lists m-0 p-0">
                            <li class="d-flex mb-4 align-items-center">
                                <div class="profile-icon iq-bg-primary"><span>B</span></div>
                                <div class="media-support-info ml-3">
                                    <h6>Bob Frapples</h6>
                                    <p class="mb-0 font-size-12">Designer On UX Design</p>
                                </div>
                            </li>
                            <li class="d-flex mb-4 align-items-center">
                                <div class="profile-icon iq-bg-info"><span>P</span></div>
                                <div class="media-support-info ml-3">
                                    <h6>Paige Turner</h6>
                                    <p class="mb-0 font-size-12">Developer on Wordpress</p>
                                </div>
                            </li>
                            <li class="d-flex mb-4 align-items-center">
                                <div class="profile-icon iq-bg-danger"><span>A</span></div>
                                <div class="media-support-info ml-3">
                                    <h6>Anna Mull</h6>
                                    <p class="mb-0 font-size-12">Designer on UI Design</p>
                                </div>
                            </li>
                            <li class="d-flex mb-4 align-items-center">
                                <div class="profile-icon iq-bg-success"><span>P</span></div>
                                <div class="media-support-info ml-3">
                                    <h6>Paul Molive</h6>
                                    <p class="mb-0 font-size-12">Complited On UX Design</p>
                                </div>
                            </li>
                            <li class="d-flex align-items-center">
                                <div class="profile-icon iq-bg-warning"><span>A</span></div>
                                <div class="media-support-info ml-3">
                                    <h6>Anna Sthesia</h6>
                                    <p class="mb-0 font-size-12">Complited on UI Design</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Project</h4>
                        </div>
                        <div class="iq-card-header-toolbar d-flex align-items-center">
                            <div class="dropdown">
                                <span class="dropdown-toggle text-primary" id="dropdownMenuButton01"
                                    data-toggle="dropdown">
                                    <i class="ri-more-2-fill"></i>
                                </span>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton01">
                                    <a class="dropdown-item" href="#"><i class="ri-eye-fill mr-2"></i>View</a>
                                    <a class="dropdown-item" href="#"><i
                                            class="ri-delete-bin-6-fill mr-2"></i>Delete</a>
                                    <a class="dropdown-item" href="#"><i class="ri-pencil-fill mr-2"></i>Edit</a>
                                    <a class="dropdown-item" href="#"><i class="ri-printer-fill mr-2"></i>Print</a>
                                    <a class="dropdown-item" href="#"><i
                                            class="ri-file-download-fill mr-2"></i>Download</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="table-responsive">
                            <table class="table mb-0 table-borderless">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Project Name</th>
                                        <th scope="col">Start Date</th>
                                        <th scope="col">Due Date</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Assign</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>NobleUI jQuery</td>
                                        <td>01/01/2019</td>
                                        <td>26/04/2019</td>
                                        <td><span class="badge badge-danger">Released</span></td>
                                        <td>Leonardo Payne</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>NobleUI Angular</td>
                                        <td>01/01/2019</td>
                                        <td>26/04/2019</td>
                                        <td><span class="badge badge-success">Review</span></td>
                                        <td>Carl Henson</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>NobleUI ReactJs</td>
                                        <td>01/05/2019</td>
                                        <td>10/09/2019</td>
                                        <td><span class="badge badge-info">Pending</span></td>
                                        <td>Jensen Combs</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>NobleUI VueJs</td>
                                        <td>01/01/2019</td>
                                        <td>31/11/2019</td>
                                        <td><span class="badge badge-warning text-white">Work in Progress</span>
                                        </td>
                                        <td>Amiah Burton</td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>NobleUI Laravel</td>
                                        <td>01/01/2019</td>
                                        <td>31/12/2019</td>
                                        <td><span class="badge badge-danger">Coming soon</span></td>
                                        <td>Yaretzi Mayo</td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>NobleUI NodeJs</td>
                                        <td>01/01/2019</td>
                                        <td>31/12/2019</td>
                                        <td><span class="badge badge-primary">Coming soon</span></td>
                                        <td>Carl Henson</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>NobleUI EmberJs</td>
                                        <td>01/05/2019</td>
                                        <td>10/11/2019</td>
                                        <td><span class="badge badge-info">Pending</span></td>
                                        <td>Jensen Combs</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">User Lists</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <ul class="perfomer-lists m-0 p-0">
                            <li class="d-flex mb-4 align-items-center">
                                <div class="user-img img-fluid"><img src="images/user/01.jpg" alt="story-img"
                                        class="rounded-circle avatar-40"></div>
                                <div class="media-support-info ml-3">
                                    <h6>Paul Molive</h6>
                                    <p class="mb-0 font-size-12">MBBS, MD</p>
                                </div>
                                <div class="iq-card-header-toolbar d-flex align-items-center">
                                    <div class="dropdown">
                                        <span class="dropdown-toggle text-primary" id="dropdownMenuButton41"
                                            data-toggle="dropdown" aria-expanded="false" role="button">
                                            <i class="ri-more-2-line"></i>
                                        </span>
                                        <div class="dropdown-menu dropdown-menu-right" style="">
                                            <a class="dropdown-item" href="#"><i class="ri-eye-line mr-2"></i>View</a>
                                            <a class="dropdown-item" href="#"><i
                                                    class="ri-bookmark-line mr-2"></i>Appointment</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex mb-4 align-items-center">
                                <div class="user-img img-fluid"><img src="images/user/02.jpg" alt="story-img"
                                        class="rounded-circle avatar-40"></div>
                                <div class="media-support-info ml-3">
                                    <h6>Barb Dwyer</h6>
                                    <p class="mb-0 font-size-12">MD</p>
                                </div>
                                <div class="iq-card-header-toolbar d-flex align-items-center">
                                    <div class="dropdown show">
                                        <span class="dropdown-toggle text-primary" id="dropdownMenuButton42"
                                            data-toggle="dropdown" aria-expanded="true" role="button">
                                            <i class="ri-more-2-line"></i>
                                        </span>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#"><i class="ri-eye-line mr-2"></i>View</a>
                                            <a class="dropdown-item" href="#"><i
                                                    class="ri-bookmark-line mr-2"></i>Appointment</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex mb-4 align-items-center">
                                <div class="user-img img-fluid"><img src="images/user/03.jpg" alt="story-img"
                                        class="rounded-circle avatar-40"></div>
                                <div class="media-support-info ml-3">
                                    <h6>Terry Aki</h6>
                                    <p class="mb-0 font-size-12">MBBS</p>
                                </div>
                                <div class="iq-card-header-toolbar d-flex align-items-center">
                                    <div class="dropdown show">
                                        <span class="dropdown-toggle text-primary" id="dropdownMenuButton43"
                                            data-toggle="dropdown" aria-expanded="true" role="button">
                                            <i class="ri-more-2-line"></i>
                                        </span>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#"><i class="ri-eye-line mr-2"></i>View</a>
                                            <a class="dropdown-item" href="#"><i
                                                    class="ri-bookmark-line mr-2"></i>Appointment</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex mb-4 align-items-center">
                                <div class="user-img img-fluid"><img src="images/user/04.jpg" alt="story-img"
                                        class="rounded-circle avatar-40"></div>
                                <div class="media-support-info ml-3">
                                    <h6>Robin Banks</h6>
                                    <p class="mb-0 font-size-12">MBBS, MD</p>
                                </div>
                                <div class="iq-card-header-toolbar d-flex align-items-center">
                                    <div class="dropdown show">
                                        <span class="dropdown-toggle text-primary" id="dropdownMenuButton44"
                                            data-toggle="dropdown" aria-expanded="true" role="button">
                                            <i class="ri-more-2-line"></i>
                                        </span>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#"><i class="ri-eye-line mr-2"></i>View</a>
                                            <a class="dropdown-item" href="#"><i
                                                    class="ri-bookmark-line mr-2"></i>Appointment</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex mb-4 align-items-center">
                                <div class="user-img img-fluid"><img src="images/user/05.jpg" alt="story-img"
                                        class="rounded-circle avatar-40"></div>
                                <div class="media-support-info ml-3">
                                    <h6>Barry Wine</h6>
                                    <p class="mb-0 font-size-12">BAMS</p>
                                </div>
                                <div class="iq-card-header-toolbar d-flex align-items-center">
                                    <div class="dropdown show">
                                        <span class="dropdown-toggle text-primary" id="dropdownMenuButton45"
                                            data-toggle="dropdown" aria-expanded="true" role="button">
                                            <i class="ri-more-2-line"></i>
                                        </span>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#"><i class="ri-eye-line mr-2"></i>View</a>
                                            <a class="dropdown-item" href="#"><i
                                                    class="ri-bookmark-line mr-2"></i>Appointment</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex mb-4 align-items-center">
                                <div class="user-img img-fluid"><img src="images/user/06.jpg" alt="story-img"
                                        class="rounded-circle avatar-40"></div>
                                <div class="media-support-info ml-3">
                                    <h6>Zack Lee</h6>
                                    <p class="mb-0 font-size-12">MS, MD</p>
                                </div>
                                <div class="iq-card-header-toolbar d-flex align-items-center">
                                    <div class="dropdown show">
                                        <span class="dropdown-toggle text-primary" id="dropdownMenuButton46"
                                            data-toggle="dropdown" aria-expanded="true" role="button">
                                            <i class="ri-more-2-line"></i>
                                        </span>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#"><i class="ri-eye-line mr-2"></i>View</a>
                                            <a class="dropdown-item" href="#"><i
                                                    class="ri-bookmark-line mr-2"></i>Appointment</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Recent Tickets</h4>
                        </div>
                        <div class="iq-card-header-toolbar d-flex align-items-center">
                            <div class="dropdown">
                                <span class="dropdown-toggle text-primary" id="dropdownMenuButton-5"
                                    data-toggle="dropdown">
                                    <i class="ri-more-2-fill"></i>
                                </span>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton-5">
                                    <a class="dropdown-item" href="#"><i class="ri-eye-fill mr-2"></i>View</a>
                                    <a class="dropdown-item" href="#"><i
                                            class="ri-delete-bin-6-fill mr-2"></i>Delete</a>
                                    <a class="dropdown-item" href="#"><i class="ri-pencil-fill mr-2"></i>Edit</a>
                                    <a class="dropdown-item" href="#"><i class="ri-printer-fill mr-2"></i>Print</a>
                                    <a class="dropdown-item" href="#"><i
                                            class="ri-file-download-fill mr-2"></i>Download</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="table-responsive">
                            <table class="table mb-0 table-borderless">
                                <thead>
                                    <tr>
                                        <th scope="col">Assignee</th>
                                        <th scope="col">Subject</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Last Update</th>
                                        <th scope="col">Tracking ID</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Paul Molive</td>
                                        <td>Website down for one week</td>
                                        <td>
                                            <div class="badge badge-pill badge-success">Running</div>
                                        </td>
                                        <td>30/12/2019</td>
                                        <td>WD-12586</td>
                                    </tr>
                                    <tr>
                                        <td>Anna Mull</td>
                                        <td>Fund is not recieved</td>
                                        <td>
                                            <div class="badge badge-pill badge-warning text-white">Starting
                                            </div>
                                        </td>
                                        <td>27/12/2019</td>
                                        <td>WD-45869</td>
                                    </tr>
                                    <tr>
                                        <td>Paige Turner</td>
                                        <td>High loading time</td>
                                        <td>
                                            <div class="badge badge-pill badge-danger">Stopped</div>
                                        </td>
                                        <td>21/12/2019</td>
                                        <td>WD-45896</td>
                                    </tr>
                                    <tr>
                                        <td>Bob Frapples</td>
                                        <td>Loosing control on server</td>
                                        <td>
                                            <div class="badge badge-pill badge-info">Maintenance</div>
                                        </td>
                                        <td>20/12/2019</td>
                                        <td>WD-45689</td>
                                    </tr>
                                    <tr>
                                        <td>Barb Ackue</td>
                                        <td>Fund is not recieved</td>
                                        <td>
                                            <div class="badge badge-pill badge-success">Running</div>
                                        </td>
                                        <td>18/12/2019</td>
                                        <td>WD-74569</td>
                                    </tr>
                                    <tr>
                                        <td>Greta Life</td>
                                        <td>Website down for one week</td>
                                        <td>
                                            <div class="badge badge-pill badge-primary">Running</div>
                                        </td>
                                        <td>23/12/2019</td>
                                        <td>WD-25369</td>
                                    </tr>
                                    <tr>
                                        <td>Ira Membrit</td>
                                        <td>Loosing control on server</td>
                                        <td>
                                            <div class="badge badge-pill badge-warning text-white">Starting
                                            </div>
                                        </td>
                                        <td>29/12/2019</td>
                                        <td>WD-45874</td>
                                    </tr>
                                    <tr>
                                        <td>Pete Sariya</td>
                                        <td>High loading time</td>
                                        <td>
                                            <div class="badge badge-pill badge-danger">Stopped</div>
                                        </td>
                                        <td>22/12/2019</td>
                                        <td>WD-56985</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
