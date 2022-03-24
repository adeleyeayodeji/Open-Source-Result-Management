<div class="left-sidebar bg-black-300 box-shadow ">
    <div class="sidebar-content">
        <div class="user-info closed">
            <?php
                            $stmt = $dbh->query("SELECT * FROM admin");
                            $roww = $stmt->fetch(PDO::FETCH_OBJ);
                            ?>
            <img src="images/<?php echo htmlentities($roww->image) ?>" height="70" alt="Tesfu Amsale"
                class="img-circle profile-img">
            <h4 class="title"><?php echo htmlentities($roww->fullname) ?></h4>
            <small class="info"><?php echo htmlentities($roww->role) ?></small>
        </div>
        <!-- /.user-info -->

        <div class="sidebar-nav">
            <ul class="side-nav color-gray">
                <li class="nav-header">
                    <span class="">Main Category</span>
                </li>
                <li>
                    <a href="dashboard.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span> </a>

                </li>
                <?php
                                    if (!isset($_SESSION["teacher"])) {
                                      ?>
                <li class="has-children">
                    <a href="#"><i class="fa fa-file-text"></i> <span>Classes</span> <i
                            class="fa fa-angle-right arrow"></i></a>
                    <ul class="child-nav">
                        <li><a href="create-class.php"><i class="fa fa-bars"></i> <span>Create Class</span></a></li>
                        <li><a href="manage-classes.php"><i class="fa fa fa-server"></i> <span>Manage Classes</span></a>
                        </li>

                    </ul>
                </li>
                <li class="has-children">
                    <a href="#"><i class="fa fa-file-text"></i> <span>Subjects</span> <i
                            class="fa fa-angle-right arrow"></i></a>
                    <ul class="child-nav">
                        <li><a href="create-subject.php"><i class="fa fa-bars"></i> <span>Create Subject</span></a></li>
                        <li><a href="manage-subjects.php"><i class="fa fa fa-server"></i> <span>Manage
                                    Subjects</span></a></li>
                        <li><a href="add-subjectcombination.php"><i class="fa fa-newspaper-o"></i> <span>Add Subject
                                    Combination </span></a></li>
                        <a href="manage-subjectcombination.php"><i class="fa fa-newspaper-o"></i> <span>Manage Subject
                                Combination </span></a>
                </li>
                <li><a href="create-department.php"><i class="fa fa-bars"></i> <span>Create Student
                            Department</span></a></li>
                <li><a href="manage-department.php"><i class="fa fa-bars"></i> <span>Manage Student
                            Department</span></a></li>
            </ul>
            </li>
            <?php
                                    }
                                    ?>
            <li class="has-children">
                <a href="#"><i class="fa fa-users"></i> <span>Students</span> <i
                        class="fa fa-angle-right arrow"></i></a>
                <ul class="child-nav">
                    <li><a href="add-students.php"><i class="fa fa-bars"></i> <span>Add Students</span></a></li>
                    <li><a href="<?php
                                            if(isset($_SESSION['teacher'])){
                                                ?>
                                                manage-students.php
                                                <?php
                                            }else{
                                                ?>
                                                manage-students.php
                                                <?php
                                            }
                                            ?>"><i class="fa fa fa-server"></i> <span>Manage Students</span></a></li>

                </ul>
            </li>
            <li class="has-children">
                <a href="#"><i class="fa fa-info-circle"></i> <span>Result</span> <i
                        class="fa fa-angle-right arrow"></i></a>
                <ul class="child-nav">
                    <li><a href="add-result.php"><i class="fa fa-bars"></i> <span>Add Result</span></a></li>
                    <li><a href="manage-results.php"><i class="fa fa fa-server"></i> <span>Manage Result</span></a></li>

                </ul>
                <?php
                                    if (!isset($_SESSION["teacher"])) {
                                      ?>
            <li class="nav-header">
                <span class="">Appearance</span>
            </li>
            <li><a href="manage-pin.php"><i class="fa fa fa-user"></i> <span> Result PIN</span></a></li>
            <li><a href="add-teacher.php"><i class="fa fa fa-gear"></i> <span> Add Teacher</span></a></li>
            <li><a href="manage-teacher.php"><i class="fa fa fa-gear"></i> <span> Manage Teacher</span></a></li>
            <li><a href="settings.php"><i class="fa fa fa-gear"></i> <span> Site Settings</span></a></li>
            <li><a href="change-background.php"><i class="fa fa fa-gear"></i> <span> Change background</span></a></li>
            <li><a href="adsettings.php"><i class="fa fa fa-user"></i> <span> Admin Profile</span></a></li>
            <li><a href="change-password.php"><i class="fa fa fa-server"></i> <span> Change Password</span></a></li>
            <?php
                                    }
                                    ?>
            </li>
        </div>
        <!-- /.sidebar-nav -->
    </div>
    <!-- /.sidebar-content -->
</div>