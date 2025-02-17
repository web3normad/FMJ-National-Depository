<?php
session_start();
include('assets/config/config.php');
include('assets/config/checklogin.php');
check_login();

if (isset($_GET['d_id'])) {
    $id = intval($_GET['d_id']);
    $adn = "UPDATE tbl_staff SET acc_status = 'inactive' WHERE id = ?";
    $stmt = $mysqli->prepare($adn);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();


    if ($stmt) {
        $success = "Staff Account Suspended";
?>
<script>
// Remove the query parameter from the URL
window.history.replaceState({}, document.title, window.location.pathname);
</script>
<?php
    } else {
        $err = "Try Again Later";
    }
}

if (isset($_GET['a_id'])) {
    $id = intval($_GET['a_id']);
    $adn = "UPDATE tbl_staff SET acc_status = 'active' WHERE id = ?";
    $stmt = $mysqli->prepare($adn);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();


    if ($stmt) {
        $success = "Staff Account Activated";
?>
<script>
// Remove the query parameter from the URL
window.history.replaceState({}, document.title, window.location.pathname);
</script>
<?php
    } else {
        $err = "Try Again Later";
    }
}
?>



<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!-->
<html lang="en">
<!--<![endif]-->
<?php
include("assets/inc/head.php");
?>

<body class="disable_transitions sidebar_main_open sidebar_main_swipe">
    <!-- main header -->
    <?php
    include("assets/inc/nav.php");
    ?>
    <!-- main header end -->
    <!-- main sidebar -->
    <?php
    include("assets/inc/sidebar.php");
    ?>
    <!-- main sidebar end -->

    <div id="page_content">
        <div class="space-10"></div>
        <!--BreadCrumps-->
        <div id="top_bar">
            <ul id="breadcrumbs">
                <li><a href="pages_sudo_dashboard.php">Dashboard</a></li>
                <li><span>Manage Uploaders</span></li>
            </ul>
        </div>
        <div id="page_content_inner">
            <?php
            $ret = "SELECT * FROM tbl_staff";
            $stmt = $mysqli->prepare($ret);
            $stmt->execute();
            $res = $stmt->get_result();
            $numRows = $res->num_rows;
            ?>
            <h3 class="heading_a uk-margin-bottom text">Manage Accounts ( <?= $numRows ?> )</h3>
            <div class="md-card uk-margin-medium-bottom">
                <div class="md-card-content">
                    <div class="dt_colVis_buttons"></div>
                    <table id="dt_tableExport" class="uk-table" cellspacing="0" width="100%">
                        <thead>
                            <th>Name</th>
                            <th>Staff No</th>
                            <th>Email Address</th>
                            <th>Account Status</th>
                            <th>Action</th>
                        </thead>

                        <tbody>
                            <?php
                            $ret = "SELECT * FROM  tbl_staff";
                            $stmt = $mysqli->prepare($ret);
                            $stmt->execute(); //ok
                            $res = $stmt->get_result();
                            while ($row = $res->fetch_object()) {
                                if ($row->acc_status == 'active') {
                                    $account_status = "<td class='uk-text-success'>Active</td>";
                                    $btn_status = "<a href='treaty_sudo_upload_manage_access.php?d_id=$row->id'>
                            <span class='uk-badge uk-badge-warning'>Suspend</span>
                            </a>";
                            } else {
                            $account_status = "<td class='uk-text-warning'>Suspended</td>";
                            $btn_status = "<a href='treaty_sudo_upload_manage_access.php?a_id=$row->id'>
                                <span class='uk-badge uk-badge-success'>Activate</span>
                            </a>";
                            }

                            ?>
                            <tr>
                                <td><?= $row->name; ?></td>
                                <td><?= $row->number; ?></td>
                                <td><?= $row->email; ?></td>
                                <?= $account_status ?>
                                <td>
                                    <a href="treaty_sudo_view_staff.php?id=<?= $row->id; ?>">
                                        <span class='uk-badge uk-badge-success'>View</span>
                                    </a>
                                    <?php if ($sudo_user->role == 'super_admin') : ?>
                                    <a href="treaty_sudo_edit_staff.php?id=<?= $row->id; ?>">
                                        <span class='uk-badge uk-badge-primary'>Update</span>
                                    </a>
                                    <?= $btn_status ?>
                                    <?php endif; ?>
                                </td>
                            </tr>

                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    <!--Footer-->
    <?php require_once('assets/inc/footer.php'); ?>
    <!--Footer-->

    <!-- google web fonts -->
    <script>
    WebFontConfig = {
        google: {
            families: [
                'Source+Code+Pro:400,700:latin',
                'Roboto:400,300,500,700,400italic:latin'
            ]
        }
    };
    (function() {
        var wf = document.createElement('script');
        wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
            '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
        wf.type = 'text/javascript';
        wf.async = 'true';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(wf, s);
    })();
    </script>

    <!-- common functions -->
    <script src="assets/js/common.min.js"></script>
    <!-- uikit functions -->
    <script src="assets/js/uikit_custom.min.js"></script>
    <!-- altair common functions/helpers -->
    <script src="assets/js/altair_admin_common.min.js"></script>

    <!-- page specific plugins -->
    <!-- datatables -->
    <script src="bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <!-- datatables buttons-->
    <script src="bower_components/datatables-buttons/js/dataTables.buttons.js"></script>
    <script src="assets/js/custom/datatables/buttons.uikit.js"></script>
    <script src="bower_components/jszip/dist/jszip.min.js"></script>
    <script src="bower_components/pdfmake/build/pdfmake.min.js"></script>
    <script src="bower_components/pdfmake/build/vfs_fonts.js"></script>
    <script src="bower_components/datatables-buttons/js/buttons.colVis.js"></script>
    <script src="bower_components/datatables-buttons/js/buttons.html5.js"></script>
    <script src="bower_components/datatables-buttons/js/buttons.print.js"></script>

    <!-- datatables custom integration -->
    <script src="assets/js/custom/datatables/datatables.uikit.min.js"></script>

    <!--  datatables functions -->
    <script src="assets/js/pages/plugins_datatables.min.js"></script>

</body>

</html>