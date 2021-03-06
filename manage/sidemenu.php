        <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome</span>
                <h2><?php echo $username;?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

          <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <?php
                  if($usertype == 'superadmin'){
                    $display = "";
                  }
                  elseif($usertype == 'admin'){
                    $display = "none";
                  }
                  elseif($usertype == "Supervisor")
                    { $display = "none"; }?>
                  <li style="display: <?php echo $display;?>"><a href="admin.php"><i class="fa fa-home"></i> Admin <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                     <!--  <li><a href="admin.php">Admin</a></li> -->
                     <!--  <li><a href="index2.html">Dashboard2</a></li>
                      <li><a href="index3.html">Dashboard3</a></li> -->
                    </ul>
                  </li> 
                  <?php
                  if($usertype == 'admin'){
                    $disp = "";
                  }
                  else{
                    $disp = "none";
                  }
                  ?>
                  <li style="display: <?php echo $disp;?>"><a href="restaurant.php"><i class="fa fa-home"></i> Restaurant <span class="fa fa-chevron-down"></span></a>

                   <!--  <ul class="nav child_menu">
                      <li><a href="cashierslist.php">Cashiers</a></li>
                      <li><a href="cheflist.php">Chefs</a></li>
                      <li><a href="waiterlist.php">Waiters</a></li>
                    </ul> -->
                  </li>
                  <li style="display: <?php echo $disp;?>"><a href="notification.php"><i class="fa fa-home"></i> Send Notification  <span class="fa fa-chevron-down"></span></a>
                  
                   <!--  <ul class="nav child_menu">
                      <li><a href="cashierslist.php">Cashiers</a></li>
                      <li><a href="cheflist.php">Chefs</a></li>
                      <li><a href="waiterlist.php">Waiters</a></li>
                    </ul> -->
                  </li>
                   <!-- <li style="display: <?php// echo $display;?>"> --><li><a href="stafflist.php"><i class="fa fa-home"></i> Restaurant Staff <span class="fa fa-chevron-down"></span></a>
                   <!--  <ul class="nav child_menu">
                      <li><a href="cashierslist.php">Cashiers</a></li>
                      <li><a href="cheflist.php">Chefs</a></li>
                      <li><a href="waiterlist.php">Waiters</a></li>
                    </ul> -->
                  </li>
                  
                  <?php
                  if($usertype == 'superadmin'){
                    $disp = "none";
                  }
                  else{
                    $disp = "";
                  }
                  ?>
                  <li style="display: <?php echo $disp;?>"><a href="restaurant_menu.php"><i class="fa fa-home"></i> Restaurant Menu <span class="fa fa-chevron-down"></span></a>
                   <!--  <ul class="nav child_menu">
                      <li><a href="cashierslist.php">Cashiers</a></li>
                      <li><a href="cheflist.php">Chefs</a></li>
                      <li><a href="waiterlist.php">Waiters</a></li>
                    </ul> -->
                  </li>
                   <li style="display: <?php echo $disp;?>"><a href="Item_category_list.php"><i class="fa fa-home"></i>Item Category <span class="fa fa-chevron-down"></span></a>
                   <!--  <ul class="nav child_menu">
                      <li><a href="cashierslist.php">Cashiers</a></li>
                      <li><a href="cheflist.php">Chefs</a></li>
                      <li><a href="waiterlist.php">Waiters</a></li>
                    </ul> -->
                  </li>
                  <!-- <li><a><i class="fa fa-edit"></i> Forms <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="form.html">General Form</a></li>
                      <li><a href="form_advanced.html">Advanced Components</a></li>
                      <li><a href="form_validation.html">Form Validation</a></li>
                      <li><a href="form_wizards.html">Form Wizard</a></li>
                      <li><a href="form_upload.html">Form Upload</a></li>
                      <li><a href="form_buttons.html">Form Buttons</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-desktop"></i> UI Elements <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="general_elements.html">General Elements</a></li>
                      <li><a href="media_gallery.html">Media Gallery</a></li>
                      <li><a href="typography.html">Typography</a></li>
                      <li><a href="icons.html">Icons</a></li>
                      <li><a href="glyphicons.html">Glyphicons</a></li>
                      <li><a href="widgets.html">Widgets</a></li>
                      <li><a href="invoice.html">Invoice</a></li>
                      <li><a href="inbox.html">Inbox</a></li>
                      <li><a href="calendar.html">Calendar</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-table"></i> Tables <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="tables.html">Tables</a></li>
                      <li><a href="tables_dynamic.html">Table Dynamic</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-bar-chart-o"></i> Data Presentation <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="chartjs.html">Chart JS</a></li>
                      <li><a href="chartjs2.html">Chart JS2</a></li>
                      <li><a href="morisjs.html">Moris JS</a></li>
                      <li><a href="echarts.html">ECharts</a></li>
                      <li><a href="other_charts.html">Other Charts</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-clone"></i>Layouts <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="fixed_sidebar.html">Fixed Sidebar</a></li>
                      <li><a href="fixed_footer.html">Fixed Footer</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
              <div class="menu_section">
                <h3>Live On</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-bug"></i> Additional Pages <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="e_commerce.html">E-commerce</a></li>
                      <li><a href="projects.html">Projects</a></li>
                      <li><a href="project_detail.html">Project Detail</a></li>
                      <li><a href="contacts.html">Contacts</a></li>
                      <li><a href="profile.html">Profile</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-windows"></i> Extras <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="page_403.html">403 Error</a></li>
                      <li><a href="page_404.html">404 Error</a></li>
                      <li><a href="page_500.html">500 Error</a></li>
                      <li><a href="plain_page.html">Plain Page</a></li>
                      <li><a href="login.php">Login Page</a></li>
                      <li><a href="pricing_tables.html">Pricing Tables</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-sitemap"></i> Multilevel Menu <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="#level1_1">Level One</a>
                        <li><a>Level One<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li class="sub_menu"><a href="level2.html">Level Two</a>
                            </li>
                            <li><a href="#level2_1">Level Two</a>
                            </li>
                            <li><a href="#level2_2">Level Two</a>
                            </li>
                          </ul>
                        </li>
                        <li><a href="#level1_2">Level One</a>
                        </li>
                    </ul>
                  </li>                  
                  <li><a href="javascript:void(0)"><i class="fa fa-laptop"></i> Landing Page <span class="label label-success pull-right">Coming Soon</span></a></li> -->
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->
