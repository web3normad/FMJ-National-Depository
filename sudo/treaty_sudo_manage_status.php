<?php
session_start();
include('assets/config/config.php');
include('assets/config/checklogin.php');
check_login();
//delete status 
if (isset($_GET['d_id'])) {
    $id = intval($_GET['d_id']);
    $code = $_GET['d_id'];
    $forbidden_categories = array('1', '2', '3');
    if (in_array($code, $forbidden_categories)) {
        $err = "Cannot delete this status";
    } else {
        $adn = "DELETE FROM tbl_status  WHERE id = ?";
        $stmt = $mysqli->prepare($adn);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->close();

        if ($stmt) {
            $success = "Treaty Status Deleted";
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
}
?>
<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!-->
<html lang="en"> <!--<![endif]-->
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
        <!--BreadCrumps-->
        <div id="top_bar">
            <ul id="breadcrumbs">
                <li><a href="pages_sudo_dashboard.php">Dashboard</a></li>
                <li><span>Manage Treaty Status</span></li>
            </ul>
        </div>
        <div id="page_content_inner">

            <h4 class="heading_a uk-margin-bottom">Treaty Status</h4>
            <div class="md-card uk-margin-medium-bottom">
                <div class="md-card-content">
                    <div class="dt_colVis_buttons"></div>
                    <table id="dt_tableExport" class="uk-table" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Treaty Status Name</th>
                                <th>Treaty Status Desc</th>
                                <th>Actions</th>
                            </tr>

                        <tbody>
                            <?php
                            $ret = "SELECT * FROM  tbl_status";
                            $stmt = $mysqli->prepare($ret);
                            $stmt->execute(); //ok
                            $res = $stmt->get_result();
                            while ($row = $res->fetch_object()) {

                            ?>
                                <tr>
                                    <td><?php echo $row->name; ?></td>
                                    <td><span class="trim"><?= $row->description; ?></td></span>
                                    <td>
                                        <a href="treaty_sudo_edit_treaty_status.php?id=<?php echo $row->id; ?>">
                                            <span class='uk-badge uk-badge-primary'>Update</span>
                                        </a>
                                        <?php if ($sudo_user->role == 'super_admin') : ?>
                                        <a href="treaty_sudo_manage_status.php?d_id=<?php echo $row->id; ?>">
                                            <span class='uk-badge uk-badge-danger'>Delete</span>
                                        </a>
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