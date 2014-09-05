<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li>
                <a href="/users/dashboard">
                    <span><i class="fa fa-user"></i> User Page</span>
                </a>
            </li>
            <li>
                <a href="/users/{{Auth::user()->id}}/changepassword">
                    <span><i class="fa fa-lock"></i> Change Password</span>
                </a>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>