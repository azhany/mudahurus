      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="<?php echo ($this->uri->segment(1) == 'dashboard') ? 'active ' : '';?>treeview">
              <a href="<?php echo base_url()?>dashboard">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
            </li>
            <li class="<?php echo ($this->uri->segment(1) == 'products' || $this->uri->segment(1) == 'category') ? 'active ' : '';?>treeview">
              <a href="#">
                <i class="fa fa-tags"></i>
                <span>Products</span>
                <?php /*<span class="label label-primary pull-right">4</span>*/ ?>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="<?php echo ($this->uri->segment(1) == 'products') ? 'active ' : '';?>"><a href="<?php echo base_url()?>products"><i class="fa fa-circle-o"></i> Products</a></li>
                <li class="<?php echo ($this->uri->segment(1) == 'category') ? 'active ' : '';?>"><a href="<?php echo base_url()?>category"><i class="fa fa-circle-o"></i> Product Category</a></li>
                <?php /*<li><a href="pages/layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
                <li><a href="pages/layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>*/ ?>
              </ul>
            </li>
            <?php /*<li class="<?php echo ($this->uri->segment(1) == 'coupons') ? 'active ' : '';?>treeview">
              <a href="<?php echo base_url()?>coupons">
                <i class="fa fa-files-o"></i>
                <span>Coupons</span>
                <span class="label label-primary pull-right">4</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
            </li>*/ ?>
            <li class="<?php echo ($this->uri->segment(1) == 'orders') ? 'active ' : '';?>treeview">
              <a href="<?php echo base_url()?>orders">
                <i class="fa fa-shopping-cart"></i>
                <span>Orders</span>
                <?php /*<span class="label label-primary pull-right">4</span>
                <i class="fa fa-angle-left pull-right"></i*/ ?>
              </a>
              <?php /*<ul class="treeview-menu">
                <li><a href="pages/layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
                <li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
                <li><a href="pages/layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
                <li><a href="pages/layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
              </ul>*/?>
            </li>
            <li class="<?php echo ($this->uri->segment(1) == 'customers') ? 'active ' : '';?>treeview">
              <a href="<?php echo base_url()?>customers">
                <i class="fa fa-users"></i>
                <span>Customers</span>
                <?php /*<span class="label label-primary pull-right">4</span>
                <i class="fa fa-angle-left pull-right"></i>*/ ?>
              </a>
              <?php /*<ul class="treeview-menu">
                <li><a href="pages/layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
                <li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
                <li><a href="pages/layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
                <li><a href="pages/layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
              </ul>*/ ?>
            </li>
            
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>