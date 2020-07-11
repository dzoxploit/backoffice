<!-- Sidebar  -->
<div class="iq-sidebar">
    <div class="iq-sidebar-logo d-flex justify-content-between dm-sidebar-logo">
        <a href="index.html">
            <img src=" {{ url('/assets/images/dmlogoonly.png') }}" class="img-fluid" alt="">
        </a>
        <div class="iq-menu-bt align-self-center">
            <div class="wrapper-menu">
                <div class="line-menu half start"></div>
                <div class="line-menu"></div>
                <div class="line-menu half end"></div>
            </div>
        </div>
    </div>
    <div id="sidebar-scrollbar">
        <nav class="iq-sidebar-menu">
            <ul id="iq-sidebar-toggle" class="iq-menu">
                <li class="iq-menu-title"><i class="ri-separator"></i><span>Main</span></li>
                <li>
                    <a href="{{ url('/') }}" class="iq-waves-effect"><i
                            class="las la-user-tie"></i><span>Dashboard</span></a>
                </li>
                <li>
                    <a href="{{ url('/roles') }}" class="iq-waves-effect"><i
                            class="las la-user-tie"></i><span>Roles</span> <span data-placement="top" data-toggle="tooltip" title=""
                            data-original-title="Halaman ini dapat di demokan" class="dm-dev-notif bg-success">Demo</span></a>
                </li>
                <li>
                    <a href="{{ url('/users') }}" class="iq-waves-effect"><i
                            class="las la-user-tie"></i><span>Users</span> <span data-placement="top" data-toggle="tooltip" title=""
                            data-original-title="Halaman ini dapat di demokan" class="dm-dev-notif bg-success">Demo</span></a>
                </li>
                <li>
                    <a href="{{ url('suppliers') }}" class="iq-waves-effect"><i
                            class="las la-user-tie"></i><span>Suppliers</span> <span data-placement="top" data-toggle="tooltip" title=""
                            data-original-title="Halaman ini dapat di demokan" class="dm-dev-notif bg-success">Demo</span></a>
                </li>
                <li>
                    <a href="#purchase" class="iq-waves-effect collapsed" data-toggle="collapse"
                        aria-expanded="false"><i class="las la-envelope-open"></i><span>Purchase</span><i
                            class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                    <ul id="purchase" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                        <li><a href="{{ url('/purchaseorders') }}">Purchase Order <span data-placement="top" data-toggle="tooltip" title=""
                            data-original-title="Halaman ini dapat di demokan" class="dm-dev-notif bg-success">Demo</span></a></li></a></li>
                        <li><a href="{{ url('invoices') }}">Invoice <span data-placement="top" data-toggle="tooltip" title=""
                            data-original-title="Mohon Maaf, Halaman ini sedang dalam pengembangan" class="dm-dev-notif">Dev</span></a></li>
                        <li><a href="{{ url('/deliveryorders') }}">Delivery Orders <span data-placement="top" data-toggle="tooltip" title=""
                            data-original-title="Mohon Maaf, Halaman ini sedang dalam pengembangan" class="dm-dev-notif">Dev</span></a></li>
                    </ul>
                </li>
                <li>
                    <a href="#sell" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false"><i
                            class="las la-envelope-open"></i><span>Sale</span><i
                            class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                    <ul id="sell" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                        <li><a href="{{ url('/couriers') }}">Couriers <span data-placement="top" data-toggle="tooltip" title=""
                            data-original-title="Halaman ini dapat di demokan" class="dm-dev-notif bg-success">Demo</span></a></li>
                        <li><a href="{{ url('/sales/customers') }}">Customer  <span data-placement="top" data-toggle="tooltip" title=""
                            data-original-title="Halaman ini dapat di demokan" class="dm-dev-notif bg-success">Demo</span></a></li>
                        <li><a href="{{ url('/sales/bargains') }}">Penawaran <span data-placement="top" data-toggle="tooltip" title=""
                            data-original-title="Halaman ini dapat di demokan" class="dm-dev-notif bg-success">Demo</span></a></li>
                        <li><a href="{{ url('/sales/purchaseorders') }}">Purchase Orders <span data-placement="top" data-toggle="tooltip" title=""
                            data-original-title="Halaman ini dapat di demokan" class="dm-dev-notif bg-success">Demo</span></a></li>
                        
                    </ul>
                </li>
            </ul>
            </li>
            </ul>
        </nav>
        <div class="p-3"></div>
    </div>
</div>
