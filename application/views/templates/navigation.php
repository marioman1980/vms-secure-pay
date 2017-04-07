	<!--Navigation-->
		<nav id="nav_container" class="w3-top" style="padding-right: 20px">
			<ul class="w3-navbar">
				<span class="nav_float">
					<li class="w3-hide-medium w3-hide-large w3-white w3-opennav w3-right">
						<a id="hamburger_link" class="click_away w3-padding-12" href="javascript:void(0);" onclick="myFunction()">
						<div id="css_hamburger"></div>
						</a>
					</li>
					<span id="full_links">
            <li id="" class="w3-hide-small"><a class="w3-padding-10" href="<?php echo site_url('user_home'); ?>">Home</a></li>
            <li class="w3-hide-small">
              <span class="w3-dropdown-hover" style="background-color: #ffffff">
                <a class="w3-padding-10">Customers</a>
                <span class="w3-dropdown-content w3-bar-block w3-border">
                  <a href="<?php echo site_url('add_customer'); ?>" class="w3-bar-item w3-button">Add/Edit</a>
                  <a href="<?php echo site_url('display_customers'); ?>" class="w3-bar-item w3-button">View all</a>
                  <a href="#" class="w3-bar-item w3-button">Link 3</a> 
                </span>
              </span>
            </li>
            <li class="w3-hide-small">
              <span class="w3-dropdown-hover" style="background-color: #ffffff">
                <a class="w3-padding-10">Payments</a>
                <span class="w3-dropdown-content w3-bar-block w3-border">
                  <a href="<?php echo site_url('main'); ?>" class="w3-bar-item w3-button">Request Payment</a>
                  <a href="<?php echo site_url('display_payments'); ?>" class="w3-bar-item w3-button">View all</a>
                  <a href="#" class="w3-bar-item w3-button">Link 3</a> 
                </span>
              </span>
            </li>            
						<li id="" class="w3-hide-small"><a class="w3-padding-10" href="<?php echo site_url('login/logout'); ?>">Logout</a></li>
					</span>
				</span>
			</ul>
			<!--Collapsed Navigation - Hidden on larger screens-->
			<div id="collapsed_nav" class="w3-hide w3-hide-large w3-hide-medium">
				<ul class="w3-navbar w3-white w3-left-align w3-large">
					<span id="collapsed_links">
            <li><a class="w3-padding-10" href="<?php echo site_url('user_home'); ?>">Home</a></li>
            <li>
              <span class="w3-dropdown-hover" style="background-color: #ffffff">
                <a class="w3-padding-10">Customers</a>
                <span class="w3-dropdown-content w3-bar-block w3-border">
                  <a href="<?php echo site_url('add_customer'); ?>" class="w3-bar-item w3-button">Add/Edit</a>
                  <a href="<?php echo site_url('display_customers'); ?>" class="w3-bar-item w3-button">View all</a>
                  <a href="#" class="w3-bar-item w3-button">Link 3</a> 
                </span>
              </span>
            </li>            
            <li>
              <span class="w3-dropdown-hover" style="background-color: #ffffff">
                <a class="w3-padding-10">Payments</a>
                <span class="w3-dropdown-content w3-bar-block w3-border">
                  <a href="<?php echo site_url('main'); ?>" class="w3-bar-item w3-button">Request Payment</a>
                  <a href="<?php echo site_url('display_payments'); ?>" class="w3-bar-item w3-button">View all</a>
                  <a href="#" class="w3-bar-item w3-button">Link 3</a> 
                </span>
              </span>
            </li> 
						<li id=""><a href="<?php echo site_url('login/logout'); ?>">Logout</a></li>
					</span>
				</ul>
			</div>		
		</nav><!--End Navigation-->  
 	