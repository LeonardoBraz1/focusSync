 <!-- Preloader Start -->
 <div id="preloader-active">
   <div class="preloader d-flex align-items-center justify-content-center">
     <div class="preloader-inner position-relative">
       <div class="preloader-circle"></div>
       <div class="preloader-img pere-text">
         <img src="../../assets/images/logo-login.png" alt="">
       </div>
     </div>
   </div>
 </div>

 <header class="app-header"><a class="app-header__logo" href="../dashboard/dashboard.php"></a>
   <!-- Sidebar toggle button-->
   <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
   <!-- Navbar Right Menu-->
   <ul class="app-nav" style="display: flex; justify-content: end; align-items: center; gap: 20px;">
     <li class="dropdown">
       <a class="nav-link app-nav__item me-3 me-lg-0 dropdown-toggle hidden-arrow" href="#" id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
       <i class="fa fa-bell-o fa-lg" style="color: #fff;"></i>
         <span class="badge rounded-pill badge-notification bg-danger">1</span>
       </a>
       <ul class="app-notification dropdown-menu dropdown-menu-right" style="width: 80%;">
         <li class="app-notification__title">You have 4 new notifications.</li>
         <div class="app-notification__content">
           <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-envelope fa-stack-1x fa-inverse"></i></span></span>
               <div>
                 <p class="app-notification__message">Lisa sent you a mail</p>
                 <p class="app-notification__meta">2 min ago</p>
               </div>
             </a></li>
           <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-danger"></i><i class="fa fa-hdd-o fa-stack-1x fa-inverse"></i></span></span>
               <div>
                 <p class="app-notification__message">Mail server not working</p>
                 <p class="app-notification__meta">5 min ago</p>
               </div>
             </a></li>
           <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-success"></i><i class="fa fa-money fa-stack-1x fa-inverse"></i></span></span>
               <div>
                 <p class="app-notification__message">Transaction complete</p>
                 <p class="app-notification__meta">2 days ago</p>
               </div>
             </a></li>
           <div class="app-notification__content">
             <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-envelope fa-stack-1x fa-inverse"></i></span></span>
                 <div>
                   <p class="app-notification__message">Lisa sent you a mail</p>
                   <p class="app-notification__meta">2 min ago</p>
                 </div>
               </a></li>
             <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-danger"></i><i class="fa fa-hdd-o fa-stack-1x fa-inverse"></i></span></span>
                 <div>
                   <p class="app-notification__message">Mail server not working</p>
                   <p class="app-notification__meta">5 min ago</p>
                 </div>
               </a></li>
             <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-success"></i><i class="fa fa-money fa-stack-1x fa-inverse"></i></span></span>
                 <div>
                   <p class="app-notification__message">Transaction complete</p>
                   <p class="app-notification__meta">2 days ago</p>
                 </div>
               </a></li>
           </div>
         </div>
         <li class="app-notification__footer"><a href="#">Ver todas as notificações.</a></li>
       </ul>
     </li>

     <li class="dropdown">
       <a class="nav-link app-nav__item me-3 me-lg-0 dropdown-toggle hidden-arrow" href="#" id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
         <i class="fa fa-user fa-lg" style="color: #fff;"></i>
         <span class="badge rounded-pill badge-notification bg-danger">1</span>
       </a>
       <ul class="dropdown-menu settings-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink" style="margin-top: 210px;">
         <li><a class="dropdown-item" href="../views/page-user.php"><i class="fa fa-cog fa-lg"></i> Settings</a></li>
         <li><a class="dropdown-item" href="../views/page-user.php"><i class="fa fa-user fa-lg"></i> Profile</a></li>
         <li><a class="dropdown-item" href="../../controllers/logout.php"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
       </ul>
     </li>

   </ul>
 </header>