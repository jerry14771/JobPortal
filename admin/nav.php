<nav id="topnav" class="defaultscroll is-sticky" style=";">


            <div class="container">
            <a class="logo" href="index.php">
            <div class="block sm:hidden">
                <img src="assets/logo/Pixel_Apply_new.png" class="inline-block dark:hidden" style="height:30px" alt="">
            </div>
            <div class="sm:block hidden">
                <img src="assets/logo/Pixel_Apply_new.png" class="inline-block dark:hidden" style="height: 35px;"
                    alt="">
            </div>
        </a>
                <!-- End Logo container-->

                <!-- Start Mobile Toggle -->
                <div class="menu-extras">
                    <div class="menu-item">
                        <a class="navbar-toggle" id="isToggle" onclick="toggleMenu()">
                            <div class="lines">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- End Mobile Toggle -->

                <!--Login button Start-->
                <ul class="buy-button list-none mb-0">
                    <li class="dropdown inline-block relative ps-1">
                        <button data-dropdown-toggle="dropdown" class="dropdown-toggle items-center" type="button">
                            <span class="size-9 inline-flex items-center text-center justify-center text-base font-semibold tracking-wide border align-middle transition duration-500 ease-in-out rounded-full bg-emerald-600 hover:bg-emerald-700 border-emerald-600 hover:border-emerald-700 text-white"><img src="assets/images/team/01.jpg" class="rounded-full" alt=""></span>
                        </button>
                        <div class="dropdown-menu absolute end-0 m-0 mt-4 z-10 w-44 rounded-md overflow-hidden bg-white dark:bg-slate-900 shadow-sm dark:shadow-gray-700 hidden" onclick="event.stopPropagation();">
                            <ul class="py-2 text-start">
                                <li>
                                    <a href="logout.php" class="flex items-center font-medium py-2 px-4 dark:text-white/70 hover:text-emerald-600 dark:hover:text-white"><i data-feather="log-out" class="size-4 me-2"></i>Logout</a>
                                </li>
                            </ul>
                        </div>
                    </li><!--end dropdown-->
                </ul>
                <!--Login button End-->

                <div id="navigation">
                    <!-- Navigation Menu-->   
                    <ul class="navigation-menu nav-right !justify-end">
                        <li class="has-submenu parent-menu-item">
                            <a href="index.php" style="color:black">Home</a>
                        </li>

                        <li class="has-submenu parent-parent-menu-item"><a href="job-post.php" style="color:black"> Post Jobs </a>
                            
                        </li>
                
                       
                
                        <li><a href="contact.html" class="sub-menu-item" style="color:black" >Contact</a></li>
                    </ul><!--end navigation menu-->
                </div><!--end navigation-->
            </div><!--end container-->
        </nav>