<ul id="side-menu">

    <li class="menu-title">Admin</li>

    <li>
        <a href="#sidebarSettings" data-bs-toggle="collapse">
            <i data-feather="settings"></i>
{{--            <span class="badge bg-success rounded-pill float-end">4</span>--}}
{{--            <span class="badge bg-pink float-end">Hot</span>--}}
            <span> Settings </span>
            <span class="menu-arrow"></span>
        </a>
        <div class="collapse" id="sidebarSettings">
            <ul class="nav-second-level">
                <li>
                    <a href="-"><i class="fa fa-fw fa-angle-right"></i> Global</a>
                </li>
                <li>
                    <a href="{{ route('lookup.index') }}"><i class="fa fa-fw fa-angle-right"></i> Lookups</a>
                </li>
                <li>
                    <a href="-"><i class="fa fa-fw fa-angle-right"></i> Site Mode</a>
                </li>
            </ul>
        </div>
    </li>

    <li>
        <a href="{{ url('translations') }}">
            <i data-feather="calendar"></i>
            <span> Translation </span>
        </a>
    </li>

    <li class="menu-title mt-2">Main</li>

    <li>
        <a href="{{ route('media.index') }}">
            <i data-feather="folder-plus"></i>
            <span> Media </span>
        </a>
    </li>

    <li>
        <a href="{{ route('page.index') }}">
            <i data-feather="layout"></i>
            <span> Pages </span>
        </a>
    </li>

    <li>
        <a href="#sidebar_partials" data-bs-toggle="collapse">
            <i data-feather="mail"></i>
            <span> Partials </span>
            <span class="menu-arrow"></span>
        </a>
        <div class="collapse" id="sidebar_partials">
            <ul class="nav-second-level">
                <li>
                    <a href="-"><i class="fa fa-fw fa-angle-right"></i> Slider</a>
                </li>
                <li>
                    <a href="-"><i class="fa fa-fw fa-angle-right"></i> Social Accounts</a>
                </li>
                <li>
                    <a href="-"><i class="fa fa-fw fa-angle-right"></i> Testimonials</a>
                </li>
                <li>
                    <a href="-"><i class="fa fa-fw fa-angle-right"></i> Call To Action</a>
                </li>
            </ul>
        </div>
    </li>

    <li>
        <a href="#sidebar_resources" data-bs-toggle="collapse">
            <i data-feather="mail"></i>
            <span> Resources </span>
            <span class="menu-arrow"></span>
        </a>
        <div class="collapse" id="sidebar_resources">
            <ul class="nav-second-level">
                <li>
                    <a href="-"><i class="fa fa-fw fa-angle-right"></i> Categories</a>
                </li>
                <li>
                    <a href="-"><i class="fa fa-fw fa-angle-right"></i> Products</a>
                </li>
                <li>
                    <a href="-"><i class="fa fa-fw fa-angle-right"></i> Services</a>
                </li>
                <li>
                    <a href="-"><i class="fa fa-fw fa-angle-right"></i> Brands</a>
                </li>
                <li>
                    <a href="-"><i class="fa fa-fw fa-angle-right"></i> Clients</a>
                </li>
                <li>
                    <a href="-"><i class="fa fa-fw fa-angle-right"></i> Partners</a>
                </li>
            </ul>
        </div>
    </li>

    <li>
        <a href="#sidebar_activities" data-bs-toggle="collapse">
            <i data-feather="mail"></i>
            <span> Activities </span>
            <span class="menu-arrow"></span>
        </a>
        <div class="collapse" id="sidebar_activities">
            <ul class="nav-second-level">
                <li>
                    <a href="-"><i class="fa fa-fw fa-angle-right"></i> Offers</a>
                </li>
                <li>
                    <a href="-"><i class="fa fa-fw fa-angle-right"></i> News</a>
                </li>
                <li>
                    <a href="-"><i class="fa fa-fw fa-angle-right"></i> Blogs</a>
                </li>
            </ul>
        </div>
    </li>

    <li class="menu-title mt-2">Contacts</li>

    <li>
        <a href="-">
            <i data-feather="calendar"></i>
            <span> Branches </span>
        </a>
    </li>

    <li>
        <a href="-">
            <i data-feather="calendar"></i>
            <span> Messages </span>
        </a>
    </li>

    <li>
        <a href="-">
            <i data-feather="calendar"></i>
            <span> Quotations </span>
        </a>
    </li>

    <li class="menu-title mt-2">Careers</li>

    <li>
        <a href="-">
            <i data-feather="calendar"></i>
            <span> Jobs </span>
        </a>
    </li>

    <li>
        <a href="-">
            <i data-feather="calendar"></i>
            <span> Applicants </span>
        </a>
    </li>


</ul>
