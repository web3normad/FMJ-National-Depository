<aside id="sidebar_main">

    <a href="pages_sudo_dashboard.php">
        <div class="sidebar_main_header">
            <div class="sidebar_logo">
            </div>
        </div>
    </a>

    <div class="menu_section">

        <h5 style="margin-bottom:0; padding-left:1rem;"><em class="text-primary">Welcome back, </em><strong><?= $sudo_user->username ?></strong></h5>
        <hr />
        <ul>
            <!--Dashboard-->
            <li title="Dashboard">
                <a href="pages_sudo_dashboard.php">
                    <span class="menu_icon"><i class="material-icons">&#xE871;</i></span>
                    <span class="menu_title">Dashboard</span>
                </a>

            </li>
            <li title="Treaties">
                <a href="">
                    <span class="menu_icon"><i class="material-icons">&#xE8D4;</i></span>
                    <span class="menu_title">Treaties</span>
                </a>
                <ul>
                    <li><a href="treaty_sudo_all_treaties.php">All Treaties</a></li>
                    <li><a href="treaty_sudo_published_treaties.php">Published</a></li>
                    <li><a href="treaty_sudo_revised_treaties.php">Revised</a></li>
                    <li><a href="treaty_sudo_running_treaties.php">Running</a></li>
                    <?php if ($sudo_user->role == 'super_admin') : ?>
                        <li><a href="treaty_sudo_upload_treaties.php">Upload Treaty</a></li>
                    <?php endif; ?>
                </ul>
            </li>
            <!--Upload Access-->
            <li title="Upload Access">
                <a href="">
                    <span class="menu_icon"><i class="material-icons">&#xE2C3;</i></span>
                    <span class="menu_title">Upload Access</span>
                </a>
                <ul>
                    <?php if ($sudo_user->role == 'super_admin') : ?>
                        <li><a href="treaty_sudo_upload_add_access.php">Add</a></li>
                    <?php endif; ?>
                    <li><a href="treaty_sudo_upload_manage_access.php">Manage</a></li>
                </ul>
            </li>
            <!--Manage Category-->
            <li title="Category Access">
                <a href="">
                    <span class="menu_icon"><i class="material-icons">&#xE8D2;</i></span>
                    <span class="menu_title">Treaty Categories</span>
                </a>
                <ul>
                    <?php if ($sudo_user->role == 'super_admin') : ?>
                        <li><a href="treaty_sudo_add_category.php">Add</a></li>
                    <?php endif; ?>
                    <li><a href="pages_sudo_manage_categories.php">Manage</a></li>
                </ul>
            </li>

            <!--Manage Status-->
            <li title="Status">
                <a href="">
                    <span class="menu_icon"><i class="material-icons">&#xE8D2;</i></span>
                    <span class="menu_title">Treaty Status</span>
                </a>
                <ul>
                    <?php if ($sudo_user->role == 'super_admin') : ?>
                        <li><a href="treaty_sudo_add_status.php">Add</a></li>
                    <?php endif; ?>
                    <li><a href="treaty_sudo_manage_status.php">Manage</a></li>
                </ul>
            </li>
            <!--password resets-->
            <?php if ($sudo_user->role == 'super_admin') : ?>
                <li title="Password Resets">
                    <a href="">
                        <span class="menu_icon"><i class="material-icons">lock</i></span>
                        <span class="menu_title">Password Resets</span>
                    </a>
                    <ul>
                        <li><a href="pages_sudo_manage_staff_password_resets.php">Manage uploader</a></li>
                    </ul>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</aside>