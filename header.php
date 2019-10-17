<!DOCTYPE html>
<html class="loading" lang="en-US" data-textdirection="ltr">
  <!-- BEGIN: Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google.">
    <meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template, eCommerce dashboard, analytic dashboard">
    <meta name="author" content="ThemeSelect">
    <title>Laundry App</title>
    <link rel="apple-touch-icon" href="../../../app-assets/images/favicon/apple-touch-icon-152x152.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/favicon/favicon-32x32.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="css/animate.css">
    <link rel="stylesheet" type="text/css" href="css/chartist.min.css">
    <link rel="stylesheet" type="text/css" href="css/chartist-plugin-tooltip.css">
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
	    <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="css/responsive.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="css/select.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="css/materialize.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/dashboard-modern.css">

	    <link rel="stylesheet" type="text/css" href="css/data-tables.css">
    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="css/custom.css">
	 <link rel="stylesheet" type="text/css" href="css/keyboard.css">
    <!-- END: Custom CSS-->
	<style>
.height_class
{
	height:300px;
}
</style>
<script src="js/jquery-1.12.4.min.js"></script>
  </head>
  <!-- END: Head-->
  <body class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu 2-columns  " data-open="click" data-menu="vertical-modern-menu" data-col="2-columns">
  

    <!-- BEGIN: Header-->
    <header class="page-topbar" id="header">
      <div class="navbar navbar-fixed"> 
        <nav class="navbar-main navbar-color nav-collapsible sideNav-lock navbar-dark gradient-45deg-indigo-purple no-shadow">
          <div class="nav-wrapper">
            <div class="header-search-wrapper hide-on-med-and-down"><i class="material-icons">search</i>
              <input class="header-search-input z-depth-2" type="text" name="Search" placeholder="Search Here">
            </div>
            <ul class="navbar-list right">
              <li class="hide-on-med-and-down"><a class="waves-effect waves-block waves-light translation-button" href="javascript:void(0);" data-target="translation-dropdown"><span class="flag-icon flag-icon-gb"></span></a></li>
              <li class="hide-on-med-and-down"><a class="waves-effect waves-block waves-light toggle-fullscreen" href="javascript:void(0);"><i class="material-icons">settings_overscan</i></a></li>
              <li class="hide-on-large-only"><a class="waves-effect waves-block waves-light search-button" href="javascript:void(0);"><i class="material-icons">search</i></a></li>
              <li><a class="waves-effect waves-block waves-light notification-button" href="javascript:void(0);" data-target="notifications-dropdown"><i class="material-icons">notifications_none<small class="notification-badge">5</small></i></a></li>
              <li><a class="waves-effect waves-block waves-light profile-button" href="javascript:void(0);" data-target="profile-dropdown"><span class="avatar-status avatar-online"><img src="images/cmpny.png" alt="avatar"><i></i></span></a></li>
              
            </ul>
            <!-- translation-button-->
            <ul class="dropdown-content" id="translation-dropdown">
              <li><a class="grey-text text-darken-1" href="#!"><i class="flag-icon flag-icon-gb"></i> English</a></li>
              <li><a class="grey-text text-darken-1" href="#!"><i class="flag-icon flag-icon-fr"></i> French</a></li>
              <li><a class="grey-text text-darken-1" href="#!"><i class="flag-icon flag-icon-cn"></i> Chinese</a></li>
              <li><a class="grey-text text-darken-1" href="#!"><i class="flag-icon flag-icon-de"></i> German</a></li>
            </ul>
            <!-- notifications-dropdown-->
            <ul class="dropdown-content" id="notifications-dropdown">
              <li>
                <h6>NOTIFICATIONS<span class="new badge">5</span></h6>
              </li>
             <!-- <li class="divider"></li>
              <li><a class="grey-text text-darken-2" href="#!"><span class="material-icons icon-bg-circle cyan small">add_shopping_cart</span> A new order has been placed!</a>
                <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">2 hours ago</time>
              </li>
              <li><a class="grey-text text-darken-2" href="#!"><span class="material-icons icon-bg-circle red small">stars</span> Completed the task</a>
                <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">3 days ago</time>
              </li>
              <li><a class="grey-text text-darken-2" href="#!"><span class="material-icons icon-bg-circle teal small">settings</span> Settings updated</a>
                <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">4 days ago</time>
              </li>
              <li><a class="grey-text text-darken-2" href="#!"><span class="material-icons icon-bg-circle deep-orange small">today</span> Director meeting started</a>
                <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">6 days ago</time>
              </li>
              <li><a class="grey-text text-darken-2" href="#!"><span class="material-icons icon-bg-circle amber small">trending_up</span> Generate monthly report</a>
                <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">1 week ago</time>
              </li>-->
            </ul>
            <!-- profile-dropdown-->
            <ul class="dropdown-content" id="profile-dropdown">
              <li><a class="grey-text text-darken-1" href="user-profile-page.html"><i class="material-icons">person_outline</i> Profile</a></li>
              <li><a class="grey-text text-darken-1" href="app-chat.html"><i class="material-icons">chat_bubble_outline</i> Chat</a></li>
              <li><a class="grey-text text-darken-1" href="page-faq.html"><i class="material-icons">help_outline</i> Help</a></li>
              <li class="divider"></li>
              <li><a class="grey-text text-darken-1" href="user-lock-screen.html"><i class="material-icons">lock_outline</i> Lock</a></li>
              <li><a class="grey-text text-darken-1" href="user-login.html"><i class="material-icons">keyboard_tab</i> Logout</a></li>
            </ul>
          </div>
          <nav class="display-none search-sm">
            <div class="nav-wrapper">
              <form>
                <div class="input-field">
                  <input class="search-box-sm" type="search" required="">
                  <label class="label-icon" for="search"><i class="material-icons search-sm-icon">search</i></label><i class="material-icons search-sm-close">close</i>
                </div>
              </form>
            </div>
          </nav>
        </nav>
      </div>
    </header>
    <!-- END: Header-->



    <!-- BEGIN: SideNav-->
    <aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-light sidenav-active-square">
      <div class="brand-sidebar">
        <h1 class="logo-wrapper">
		<a class="brand-logo darken-1" href="index.php">
		<img src="images/main_logo.png" class="main_logo" alt="logo"/>
		<span class="logo-text hide-on-med-and-down"></span>
		</a>
		<a class="navbar-toggler" href="#"><i class="material-icons">radio_button_checked</i></a>
		</h1>
      </div>
      <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">
	   <li class="bold"><a class="waves-effect waves-cyan " href="dashboard.php"><i class="material-icons">settings_input_svideo</i><span class="menu-title" data-i18n="">Dashboard</span></a>
        </li>
        <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">add_shopping_cart</i><span class="menu-title" data-i18n="">Configuration</span></a>
          <div class="collapsible-body">
            <ul class="collapsible collapsible-sub" data-collapsible="accordion">
              <li><a class="collapsible-body" href="area-config.php" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Region Configuration</span></a>
              </li>
			       <li><a class="collapsible-body" href="region-view.php" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>View Region</span></a>
              </li>
              <li><a class="collapsible-body" href="add-product.php" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Product Configuration</span></a>
              </li>
			  <li><a class="collapsible-body" href="product-view.php" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>View Product</span></a>
              </li>
			  <li><a class="collapsible-body" href="add-pricing.php" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Pricing Configuration</span></a>
              </li>
			  <li><a class="collapsible-body" href="pricing-view.php" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>View Pricing</span></a>
              </li>
			  <li><a class="collapsible-body" href="add-staff.php" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Staff Configuration</span></a>
              </li>
			  <li><a class="collapsible-body" href="staff-view.php" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>View Staff</span></a>
              </li>
			  <!--<li><a class="collapsible-body" href="add-images.php" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Images Config</span></a>
              </li>
			  <li><a class="collapsible-body" href="images-view.php" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>View Images</span></a>
              </li>-->
              <li><a class="collapsible-body" href="add-percentage.php" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Percentage Configuration</span></a>
              </li>
			  <li><a class="collapsible-body" href="percentage-view.php" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>View Percentage</span></a>
              </li>
            </ul>
          </div>
        </li>
		 <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">add_shopping_cart</i><span class="menu-title" data-i18n="">Customers</span></a>
          <div class="collapsible-body">
            <ul class="collapsible collapsible-sub" data-collapsible="accordion">
              <li><a class="collapsible-body" href="add-customer.php" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Add Customer</span></a>
              </li>
              <li><a class="collapsible-body" href="customer-view.php" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>View</span></a>
              </li>
            
            </ul>
          </div>
        </li>
       
       <!-- <li class="navigation-header"><a class="navigation-header-text">Pages </a><i class="navigation-header-icon material-icons">more_horiz</i>
        </li>-->
       
      
        <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">face</i><span class="menu-title" data-i18n="">Orders</span><span class="badge badge pill purple float-right mr-10">10</span></a>
          <div class="collapsible-body">
            <ul class="collapsible collapsible-sub" data-collapsible="accordion">
              <li><a class="collapsible-body" href="new-order.php" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>New Order</span></a>
              </li>
              <!--<li><a class="collapsible-body" href="user-login.html" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Pending Orders</span></a>
              </li>-->
              <li><a class="collapsible-body" href="order-view.php" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>View</span></a>
              </li>
         
            </ul>
          </div>
        </li>
    
        <!--<li class="bold"><a class="waves-effect waves-cyan " href="#"><i class="material-icons">check</i><span class="menu-title" data-i18n="">Delivery</span></a>
        </li> -->      
        <li class="bold"><a class="waves-effect waves-cyan " href="invoice1.php"><i class="material-icons">today</i><span class="menu-title" data-i18n="">Invoice</span></a>
        </li>
		  <li class="bold"><a class="waves-effect waves-cyan " href="add-expenses.php"><i class="material-icons">today</i><span class="menu-title" data-i18n="">Expenses</span></a>
        </li>
		 <li class="bold"><a class="waves-effect waves-cyan " href="expense-view.php"><i class="material-icons">today</i><span class="menu-title" data-i18n="">View Expenses</span></a>
        </li>
		 <li class="bold"><a class="waves-effect waves-cyan " href="#!"><i class="material-icons">import_contacts</i><span class="menu-title" data-i18n="">Settings</span></a>
        </li>
       
       

      </ul>
      <div class="navigation-background"></div><a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only" href="#" data-target="slide-out"><i class="material-icons">menu</i></a>
    </aside>
    <!-- END: SideNav-->

    <!-- BEGIN: Page Main-->
    <div id="main">
      <div class="row">
       
        <div class="col s12">
          <div class="container">