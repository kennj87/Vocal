<!DOCTYPE html>
<?php include 'controller.php';session_start();
if (isset($_SESSION['login'])) {
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
    <link href='../dist/css/sb-admin-2.css' rel='stylesheet'>
    <link href='../bower_components/font-awesome/css/font-awesome.min.css' rel='stylesheet' type='text/css'>
</head>

<body>
    <div class='container'>
        <div class='row'>
            <div class='col-lg-7 col-md-offset-3'>
                <div class='login-panel panel panel-default'>
                    <div class='panel-heading'>
                        <h3 class='panel-title'>Edit File <a href='index.php'>- Click to go back</a></h3>
                    </div>
                    <div class='panel-body'>
                    
                        <div class='table-responsive'>
                                <table class='table table-striped table-bordered table-hover'>
                                    <thead>
                                        <tr>
                                            <th>Value</th>
                                            <th>Details</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    ";$id = filter_input(INPUT_GET,'id');get_file_info($dbh,$id);echo"
                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src='../bower_components/jquery/dist/jquery.min.js'></script>
    <script src='../bower_components/bootstrap/dist/js/bootstrap.min.js'></script>
    <script src='../bower_components/metisMenu/dist/metisMenu.min.js'></script>
    <script src='../dist/js/sb-admin-2.js'></script>
</body>
</html>
";
}
else { header("Location: index.php"); }
