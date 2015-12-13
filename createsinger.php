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
    <link href='../dist/css/sb-admin-2.css' rel='stylesheet'>
    <link href='../bower_components/font-awesome/css/font-awesome.min.css' rel='stylesheet' type='text/css'>
</head>

<body>
    <div class='container'>
        <div class='row'>
           
            <div class='col-lg-7 col-md-offset-3'>
                <div class='login-panel panel panel-default'>
                    <div class='panel-heading'>
                        <h3 class='panel-title'>Create Choir Member</h3>
                    </div>
                    <div class='panel-body'>
                        <form role='form' action='creatingsinger.php' method='post'>
                            <fieldset>
                                <div class='form-group'>
                                    <input class='form-control' placeholder='Name' name='name' type='text' autofocus>
                                </div>
                                <div class='radio'>
                                    <label>
                                    <p><b>Female:</b></p>
                                        <input name='type' type='radio' value='Soprano'>Soprano
                                        <br>
                                        <input name='type' type='radio' value='Mezzo-soprano'>Mezzo-soprano
                                        <br>
                                        <input name='type' type='radio' value='Contralo'>Contralo
                                        <br><br>
                                    <p><b>Male:</b></p>
                                        <input name='type' type='radio' value='Countertenor'>Countertenor
                                        <br>
                                        <input name='type' type='radio' value='Tenor'>Tenor
                                        <br>
                                        <input name='type' type='radio' value='Baritone'>Baritone
                                        <br>
                                        <input name='type' type='radio' value='Bass'>Bass
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button class='btn btn-lg btn-success btn-block'>Create Choir Member</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>

            <div class='col-lg-7 col-md-offset-3'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            Choir Members
                        </div>
                        <!-- /.panel-heading -->
                        <div class='panel-body'>
                            <div class='table-responsive'>
                                <table class='table'>
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Gender</th>
                                            <th>Type</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    ";fetch_members($dbh); echo"
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
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
