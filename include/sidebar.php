<!-- Sidebar -->
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">

        <ul class="nav" id="side-menu">

            <li class="sidebar-search">
                <center><a href="home.php"><img src="icons/pos_logo.png" width="200" height="80"></a></center>
                <hr>
                <div class="input-group custom-search-form">

                    <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                            <button class="btn btn-primary" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                </div>
            </li>

            <li>
                <a href="home.php" class="active"><i class="fa fa-home fa-fw"></i> Dashboard Home</a>
            </li>
            
            <li>
                <a href="main_pos.php"><i class="fa fa-pencil fa-fw"></i> Main POS</a>
            </li>

            
            <?php
            
            if($admin == true)
            {
                
            ?>
            
            <li>
                <a href="#"><i class="fa fa-gears fa-fw"></i> Manage<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    
                    <li>
                        <a href="items.php"><i class="fa fa-arrow-right fa-fw"></i> Items </a>
                    </li>
                    <li>
                        <a href="inventory.php"><i class="fa fa-arrow-right fa-fw"></i> Inventory </a>
                    </li>
                    <li>
                        <a href="categories.php"><i class="fa fa-arrow-right fa-fw"></i> Category </a>
                    </li>
                    <li>
                        <a href="customers.php"><i class="fa fa-users fa-fw"></i> Customer </a>
                    </li>
                    <li>
                        <a href="settings.php"><i class="fa fa-gear fa-fw"></i> Company Setting </a>
                    </li>
                    <li>
                        <a href="settings_printer.php"><i class="fa fa-gear fa-fw"></i> Printer Setting </a>
                    </li>
                    
                </ul>
            </li>
            
            <?php
            }
            
            else if($admin == false)
            {
            ?>
            
            <li>
                <a href="#"><i class="fa fa-gears fa-fw"></i> Manage<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    
                    <li>
                        <a href="items.php"><i class="fa fa-arrow-right fa-fw"></i> Items </a>
                    </li>
                    <li>
                        <a href="inventory.php"><i class="fa fa-arrow-right fa-fw"></i> Inventory </a>
                    </li>
                    <li>
                        <a href="categories.php"><i class="fa fa-arrow-right fa-fw"></i> Category </a>
                    </li>
                    
                    <li>
                        <a href="customers.php"><i class="fa fa-users fa-fw"></i> Customer </a>
                    </li>
                    
                    <li>
                        <a href="login.php"><i class="fa fa-gear fa-fw"></i> Company Setting </a>
                    </li>
                    <li>
                        <a href="login.php"><i class="fa fa-gear fa-fw"></i> Printer Setting </a>
                    </li>
                    
                </ul>
            </li>
            
            <?php
                
            }
            
            ?> 
            
            <?php
            
            if($admin == true)
            {
                
            ?>
            
            <li>
                <a href="#"><i class="fa fa-sticky-note-o fa-fw"></i> Reports<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="sales_report.php"><i class="fa fa-arrow-right fa-fw"></i> Sales Report </a>
                    </li>
<!--
                    <li>
                        <a href="counter-wise-report.php"><i class="fa fa-arrow-right fa-fw"></i> Counter Wise Report </a>
                    </li>
-->
                    <li>
                        <a href="xreport.php"><i class="fa fa-arrow-right fa-fw"></i> X Report </a>
                    </li>
                    <li>
                        <a href="zreport.php"><i class="fa fa-arrow-right fa-fw"></i> Z Report </a>
                    </li>
                </ul>
            </li>
            
            <?php
            }
            
            else if($admin == false)
            {
            ?>
            
            <li>
                <a href="#"><i class="fa fa-sticky-note-o fa-fw"></i> Reports<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="login.php"><i class="fa fa-arrow-right fa-fw"></i> Sales Report </a>
                    </li>
<!--
                    <li>
                        <a href="login.php"><i class="fa fa-arrow-right fa-fw"></i> Counter Wise Report </a>
                    </li>
-->
                    <li>
                        <a href="login.php"><i class="fa fa-arrow-right fa-fw"></i> X Report </a>
                    </li>
                    <li>
                        <a href="login.php"><i class="fa fa-arrow-right fa-fw"></i> Z Report </a>
                    </li>
                </ul>
            </li>
            
            <?php
            }
            ?>       
                      
            <li>
                 <a href="manageinventory.php"><i class="fa fa-users fa-fw"></i> Manage Inventory </a>
            </li>

        </ul>

    </div>
</div>