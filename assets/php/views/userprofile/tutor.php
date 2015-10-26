<section role="main" class="content-body">
    <header class="page-header">
        <h2>User Profile</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a class="sidebar-right-toggle" href="/portal/">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>My Profile</span></li>
                <!--<li><span>Default</span></li>-->
            </ol>

            <a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>
    <!-- start: page -->
    <div class="row">
        <div class="col-md-4 col-lg-3">

            <section class="panel">
                <div class="panel-body">
                    <div class="thumb-info mb-md">
                        <img src="/bin/user-profile/<?php echo $_SESSION['user']->getPicUrl(); ?>"
                             class="rounded img-responsive" alt="John Doe">

                        <div class="thumb-info-title">
                            <span
                                class="thumb-info-inner"><?php echo htmlentities($_SESSION['user']->getUserfirstname()) . ' ' . htmlentities($_SESSION['user']->getUserlastname()); ?></span>
                            <span
                                class="thumb-info-type"><?php echo htmlentities($_SESSION['user']->getPermissionName()); ?></span>
                        </div>
                    </div>

                    <div class="widget-toggle-expand mb-md">
                        <div class="widget-header">
                            <h6>Profile Completion</h6>

                            <div class="widget-toggle">+</div>
                        </div>
                        <div class="widget-content-collapsed">
                            <div class="progress progress-xs light">
                                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0"
                                     aria-valuemax="100" style="width: 60%;">
                                    60%
                                </div>
                            </div>
                        </div>
                        <div class="widget-content-expanded">
                            <ul class="simple-todo-list">
                                <li class="completed">Update Profile Picture</li>
                                <li class="completed">Change Personal Information</li>
                                <li>Update Social Media</li>
                                <li>Follow Someone</li>
                            </ul>
                        </div>
                    </div>

                    <hr class="dotted short">

                    <h6 class="text-muted">About</h6>

                    <p>attending Monash South Africa.</p>

                    <div class="clearfix">
                        <a class="text-uppercase text-muted pull-right" href="#">(View All)</a>
                    </div>

                    <hr class="dotted short">

                    <div class="social-icons-list">
                        <a rel="tooltip" data-placement="bottom" target="_blank" href="http://www.facebook.com"
                           data-original-title="Facebook"><i class="fa fa-facebook"></i><span>Facebook</span></a>
                        <a rel="tooltip" data-placement="bottom" href="http://www.twitter.com"
                           data-original-title="Twitter"><i class="fa fa-twitter"></i><span>Twitter</span></a>
                        <a rel="tooltip" data-placement="bottom" href="http://www.linkedin.com"
                           data-original-title="Linkedin"><i class="fa fa-linkedin"></i><span>Linkedin</span></a>
                    </div>

                </div>
            </section>


        </div>
        <div class="col-md-8 col-lg-6">

            <div class="tabs">
                <ul class="nav nav-tabs tabs-primary">
                    <li class="active">
                        <a href="#overview" data-toggle="tab">Overview</a>
                    </li>
                    <li>
                        <a href="#edit" data-toggle="tab">Edit</a>
                    </li>
                    <li class="active">
                        <a href="#results" data-toggle="tab">Results</a>
                    </li>

                </ul>
                <div class="tab-content">
                    <div id="overview" class="tab-pane active">

                        <h4 class="mb-xlg">Timeline</h4>

                        <div class="timeline timeline-simple mt-xlg mb-md">
                            <div class="tm-body">
                                <div class="tm-title">
                                    <h3 class="h5 text-uppercase">September 2015</h3>
                                </div>
                                <ol class="tm-items">
                                    <li>
                                        <div class="tm-box">
                                            <p class="text-muted mb-none">7 hours ago.</p>

                                            <p>
                                                Enrolled in English. </p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="tm-box">
                                            <p class="text-muted mb-none">8 hours ago.</p>

                                            <p>
                                                Enrolled in Mathematics.
                                            </p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="tm-box">
                                            <p class="text-muted mb-none">7 months ago.</p>

                                            <p>
                                                Checkout! How cool is that!
                                            </p>

                                            <div class="thumbnail-gallery">
                                                <a class="img-thumbnail lightbox"
                                                   href="assets/images/projects/project-4.jpg"
                                                   data-plugin-options='{ "type":"image" }'>
                                                    <img class="img-responsive" width="215"
                                                         src="assets/images/projects/project-4.jpg">
																	<span class="zoom">
																		<i class="fa fa-search"></i>
																	</span>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>

                    <div id="results" class="tab-pane">
                        <ul class="simple-bullet-list mb-xlg">
                            <li class="red">
                                <span class="title">Mathematics</span>
                                <span class="description truncate">55%</span>
                            </li>
                            <li class="green">
                                <span class="title">Science</span>
                                <span class="description truncate">60%</span>
                            </li>
                            <li class="blue">
                                <span class="title">English</span>
                                <span class="description truncate">70%</span>
                            </li>
                            <li class="orange">
                                <span class="title">Geography</span>
                                <span class="description truncate">65%</span>
                            </li>
                        </ul>

                    </div>

                    <div id="edit" class="tab-pane">
                        <h4 class = "mb-xlg">Profile Picture</h4>
                        <form enctype="multipart/form-data">
                            <label class="sr-only" for="profileupload">Select image to upload:</label>
                            <input id="profileupload" name="profileupload[]" type="file" class="file-loading">
                        </form>

                        <form class="form-horizontal" action="/assets/includes/process_userprofileedit.php"
                              method="post" name="studentprofile" id="studentprofile">
                            <h4 class="mb-xlg">Personal Information</h4>
                            <fieldset>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="firstname">First Name</label>

                                    <div class="col-md-8">
                                        <input type="text" value="<?php echo $_SESSION['user']->getUserfirstname() ?>"
                                               class="form-control" name="firstname" id="firstname">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="profileLastName">Last Name</label>

                                    <div class="col-md-8">
                                        <input type="text" value="<?php echo $_SESSION['user']->getUserlastname() ?>"
                                               class="form-control" name="surname" id="surname">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="profileAddress">Email Address</label>

                                    <div class="col-md-8">
                                        <input type="text" value="<?php echo $_SESSION['user']->getUseremail() ?>"
                                               class="form-control" name="email" id="email">
                                    </div>
                                </div>
                            </fieldset>

                            <hr class="dotted tall">
                            <h4 class="mb-xlg">Tutor Information</h4>

                            <fieldset>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="profileAddress">Street Number</label>

                                    <div class="col-md-8">
                                        <input type="text" value="<?php echo $_SESSION['user']->getStreetNumber() ?>"
                                               class="form-control" name="tutstreetno" id="tutstreetno">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="profileAddress">Street Name</label>

                                    <div class="col-md-8">
                                        <input type="text" value="<?php echo $_SESSION['user']->getStreetName() ?>"
                                               class="form-control" name="tutstreetname" id="tutstreetname">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="profileAddress">Suburb</label>

                                    <div class="col-md-8">
                                        <input type="text" value="<?php echo $_SESSION['user']->getSuburb() ?>"
                                               class="form-control" name="tutsuburb" id="tutsuburb">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="profileAddress">City</label>

                                    <div class="col-md-8">
                                        <input type="text" value="<?php echo $_SESSION['user']->getCity() ?>"
                                               class="form-control" name="tutcity" id="tutcity">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="profileAddress">Postal Code</label>

                                    <div class="col-md-8">
                                        <input type="text" value="<?php echo $_SESSION['user']->getPostalCode() ?>"
                                               class="form-control" name="tutpostcode" id="tutpostcode">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="profileAddress">Cell Phone Number</label>

                                    <div class="col-md-8">
                                        <input type="text" value="<?php echo $_SESSION['user']->getCellNumber() ?>"
                                               class="form-control" name="tutcellno" id="tutcellno">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="profileAddress">Alternative Contact
                                        Number</label>

                                    <div class="col-md-8">
                                        <input type="text"
                                               value="<?php echo $_SESSION['user']->getAlternativeNumber() ?>"
                                               class="form-control" name="tutaltno" id="tutaltno">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="subjects">Area of Study</label>
                                    <br>

                                    <div class="col-md-8">
                                        <select class="form-control" data-plugin-multiselect
                                                data-plugin-options='{ "enableCaseInsensitiveFiltering": true }'
                                                name="tutsarea"
                                                id="tutsarea">
                                            <option value=""><?php echo $_SESSION['user']->getStudyArea() ?></option>
                                            <option value="MSA Foundation Programme (HCHES)">Foundation
                                                Programme: Higher Certificate in
                                                Higher Education Studies(HCHES)
                                            </option>
                                            <option value="Bachelor-Business Science">Bachelor of
                                                Business Science
                                            </option>
                                            <option value="Bachelor-Business Science (Accounting)">
                                                Bachelor of Business Science
                                                (Accounting)
                                            </option>
                                            <option value="Bachelor-Public Health">Bachelor of Public
                                                Health
                                            </option>
                                            <option value="Bachelor-Computer &amp; Info Sciences">
                                                Bachelor of Computer and Information
                                                Sciences
                                            </option>
                                            <option value="Bachelor-Social Science">Bachelor of Social
                                                Science
                                            </option>
                                            <option value="Honours-Bachelor of Business Science">Honours
                                                degree of Bachelor of Business
                                                Science
                                            </option>
                                            <option value="Honours-Bachelor of Comp &amp; Info Science">
                                                Honours degree of Bachelor of
                                                Computer and Information Sciences
                                            </option>
                                            <option value="Honours in Public Health">Honours degree of
                                                Bachelor of Public Health
                                            </option>
                                            <option value="Honours-Bachelor of Social Science">Honours
                                                degree of Bachelor of Social
                                                Sciences
                                            </option>
                                            <option value="MIB">Master of International Business
                                            </option>
                                            <option value="Master of Philosophy">Master of Philosophy
                                            </option>
                                            <option value="Master of Philosophy in IWM">Master of
                                                Philosophy in Integrated Water
                                                Management
                                            </option>
                                            <option value="Master of Philosophy in CIS">Master of
                                                Philosophy in Computer and Information
                                                Science
                                            </option>
                                            <option value="PDM Accounting (CTA)">PGD Accounting in
                                                Accounting (CTA)
                                            </option>
                                            <option value="PDM Corporate Governance">PGDM specialising
                                                in Corporate Governance
                                            </option>
                                            <option value="PDM HIV/AIDS and Health">PGDM specialising in
                                                HIV/AIDS and Health
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="profileAddress">Study Year</label>

                                    <div class="col-md-8">
                                        <input type="text" value="<?php echo $_SESSION['user']->getStudyYear() ?>"
                                               class="form-control" name="tutsyear" id="tutsyear">
                                    </div>
                                </div>

                            </fieldset>

                            <div class="panel-footer">
                                <div class="row">
                                    <div class="col-md-9 col-md-offset-3">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="reset" class="btn btn-default">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <hr class="dotted tall">
                        <form class="form-horizontal" action="/assets/includes/process_editpassword.php" method="post"
                              name="studentprofile" id="studentprofile">
                            <h4 class="mb-xlg">Change Password</h4>
                            <fieldset class="mb-xl">
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="oldpassword">Old Password</label>

                                    <div class="col-md-8">
                                        <input type="password" class="form-control" id="oldpassword" name="oldpassword">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="password">New Password</label>

                                    <div class="col-md-8">
                                        <input type="password" class="form-control" id="password" name="password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="confirmpwd">Repeat New Password</label>

                                    <div class="col-md-8">
                                        <input type="password" class="form-control" id="confirmpwd" name="confirmpwd">
                                    </div>
                                </div>
                            </fieldset>

                            <div class="panel-footer">
                                <div class="row">
                                    <div class="col-md-9 col-md-offset-3">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="reset" class="btn btn-default">Reset</button>
                                    </div>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-3">


            <h4 class="mb-md">Subjects</h4>
            <ul class="simple-bullet-list mb-xlg">
                <li class="red">
                    <span class="title">Mathematics</span>
                    <span class="description truncate">Lorem ipsom dolor sit.</span>
                </li>
                <li class="green">
                    <span class="title">Science</span>
                    <span class="description truncate">Lorem ipsom dolor sit amet</span>
                </li>
                <li class="blue">
                    <span class="title">English</span>
                    <span class="description truncate">Lorem ipsom dolor sit.</span>
                </li>
                <li class="orange">
                    <span class="title">Geography</span>
                    <span class="description truncate">Lorem ipsom dolor sit.</span>
                </li>
            </ul>

            <h4 class="mb-md">Badges</h4>
            <ul class="simple-user-list mb-xlg">
                <li>
                    <figure class="image rounded">
                        <img src="/assets/img/badge.png" alt="Joseph Doe Junior" class="img-circle">
                    </figure>
                    <span class="title">Start the Journey</span>
                    <span class="message">Enrolled in first subject.</span>
                </li>
                <li>
                    <figure class="image rounded">
                        <img src="/assets/img/badge.png" alt="Joseph Junior" class="img-circle">
                    </figure>
                    <span class="title">Finisher</span>
                    <span class="message">Completed first subject course.</span>
                </li>
                <li>
                    <figure class="image rounded">
                        <img src="/assets/img/badge.png" alt="Joe Junior" class="img-circle">
                    </figure>
                    <span class="title">Hundred</span>
                    <span class="message">Achieve full marks in any subject test.</span>
                </li>
                <li>
                    <figure class="image rounded">
                        <img src="/assets/img/badge.png" alt="Joseph Doe Junior" class="img-circle">
                    </figure>
                    <span class="title">Team Player</span>
                    <span class="message">Refer a friend.</span>
                </li>
            </ul>
        </div>

    </div>

    <aside id="sidebar-right" class="sidebar-right">
        <div class="nano">
            <div class="nano-content">
                <a href="#" class="mobile-close visible-xs">
                    Collapse <i class="fa fa-chevron-right"></i>
                </a>

                <div class="sidebar-right-wrapper">

                    <div class="sidebar-widget widget-calendar">
                        <h6>Upcoming Tasks</h6>

                        <div data-plugin-datepicker data-plugin-skin="dark"></div>

                        <ul>
                            <li>
                                <time datetime="2014-04-19T00:00+00:00">04/19/2014</time>
                                <span>Company Meeting</span>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </aside>
    <!-- end: page -->
</section>
</div>
</section>

</body>
</html>


