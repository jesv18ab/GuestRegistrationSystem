@extends('layouts/head')
    <header class="headerMain" id="header"  >
        <img src="../Images/logo.svg" height="100%" width="25%" style="margin-left: 38%" >
    </header>
    <!--/ header-->
    <section id="feature" class="paddingForFrontpage " style="background-color: white;margin-bottom: 15%;border: 1px solid black;width: 1351.99px;margin-left: 6.5%;margin-right: 2%;height: 550px; box-shadow:3px 3px 3px 3px;">

        <div class="container" style="margin-left: 2%; margin-right: 2%;">
            <div class="row">
                <div style="width: 100%;">
                    <div class="section-title " style="margin-right: 800px; height: 97px">
                        <h2 class="head-title"> <b style="font-weight: bolder;color: black;  text-shadow: 0px 1px, 1px 0px, 1px 1px;">Velkommen til registreringen!</b></h2>
                        <hr class="bottom-line">
                    </div>
                </div>
                <div class="col-md-9" >
                    <div style="width: 1400px; height: 40%; margin-top: 2% ">
                        <button class="btnBrew btnBrew-primary" onclick="guestOverview()"  style="border: 1px solid #1b1e21; width: 25%; height: 175px; float: left;  margin-right: 5.5%; margin-bottom: 2%; margin-left: 2%; ">
                            <h3> <b style="font-weight: 300;color: black;  text-shadow: 0px 1px, 1px 0px, 1px 1px;">Få gæsteoverblikket</b></h3>
                            <i class='fas fa-clipboard-list' style='font-size:75px; color: black'></i>                        </button>
                        <button class="btnBrew btnBrew-primary" style="border: 1px solid #1b1e21; width: 25%; height: 175px; float: left; margin-bottom: 2%; margin-right: 5.5%;">
                            <h3> <b style="font-weight: 300;color: black;  text-shadow: 0px 1px, 1px 0px, 1px 1px;">Se Statistikker</b></h3>
                            <i class='fas fa-chart-line' style='font-size:75px;color:black'></i>
                        </button>
                        <button class="btnBrew btnBrew-primary" onclick="goToGuestRegistration()" style="border: 1px solid #1b1e21; width: 25%; height: 175px; float: left; margin-bottom: 2%;">
                             <h3> <b style="font-weight: 300;color: black;  text-shadow: 0px 1px, 1px 0px, 1px 1px;">Ny Gæsteregisrering</b></h3>
                            <i class="fa fa-handshake-o" style="font-size:75px;color:black"></i>
                        </button>
                    </div>
                    <div style="width: 1400px; height: 40%; margin-bottom: 50%">
                        <button class="btnBrew btnBrew-primary" onclick="guestPage()" style="border: 1px solid #1b1e21; width: 25%; height: 175px; float: left;margin-left: 2%;  margin-right: 5.5%; margin-bottom: 5%">
                            <h3> <b style="font-weight: 300;color: black;  text-shadow: 0px 1px, 1px 0px, 1px 1px;">Gå til gæstesiden</b></h3>
                            <i class='fa fa-calendar-check-o' style='font-size:75px;color:black'></i>
                        </button>
                        <button class="btnBrew btnBrew-primary" style="border: 1px solid #1b1e21; width: 25%; height: 175px; float: left; margin-bottom: 5%; margin-right: 5.5%">
                            <a class="nav-link " ><h3 style="color: black">GitHub</H3></a>
                        </button>
                        <button class="btnBrew btnBrew-primary" style="border: 1px solid #1b1e21; width: 25%; height: 175px; float: left;   margin-bottom: 5%; ">
                           <div>
                            <h3> <b style="font-weight: 300;color: black;  text-shadow: 0px 1px, 1px 0px, 1px 1px;">Vend tilbage til Login</b></h3>
                            <i class='fas fa-door-open' style='font-size:75px; color: black'></i>
                           </div></button>
                    </div>
                </div>
            </div>
        </div>


    </section>
    <!---->
    <!---->
    <footer class="" id="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-7 footer-copyright">
                    © Bethany Theme - All rights reserved
                    <div class="credits">
                        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                    </div>
                </div>
                <div class="col-sm-5 footer-social">
                    <div class="pull-right hidden-xs hidden-sm">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-dribbble"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-google-plus"></i></a>
                        <a href="#"><i class="fa fa-pinterest"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!---->
    <!--contact ends-->
