<div class="mdl-layout__drawer">
        
        <header><img src="assets/images/logo.png" class="cmylog"></header>
        <div class="scroll__wrapper" id="scroll__wrapper">
            <div class="scroller" id="scroller">
                <div class="scroll__container" id="scroll__container">
                 <?php if($this->session->userdata('role')=='admin'){ ?>
                        <nav class="mdl-navigation">                                    
                                <a class="mdl-navigation__link" href="dashboard/users">
                                    <i class="material-icons">assignment_ind</i>
                                    Users
                                </a>                    
                                <div class="sub-navigation sub-navigation--show">
                                    
                                    <a class="mdl-navigation__link ">
                                        <i class="material-icons">time_to_leave</i>
                                        Our Vehicles
                                        <i class="material-icons">keyboard_arrow_down</i>
                                    </a>

                                    <div class="mdl-navigation">
                                        <a class="mdl-navigation__link" href="dashboard/allvehicles">
                                            Add Vehicles
                                        </a> 
                                    </div>
                                    <div class="mdl-navigation">
                                        <a class="mdl-navigation__link" href="dashboard/functions">
                                            Car Functions
                                        </a> 
                                    </div>
                                    <div class="mdl-navigation">
                                        <a class="mdl-navigation__link" href="dashboard/features">
                                            Features
                                        </a> 
                                    </div>  
                                    <div class="mdl-navigation">
                                        <a class="mdl-navigation__link" href="dashboard/brands">
                                            Car Brands
                                        </a> 
                                    </div>
                                   
                                </div>
                                <a class="mdl-navigation__link " href="dashboard/allbookings">
                                    <i class="material-icons">event_note</i>
                                    Bookings
                                </a> 
                                <a class="mdl-navigation__link " href="dashboard/allinvoices">
                                    <i class="material-icons">assignment</i>
                                    Invoices
                                </a> 
                                <div class="sub-navigation">
                                    <a class="mdl-navigation__link ">
                                        <i class="material-icons">settings_applications</i>
                                        Website Setting
                                        <i class="material-icons">keyboard_arrow_down</i>
                                    </a> 
                                       
                                    <div class="mdl-navigation">
                                        <a class="mdl-navigation__link" href="dashboard/services">
                                            Services
                                        </a> 
                                    </div>     
                                                                         
                                    <!-- <div class="mdl-navigation">
                                        <a class="mdl-navigation__link" href="dashboard/faq">
                                            FAQ
                                        </a> 
                                    </div>    
                                    <div class="mdl-navigation">
                                        <a class="mdl-navigation__link" href="dashboard/howitworks">
                                            How it works
                                        </a> 
                                    </div> 
                                    <div class="mdl-navigation">
                                        <a class="mdl-navigation__link" href="dashboard/business">
                                            For Business
                                        </a> 
                                    </div>  -->
                                              
                                </div>
                                
                                <div class="sub-navigation">
                                    <a class="mdl-navigation__link ">
                                        <i class="material-icons">account_circle</i>
                                        Profile
                                        <i class="material-icons">keyboard_arrow_down</i>
                                    </a> 
                                     
                                    <div class="mdl-navigation">
                                        <a class="mdl-navigation__link" href="dashboard/setting">
                                            Setting
                                        </a> 
                                    </div>
                                </div>
                                
                    </nav>
                <?php }else if($this->session->userdata('role')=='dealer'){ ?>
                      <nav class="mdl-navigation">
                            <div class="sub-navigation sub-navigation--show">
                            
                                <a class="mdl-navigation__link ">
                                    <i class="material-icons">time_to_leave</i>
                                    Our Vehicles
                                    <i class="material-icons">keyboard_arrow_down</i>
                                </a>
                                <div class="mdl-navigation">
                                    <a class="mdl-navigation__link" href="dashboard/allvehicles">
                                        Add Vehicles
                                    </a> 
                                </div> 
                            </div> 
                            <a class="mdl-navigation__link " href="dashboard/allbookings">
                                <i class="material-icons">event_note</i>
                                Bookings
                            </a> 
                            <a class="mdl-navigation__link " href="dashboard/allinvoices">
                                    <i class="material-icons">assignment</i>
                                    Invoices
                            </a> 
                            <div class="sub-navigation">
                                    <a class="mdl-navigation__link ">
                                        <i class="material-icons">account_circle</i>
                                        Profile
                                        <i class="material-icons">keyboard_arrow_down</i>
                                    </a>   
                                    <div class="mdl-navigation">
                                        <a class="mdl-navigation__link" href="dashboard/setting">
                                            Setting
                                        </a> 
                                    </div>
                            </div>                          
                           
                        
                        
                    </nav>  
                    <?php } ?>
                </div>
            </div>
            <div class='scroller__bar' id="scroller__bar"></div>
        </div>
    </div>