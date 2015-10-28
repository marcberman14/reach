<?php include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/Subject.php"; ?>
<div class="row">
    <div class="col-xl-3 col-lg-6">
        <section class="panel panel-transparent">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="fa fa-caret-down"></a>
                    <a href="#" class="fa fa-times"></a>
                </div>

                <h2 class="panel-title">My Profile</h2>
            </header>
            <div class="panel-body">
                <section class="panel panel-group">
                    <header class="panel-heading bg-primary">

                        <div class="widget-profile-info">
                            <div class="profile-picture">
                                <img src="/bin/user-profile/<?php echo $_SESSION['user']->getPicUrl(); ?>" alt="<?php echo htmlentities($_SESSION['user']->getUserfirstname()) .' ' . htmlentities($_SESSION['user']->getUserlastname());?>" class="" data-lock-picture="/bin/user-profile/<?php echo $_SESSION['user']->getPicUrl();?>" />
                            </div>

                            <div class="profile-info">
                                <h4 class="name text-semibold"><?php echo htmlentities($_SESSION['user']->getUserfirstname()) .' ' . htmlentities($_SESSION['user']->getUserlastname());?></h4>
                                <h5 class="role"><?php echo $_SESSION['user']->getPermissionName(); ?></h5>
                                <div class="profile-footer">
                                    <a href="/portal/userprofile/#edit">(edit profile)</a>
                                </div>
                            </div>
                        </div>

                    </header>
                    <div id="accordion">
                        <div class="panel panel-accordion panel-accordion-first">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a aria-expanded="true" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1One">
                                        <i class="fa fa-check"></i> Tasks
                                    </a>
                                </h4>
                            </div>
                            <div style="" aria-expanded="true" id="collapse1One" class="accordion-body collapse in">
                                <div class="panel-body">
                                    <ul class="widget-todo-list ui-sortable">
                                        <li>
                                            <div class="checkbox-custom checkbox-default">
                                                <input checked="" id="todoListItem1" class="todo-check" type="checkbox">
                                                <label class="todo-label line-through" for="todoListItem1"><span>Lorem ipsum dolor sit amet</span></label>
                                            </div>
                                            <div class="todo-actions">
                                                <a class="todo-remove" href="#">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="checkbox-custom checkbox-default">
                                                <input id="todoListItem2" class="todo-check" type="checkbox">
                                                <label class="todo-label" for="todoListItem2"><span>Lorem ipsum dolor sit amet</span></label>
                                            </div>
                                            <div class="todo-actions">
                                                <a class="todo-remove" href="#">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="checkbox-custom checkbox-default">
                                                <input id="todoListItem3" class="todo-check" type="checkbox">
                                                <label class="todo-label" for="todoListItem3"><span>Lorem ipsum dolor sit amet</span></label>
                                            </div>
                                            <div class="todo-actions">
                                                <a class="todo-remove" href="#">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="checkbox-custom checkbox-default">
                                                <input id="todoListItem4" class="todo-check" type="checkbox">
                                                <label class="todo-label" for="todoListItem4"><span>Lorem ipsum dolor sit amet</span></label>
                                            </div>
                                            <div class="todo-actions">
                                                <a class="todo-remove" href="#">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="checkbox-custom checkbox-default">
                                                <input id="todoListItem5" class="todo-check" type="checkbox">
                                                <label class="todo-label" for="todoListItem5"><span>Lorem ipsum dolor sit amet</span></label>
                                            </div>
                                            <div class="todo-actions">
                                                <a class="todo-remove" href="#">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="checkbox-custom checkbox-default">
                                                <input id="todoListItem6" class="todo-check" type="checkbox">
                                                <label class="todo-label" for="todoListItem6"><span>Lorem ipsum dolor sit amet</span></label>
                                            </div>
                                            <div class="todo-actions">
                                                <a class="todo-remove" href="#">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                    <hr class="solid mt-sm mb-lg">
                                    <form method="get" class="form-horizontal form-bordered">
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <div class="input-group mb-md">
                                                    <input class="form-control" type="text">
                                                    <div class="input-group-btn">
                                                        <button type="button" class="btn btn-primary" tabindex="-1">Add</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-accordion">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a aria-expanded="false" class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse1Two">
                                        <i class="fa fa-comment"></i> Messages
                                    </a>
                                </h4>
                            </div>
                            <div style="height: 0px;" aria-expanded="false" id="collapse1Two" class="accordion-body collapse">
                                <div class="panel-body">
                                    <ul class="simple-user-list mb-xlg">
                                        <li>
                                            <figure class="image rounded">
                                                <img src="assets/images/!sample-user.jpg" alt="Joseph Doe Junior" class="img-circle">
                                            </figure>
                                            <span class="title">Joseph Doe Junior</span>
                                            <span class="message">Lorem ipsum dolor sit.</span>
                                        </li>
                                        <li>
                                            <figure class="image rounded">
                                                <img src="assets/images/!sample-user.jpg" alt="Joseph Junior" class="img-circle">
                                            </figure>
                                            <span class="title">Joseph Junior</span>
                                            <span class="message">Lorem ipsum dolor sit.</span>
                                        </li>
                                        <li>
                                            <figure class="image rounded">
                                                <img src="assets/images/!sample-user.jpg" alt="Joe Junior" class="img-circle">
                                            </figure>
                                            <span class="title">Joe Junior</span>
                                            <span class="message">Lorem ipsum dolor sit.</span>
                                        </li>
                                        <li>
                                            <figure class="image rounded">
                                                <img src="assets/images/!sample-user.jpg" alt="Joseph Doe Junior" class="img-circle">
                                            </figure>
                                            <span class="title">Joseph Doe Junior</span>
                                            <span class="message">Lorem ipsum dolor sit.</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </section>
    </div>
    <div class="col-xl-3 col-lg-6">
        <section class="panel panel-transparent">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="fa fa-caret-down"></a>
                    <a href="#" class="fa fa-times"></a>
                </div>

                <h2 class="panel-title">My Stats</h2>
            </header>
            <div class="panel-body">
                <section class="panel">
                    <div class="panel-body">
                        <div class="small-chart pull-right" id="sparklineBarDash"><canvas height="55" width="79" style="display: inline-block; vertical-align: top; width: 79px; height: 55px;"></canvas></div>
                        <script type="text/javascript">
                            var sparklineBarDashData = [5, 6, 7, 2, 0, 4 , 2, 4, 2, 0, 4 , 2, 4, 2, 0, 4];
                        </script>
                        <div class="h4 text-bold mb-none">488</div>
                        <p class="text-xs text-muted mb-none">Average Profile Visits</p>
                    </div>
                </section>
                <section class="panel">
                    <div class="panel-body">
                        <div class="circular-bar circular-bar-xs m-none mt-xs mr-md pull-right">
                            <div class="circular-bar-chart" data-percent="45" data-plugin-options="{ &quot;barColor&quot;: &quot;#2baab1&quot;, &quot;delay&quot;: 300, &quot;size&quot;: 50, &quot;lineWidth&quot;: 4 }">
                                <strong>Average</strong>
                                <label><span class="percent">45</span>%</label>
                                <canvas width="50" height="50"></canvas></div>
                        </div>
                        <div class="h4 text-bold mb-none">12</div>
                        <p class="text-xs text-muted mb-none">Working Projects</p>
                    </div>
                </section>
                <section class="panel">
                    <div class="panel-body">
                        <div class="small-chart pull-right" id="sparklineLineDash"><canvas height="55" width="80" style="display: inline-block; vertical-align: top; width: 80px; height: 55px;"></canvas></div>
                        <script type="text/javascript">
                            var sparklineLineDashData = [15, 16, 17, 19, 10, 15, 13, 12, 12, 14, 16, 17];
                        </script>
                        <div class="h4 text-bold mb-none">89</div>
                        <p class="text-xs text-muted mb-none">Pending Tasks</p>
                    </div>
                </section>
            </div>
        </section>
        <section class="panel">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="fa fa-caret-down"></a>
                    <a href="#" class="fa fa-times"></a>
                </div>

                <h2 class="panel-title">
                    <span class="label label-primary label-sm text-normal va-middle mr-sm">198</span>
                    <span class="va-middle">Friends</span>
                </h2>
            </header>
            <div class="panel-body">
                <div class="content">
                    <ul class="simple-user-list">
                        <li>
                            <figure class="image rounded">
                                <img src="assets/images/!sample-user.jpg" alt="Joseph Doe Junior" class="img-circle">
                            </figure>
                            <span class="title">Joseph Doe Junior</span>
                            <span class="message truncate">Lorem ipsum dolor sit.</span>
                        </li>
                        <li>
                            <figure class="image rounded">
                                <img src="assets/images/!sample-user.jpg" alt="Joseph Junior" class="img-circle">
                            </figure>
                            <span class="title">Joseph Junior</span>
                            <span class="message truncate">Lorem ipsum dolor sit.</span>
                        </li>
                        <li>
                            <figure class="image rounded">
                                <img src="assets/images/!sample-user.jpg" alt="Joe Junior" class="img-circle">
                            </figure>
                            <span class="title">Joe Junior</span>
                            <span class="message truncate">Lorem ipsum dolor sit.</span>
                        </li>
                    </ul>
                    <hr class="dotted short">
                    <div class="text-right">
                        <a class="text-uppercase text-muted" href="#">(View All)</a>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <div class="input-group input-search">
                    <input class="form-control" name="q" id="q" placeholder="Search..." type="text">
										<span class="input-group-btn">
											<button class="btn btn-default" type="submit"><i class="fa fa-search"></i>
                                            </button>
										</span>
                </div>
            </div>
        </section>
    </div>
    <div class="col-xl-6 col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="fa fa-caret-down"></a>
                        <a href="#" class="fa fa-times"></a>
                    </div>

                    <h2 class="panel-title">My Subjects</h2>
                    <p class="panel-subtitle">Below are a list of the units you are currently enrolled in.</p>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="toggle" data-plugin-toggle="" data-plugin-options="{ 'isAccordion': true }">
                                <?php
                                echo Subject::myEnrolGenerate();
                                ?>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>


