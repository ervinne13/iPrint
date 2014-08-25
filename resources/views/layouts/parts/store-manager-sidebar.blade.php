<?php
$ownedShopId = Auth::user()->ownedShop->id;
?>
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li><a href="/stores/{{$ownedShopId}}"><span>Manage Store</span></a></li>
            <li><a href="/stores/{{$ownedShopId}}/orders/active"><span>Active Orders</span></a></li>
            <li><a href="/stores/{{$ownedShopId}}/orders"><span>Order History</span></a></li>
            <li><a href="/stores/{{$ownedShopId}}/products"><span>Manage Products</span></a></li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>