<!DOCTYPE html>
<?php include 'controller.php';session_start();
if (isset($_SESSION['login']) && ($_SESSION['upload'] == '1')) {
echo "
<html lang='en'>

<head>

    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta name='description' content=''>
    <meta name='author' content=''>
    <title>Vocal Line - Admin page</title>
    <link href='../bower_components/bootstrap/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link href='../bower_components/metisMenu/dist/metisMenu.min.css' rel='stylesheet'>
    <link href='../dist/css/timeline.css' rel='stylesheet'>
    <link href='../dist/css/sb-admin-2.css' rel='stylesheet'>
    <link href='../bower_components/morrisjs/morris.css' rel='stylesheet'>
    <link href='../bower_components/font-awesome/css/font-awesome.min.css' rel='stylesheet' type='text/css'>
    <link href='../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css' rel='stylesheet'>
    <link href='../bower_components/datatables-responsive/css/dataTables.responsive.css' rel='stylesheet'>
</head>

<body>

    <div id='wrapper'>

        <!-- Navigation -->
        <nav class='navbar navbar-default navbar-static-top' role='navigation' style='margin-bottom: 0'>
            <div class='navbar-header'>
                <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-collapse'>
                    <span class='sr-only'>Toggle navigation</span>
                    <span class='icon-bar'></span>
                    <span class='icon-bar'></span>
                    <span class='icon-bar'></span>
                </button>
                <a class='navbar-brand' href='index.php'>Vocal Line - Admin page</a>
            </div>
            <!-- /.navbar-header -->
            <ul class='nav navbar-top-links navbar-right'>
                <li class='dropdown'>
                    <a class='dropdown-toggle' data-toggle='dropdown' href='#/'>
                        <i class='fa fa-user fa-fw'></i>  <i class='fa fa-caret-down'></i>
                    </a>
                    <ul class='dropdown-menu dropdown-user'>
                        <li><a href='profile.php'><i class='fa fa-user fa-fw'></i> User Profile</a>
                        </li>
                        <li class='divider'></li>
                        <li><a href='logout.php'><i class='fa fa-sign-out fa-fw'></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class='navbar-default sidebar' role='navigation'>
                <div class='sidebar-nav navbar-collapse'>
                    <ul class='nav' id='side-menu'>
                        <li>
                            <a href='index.php'><i class='fa fa-bar-chart-o fa-fw'></i> Dashboard</a>
                        </li>
                        <li>
                            <a href='createuser.php'><i class='fa fa-pencil fa-fw'></i> Manage</a>
                        </li>
                        <li>
                            <a href='upload.php'><i class='fa fa-music fa-fw'></i> Upload</a>
                        </li>                        
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

                <div id='page-wrapper'>
            <div class='row'>
                <div class='col-lg-12'>
                    <h1 class='page-header'>Upload File</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class='row'>
                <div class='col-lg-12'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            Upload
                        </div>
                        <div class='panel-body'>
                            <div class='row'>
                                <div class='col-lg-6'>
                                    <form action='uploading.php' method='post' enctype='multipart/form-data'>
                                        <div class='form-group'>
                                            <input type='text' name='note' class='form-control' placeholder='Comment for file (optional)'>
                                            <label>File input</label>
                                            <input type='file' name='file' id='file'>
                                        </div>
                                        <div class='form-group'>
                                            <label>Choir Member</label>
                                            <select name='member' class='form-control'>
                                                ";get_members_option($dbh);echo"
                                            </select>
                                        </div>
                                        <div class='form-group'>
                                            <label>Vowel</label>
                                            <select name='tone' class='form-control'>
                                                <option value='1'>C</option>
                                                <option value='2'>Db</option>
                                                <option value='3'>D</option>
                                                <option value='4'>Eb</option>
                                                <option value='5'>E</option>
                                                <option value='6'>F</option>
                                                <option value='7'>Gb</option>
                                                <option value='8'>G</option>
                                                <option value='9'>Ab</option>
                                                <option value='10'>A</option>
                                                <option value='11'>Bb</option>
                                                <option value='12'>H</option>
                                            </select>
                                        </div>
                                        <div class='form-group'>
                                            <label>Velocity</label>
                                            <select name='velocity' class='form-control'>
                                                <option value='1'>1</option>
                                                <option value='2'>2</option>
                                                <option value='3'>3</option>
                                                <option value='4'>4</option>
                                                <option value='5'>5</option>
                                                <option value='6'>6</option>
                                                <option value='7'>7</option>
                                                <option value='8'>8</option>
                                                <option value='9'>9</option>
                                                <option value='10'>10</option>
                                            </select>
                                        </div>
                                        <div class='form-group'>
                                            <label>Sound Connection</label>
                                            <select name='connection' class='form-control'>
                                                <option value='1'>Single</option>
                                                <option value='2'>Connected</option>
                                            </select>
                                        </div>
                                        <button type='submit' class='btn btn-default'>Upload</button>
                                    </form>
                                </div>
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->

        
                <div class='col-lg-12'>
                    <h1 class='page-header'>Uploads</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class='row'>
                 <div class='col-lg-12'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            Uploaded files
                        </div>
                        <!-- /.panel-heading -->
                        <div class='panel-body'>
                            <div class='dataTable_wrapper'>
                                <table class='table table-striped table-bordered table-hover' id='dataTables-example'>
                                    <thead>
                                        <tr>
                                            <th>File ID</th>
                                            <th>Choir Member</th>
                                            <th>Vowel</th>
                                            <th>Function</th>
                                            <th>Velocity</th>
                                            <th>Connection</th>
                                            <th>Comment</th>
                                            <th style='width:35px;'>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        ";fetch_uploads($dbh);echo"
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
            </div>
            <!-- /.row -->
            
    </div>
    <!-- /#wrapper -->

    <script src='../bower_components/jquery/dist/jquery.min.js'></script>
    <script src='../bower_components/bootstrap/dist/js/bootstrap.min.js'></script>
    <script src='../bower_components/metisMenu/dist/metisMenu.min.js'></script>
    <script src='../dist/js/sb-admin-2.js'></script>
    <script src='../bower_components/datatables/media/js/jquery.dataTables.min.js'></script>
    <script src='../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js'></script>
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>

</body>

</html>
";
}
else { header('Location: index.php'); }
