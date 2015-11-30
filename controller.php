<?php
require 'sql_pdo_rw.php';

Function get_chat($dbh) {
$sql= "SELECT * FROM chat ORDER BY ID DESC"; 
$stmt = $dbh->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll();
foreach($result as $row){
$sql_id = $row['ID'];
$user_name = $row['name'];
$message = $row['message'];
$time = $row['time'];
$readabletime = gmdate("H:i - d/m/y", $time);
if ( $sql_id & 1 ) { echo "
 <li class='left clearfix'>
 <span class='chat-img pull-left'>
 <img src='http://placehold.it/50/55C1E7/fff' alt='User Avatar' class='img-circle' />
 </span>
 <div class='chat-body clearfix'>
 <div class='header'>
 <strong class='primary-font'>".$user_name."</strong>
 <small class='pull-right text-muted'>
 <i class='fa fa-clock-o fa-fw'></i> ".$readabletime."
 </small>
 </div>
 <p>
 ".$message."
 </p>
 </div>
 </li>";
} else { echo "
 <li class='right clearfix'>
 <span class='chat-img pull-right'>
 <img src='http://placehold.it/50/FA6F57/fff' alt='User Avatar' class='img-circle' />
 </span>
 <div class='chat-body clearfix'>
 <div class='header'>
 <small class=' text-muted'>
 <i class='fa fa-clock-o fa-fw'></i>".$readabletime."</small>
 <strong class='pull-right primary-font'>".$user_name."</strong>
 </div>
 <p>
 ".$message."
 </p>
 </div>
 </li>";
}
    }
}

Function count_files() {
    $directory = "/upload/final";
    $files = scandir($directory);
    $num_files = count($files);
    echo $num_files-2;
}

Function count_chat_messages($dbh) { 
$sql= "SELECT COUNT(*) AS messages FROM chat"; 
$stmt = $dbh->prepare($sql);
$stmt->execute();
$obj = $stmt->fetchObject();
$messages = $obj->messages;
echo $messages;
}

Function count_registered_users($dbh) { 
$sql= "SELECT COUNT(*) AS members FROM admin"; 
$stmt = $dbh->prepare($sql);
$stmt->execute();
$obj = $stmt->fetchObject();
$members = $obj->members;
echo $members;
}

Function count_choir_members($dbh) { 
$sql= "SELECT COUNT(*) AS members FROM member"; 
$stmt = $dbh->prepare($sql);
$stmt->execute();
$obj = $stmt->fetchObject();
$members = $obj->members;
echo $members;
}

Function fetch_users($dbh) {
$sql = "SELECT ID,name,canupload,canadduser,superuser FROM admin ORDER BY ID asc";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll();
foreach($result as $row){
       $id = $row['ID'];
       $name = $row['name'];
       $add = $row['canupload'];
       $edit = $row['canadduser'];
       $superuser = $row['superuser'];
       $color = "info";
       if ($add == 1) { $color = "success";$add = str_replace("1", "x", $add); } else { $add = str_replace("0", "", $add); }
       if ($edit == 1) { $color = "warning";$edit = str_replace("1", "x", $edit); } else { $edit = str_replace("0", "", $edit); }
       if ($superuser == 1) { $color = "danger";$superuser = str_replace("1", "x", $superuser); } else { $superuser = str_replace("0", "", $superuser); }
       echo "
       <tr class='$color'>
       <td>$id</td>
       <td>$name</td>
       <td>$add</td>
       <td>$edit</td>
       <td>$superuser</td>
       <td><button class='btn btn-danger'>Delete</button></td>
       </tr>
       ";
    }
}

Function fetch_members($dbh) {
$sql = "SELECT * FROM member ORDER BY ID asc";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll();
foreach($result as $row){
       $id = $row['ID'];
       $name = $row['name'];
       $gender = $row['gender'];
       $type = $row['type'];
       if ($gender == "female") { $gender = "fa-female"; } else { $gender = "fa-male"; }
       echo "
       <tr class='$color'>
       <td>$id</td>
       <td>$name</td>
       <td><i class='fa $gender'></i></td>
       <td>$type</td>
       <td><a href='deletesinger.php?id=$id'><button class='btn btn-danger'>Delete</button></a></td>
       </tr>
       ";
    }  
}

Function user_profile($dbh) {
$sql= "SELECT * FROM admin"; 
$stmt = $dbh->prepare($sql);
$stmt->execute();
$obj = $stmt->fetchObject();
$name = $obj->name;
$email = $obj->email;
$add = $obj->canupload;
$edit = $obj->canadduser;
$superuser = $obj->superuser;
$recovery = $obj->recovery;
       if ($add == 1) { $color = "success";$add = str_replace("1", "x", $add); } else { $add = str_replace("0", "", $add); }
       if ($edit == 1) { $color = "warning";$edit = str_replace("1", "x", $edit); } else { $edit = str_replace("0", "", $edit); }
       if ($superuser == 1) { $color = "danger";$superuser = str_replace("1", "x", $superuser); } else { $superuser = str_replace("0", "", $superuser); }
       if ($recovery == 1) { $color = "danger";$recovery  = str_replace("1", "Yes", $recovery ); } else { $recovery  = str_replace("0", "No", $recovery); }
echo "
<tr>
<td>Name:</td>
<td>$name</td>
</tr>
<tr>
<td>Email</td>
<td>$email</td>
</tr>
<tr>
<td>Can upload files</td>
<td>$add</td>
</tr>
<tr>
<td>Can edit users</td>
<td>$edit</td>
</tr>
<tr>
<td>Is Superuser</td>
<td>$superuser</td>
</tr>
<tr>
<td>User in Recovery mode</td>
<td>$recovery</td>
</tr>
";
}

Function get_members_option($dbh) {
    $sql = "SELECT * FROM member ORDER BY ID asc";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll();
foreach($result as $row){
       $id = $row['ID'];
       $name = $row['name'];
       echo "
       <option value='$id'>$name</option>
       ";
    }  
}

Function fetch_uploads($dbh) {
$sql = "SELECT * FROM main ORDER BY ID asc";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll();
foreach($result as $row){
$id = $row['ID'];
$member = $row['choir_member'];
$note = $row['note'];
$vocal = $row['tone'];
$velocity = $row['velocity'];
$connection = $row['connection_type'];
if ($connection == '2') { $connection = "Connected Tone"; } else { $connection = "Single Tone"; }

//member
$sql= "SELECT name,type FROM member WHERE ID='$member'"; 
$stmt = $dbh->prepare($sql);
$stmt->execute();
$obj = $stmt->fetchObject();
$function = $obj->type;
$name = $obj->name;

$vocal_human = strtr($vocal, array(
   '1' => 'C',
   '2' => 'Db',
   '3' => 'D',
   '4' => 'Eb',
   '5' => 'E',
   '6' => 'F',
   '7' => 'Gb',
   '8' => 'G',
   '9' => 'Ab',
   '10' => 'A',
   '11' => 'Bb',
   '12' => 'H',
));

        echo "
<tr class='odd gradeX'>
<td>$id</td>
<td>$name</td>
<td>$vocal_human</td>
<td>$function</td>
<td>$velocity</td>
<td>$connection</td>
<td>$note</td>
<td><a href='editfile.php?id=$id'><button type='button' class='btn btn-success btn-circle center-block'><i class='fa fa-pencil'></i></a></td>
</tr>
       ";
    }  
}

Function get_file_info($dbh,$id) {
$sql= "SELECT choir_member,note FROM main"; 
$stmt = $dbh->prepare($sql);
$stmt->execute();
$obj = $stmt->fetchObject();
$choir_member = $obj->choir_member;
$note = $obj->note;

//member name
$sql= "SELECT name FROM member WHERE ID='$choir_member'"; 
$stmt = $dbh->prepare($sql);
$stmt->execute();
$obj = $stmt->fetchObject();
$member = $obj->name;
//

$sql1= "SELECT * FROM single_sound"; 
$stmt1 = $dbh->prepare($sql1);
$stmt1->execute();
$obj1 = $stmt1->fetchObject();
$vocal = $obj1->vocal;
$velocity = $obj1->velocity;
$vibratio = $obj1->vibratio;
$type = $obj1->type;
$frequency = $obj1->frequency;
$start_marker1 = $obj1->start_marker1;
$start_marker2 = $obj1->start_marker2;
$end_marker1 = $obj1->end_marker1;
$end_marker2 = $obj1->end_marker2;

$vocal = strtr($vocal, array(
   '1' => 'C',
   '2' => 'Db',
   '3' => 'D',
   '4' => 'Eb',
   '5' => 'E',
   '6' => 'F',
   '7' => 'Gb',
   '8' => 'G',
   '9' => 'Ab',
   '10' => 'A',
   '11' => 'Bb',
   '12' => 'H',
));


echo "
<tr>
<td>ID/Name</td>
<td>$id</td>
<td></td>
</tr>
<tr>
<td>Choir Member</td>
<td>$member</td>
<td> 
<select name='member' class='form-control'>
";get_members_option($dbh);echo"
</select></td>
</tr>
<tr>
<td>File Note</td>
<td>$note</td>
<td>
<input type='text' name='note' class='form-control' placeholder='note for file (optional)'>
</td>
</tr>

<tr>
<td>Vowel</td>
<td>$vocal</td>
<td>
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
</td>
</tr>
<tr>
<td>Velocity</td>
<td>$velocity</td>
<td>
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
</td>
</tr>
<tr>
<td>Vibratio</td>
<td>$vibratio</td>
<td><input type='text' name='note' class='form-control' placeholder='INT'></td>
</tr>
<tr>
<td>Function</td>
<td>$type</td>
<td>
<select name='velocity' class='form-control'>
                                                <option value='1'>Belting</option>
                                                <option value='2'>Curbing</option>
                                                <option value='3'>Overdrive</option>
                                                <option value='4'>Air</option>
</select>
</td>
</tr>
<tr>
<td>Octav</td>
<td>$octav</td>
<td>
<select name='octav' class='form-control'>
                                                <option value='1'>1</option>
                                                <option value='2'>2</option>
                                                <option value='3'>3</option>
                                                <option value='4'>4</option>
                                                <option value='5'>5</option>
                                                <option value='6'>6</option>
                                                <option value='7'>7</option>
                                                <option value='8'>8</option>
</select>
</td>
</tr>
<tr>
<td>Frequency</td>
<td>$frequency</td>
<td><input type='text' name='note' class='form-control' placeholder='FLOAT'></td>
</tr>
<tr>
<td>Start Marker 1</td>
<td>$start_marker1</td>
<td><input type='text' name='note' class='form-control' placeholder='INT'></td>
</tr>
<tr>
<td>Start Marker 2</td>
<td>$start_marker2</td>
<td><input type='text' name='note' class='form-control' placeholder='INT'></td>
</tr>
<tr>
<td>End Marker 1</td>
<td>$end_marker1</td>
<td><input type='text' name='note' class='form-control' placeholder='INT'></td>
</tr>
<tr>
<td>End Marker 2</td>
<td>$end_marker2</td>
<td><input type='text' name='note' class='form-control' placeholder='INT'></td>
</tr>
";
}
