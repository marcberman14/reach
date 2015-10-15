<?php
include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/View.php";
include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/Security.php";
$views = new View();
$security = new Security();
$security->sec_session_start();
$login = $security->login_check();
$active = $security->userActiveState();
$title = "Home";
$keywords = "Monash South Africa, MSA, REACH, R.E.A.CH, Online, Video, Tutoring";
$description = "Monash South Africa, MSA, REACH, R.E.A.CH, Online, Video, Tutoring";
if(!isset($_SESSION)){
    $security->refreshUser($_SESSION['user_id']);
}
include($_SERVER['DOCUMENT_ROOT']."/assets/php/views/header-home.php");
?>
    <div role="main" class="main">
        <div class="slider-container">
            <div class="slider" id="revolutionSlider" data-plugin-revolution-slider data-plugin-options='{"startheight": 500}'>
                <ul>
                    <li data-transition="fade" data-slotamount="13" data-masterspeed="300" >

                        <img src="assets/home-site/img/slides/slide-bg.jpg" data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">

                        <div class="tp-caption sft stb visible-lg"
                             data-x="177"
                             data-y="180"
                             data-speed="300"
                             data-start="1000"
                             data-easing="easeOutExpo"><img src="assets/home-site/img/slides/slide-title-border.png" alt=""></div>

                        <div class="tp-caption top-label lfl stl"
                             data-x="227"
                             data-y="180"
                             data-speed="300"
                             data-start="500"
                             data-easing="easeOutExpo">START YOUR FUTURE</div>

                        <div class="tp-caption sft stb visible-lg"
                             data-x="477"
                             data-y="180"
                             data-speed="300"
                             data-start="1000"
                             data-easing="easeOutExpo"><img src="assets/home-site/img/slides/slide-title-border.png" alt=""></div>

                        <div class="tp-caption main-label sft stb"
                             data-x="235"
                             data-y="210"
                             data-speed="300"
                             data-start="1500"
                             data-easing="easeOutExpo">TODAY</div>

                        <div class="tp-caption bottom-label sft stb"
                             data-x="168"
                             data-y="280"
                             data-speed="500"
                             data-start="2000"
                             data-easing="easeOutExpo">With the Monash R.E.A.CH. Programme.</div>

                        <div class="tp-caption randomrotate"
                             data-x="905"
                             data-y="248"
                             data-speed="500"
                             data-start="2500"
                             data-easing="easeOutBack"><img src="assets/home-site/img/slides/slide-concept-2-1.png" alt=""></div>

                        <div class="tp-caption sfb"
                             data-x="955"
                             data-y="200"
                             data-speed="400"
                             data-start="3000"
                             data-easing="easeOutBack"><img src="assets/home-site/img/slides/slide-concept-2-2.png" alt=""></div>

                        <div class="tp-caption sfb"
                             data-x="925"
                             data-y="170"
                             data-speed="700"
                             data-start="3150"
                             data-easing="easeOutBack"><img src="assets/home-site/img/slides/slide-concept-2-3.png" alt=""></div>

                        <div class="tp-caption sfb"
                             data-x="875"
                             data-y="130"
                             data-speed="1000"
                             data-start="3250"
                             data-easing="easeOutBack"><img src="assets/home-site/img/slides/slide-concept-2-4.png" alt=""></div>

                        <div class="tp-caption sfb"
                             data-x="605"
                             data-y="80"
                             data-speed="600"
                             data-start="3450"
                             data-easing="easeOutExpo"><img src="assets/home-site/img/slides/slide-concept-2-5.png" alt=""></div>

                        <div class="tp-caption blackboard-text lfb "
                             data-x="635"
                             data-y="300"
                             data-speed="500"
                             data-start="3450"
                             data-easing="easeOutExpo" style="font-size: 37px;">Open your mind</div>

                        <div class="tp-caption blackboard-text lfb "
                             data-x="660"
                             data-y="350"
                             data-speed="500"
                             data-start="3650"
                             data-easing="easeOutExpo" style="font-size: 47px;">to the world</div>

                        <div class="tp-caption blackboard-text lfb "
                             data-x="685"
                             data-y="400"
                             data-speed="500"
                             data-start="3850"
                             data-easing="easeOutExpo" style="font-size: 32px;">of education</div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="home-intro" id="home-intro">
            <div class="container">

                <div class="row">
                    <div class="col-md-8">
                        <p>
                            Take the first steps to building a brighter future with the <span><em>Monash R.E.A.CH. Programme</em></span>

                        </p>
                    </div>
                    <div class="col-md-4">
                        <div class="get-started">
                            <a href="/user/register/index.php" class="btn btn-lg btn-primary">Register Now!</a><br>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="container">

            <div class="row center">
                <div class="col-md-12">
                    <h1 class="short">
                        Monash South Africa R.E.A.CH. Programme is Lorem ipsum dolor sit amet
                    </h1>
                    <p class="featured lead">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce elementum, nulla vel pellentesque consequat, ante nulla hendrerit arcu, ac tincidunt mauris lacus sed leo. vamus suscipit molestie vestibulum.
                    </p>
                </div>
            </div>

            <div class="row featured-boxes">
                <div class="col-md-6 col-sm-6">
                    <div class="featured-box featured-box-secundary">
                        <div class="box-content">
                            <i class="icon-featured fa fa-book"></i>
                            <a href="/portal/"><h4><strong>R.E.A.CH.</strong> OUT AND <strong>ADVANCE</strong> YOUR SKILLS</h4></a>
                            <div class="feature-box-info">
                                <p class="tall">Pick your subject, grade and study material</p>
                            </div>


                            <div class="feature-box-info">
                                <p class="tall">Read instructions, watch video's and complete exercises</p>
                            </div>

                            <div class="feature-box-info">
                                <p class="tall">Test your skills and check what you need to improve</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="featured-box featured-box-secundary">
                        <div class="box-content">
                            <i class="icon-featured fa fa-video-camera"></i>
                            <a href="/portal/"><h4><em>Online <strong>Live</strong> tutoring sessions</h4></a>
                            <div class="feature-box-info">
                                <p class="tall">Check the calendar for the next <strong>LIVE</strong> tutoring session</p>
                            </div>
                            <div class="feature-box-info">
                                <p class="tall">Have an interactive tutoring session with one of our Volunteer Tutors</p>
                            </div>
                            <div class="feature-box-info">
                                <p class="tall">Test your knowledge after the tutorial session</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="home-concept">
            <div class="container">

                <div class="row center">
                    <span class="sun"></span>
                    <span class="cloud"></span>
                    <div class="col-md-2 col-md-offset-1">
                        <div class="process-image">
                            <img src="assets/home-site/img/home-concept-item-1.png" alt="" />
                            <strong>Online Lectures</strong>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="process-image">
                            <img src="assets/home-site/img/home-concept-item-2.png" alt="" />
                            <strong>Tutors</strong>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="process-image">
                            <img src="assets/home-site/img/home-concept-item-3.png" alt="" />
                            <strong>Online Exercises</strong>
                        </div>
                    </div>
                    <div class="col-md-4 col-md-offset-1">
                        <div class="project-image">
                            <div id="fcSlideshow" class="fc-slideshow">
                                <ul class="fc-slides">
                                    <li><a href="portfolio-single-project.html"><img class="img-responsive" src="assets/home-site/img/projects/project-home-1.jpg" /></a></li>
                                    <li><a href="portfolio-single-project.html"><img class="img-responsive" src="assets/home-site/img/projects/project-home-2.jpg" /></a></li>
                                    <li><a href="portfolio-single-project.html"><img class="img-responsive" src="assets/home-site/img/projects/project-home-3.jpg" /></a></li>
                                </ul>
                            </div>
                            <strong class="our-work">A brighter you</strong>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

<?php
include($_SERVER['DOCUMENT_ROOT']."/assets/php/views/footer-home.php");
?>

</body>
</html>
