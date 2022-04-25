<?php
session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
include('config.php');

$added = false;


if(isset($_POST['submit'])){
	$u_card = $_POST['card_no'];
	$u_f_name = $_POST['user_first_name'];
	$u_l_name = $_POST['user_last_name'];
	$u_father = $_POST['user_father'];
	$u_aadhar = $_POST['user_aadhar'];
	$u_birthday = $_POST['user_dob'];
	$u_gender = $_POST['user_gender'];
	$u_email = $_POST['user_email'];
	$u_phone = $_POST['user_phone'];
	$u_state = $_POST['state'];
	$u_dist = $_POST['dist'];
	$u_village = $_POST['village'];
	$u_police = $_POST['police_station'];
	$u_pincode = $_POST['pincode'];
	$u_mother = $_POST['user_mother'];
	$u_family = $_POST['family'];
	$u_staff_id = $_POST['staff_id'];
	

	$msg = "";
	$image = $_FILES['image']['name'];
	$target = "upload_images/".basename($image);

	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  		$msg = "Image uploaded successfully";
  	}else{
  		$msg = "Failed to upload image";
  	}

  	$insert_data = "INSERT INTO student_data(u_card, u_f_name, u_l_name, u_father, u_aadhar, u_birthday, u_gender, u_email, u_phone, u_state, u_dist, u_village, u_police, u_pincode, u_mother, u_family, staff_id,image,uploaded) VALUES ('$u_card','$u_f_name','$u_l_name','$u_father','$u_aadhar','$u_birthday','$u_gender','$u_email','$u_phone','$u_state','$u_dist','$u_village','$u_police','$u_pincode','$u_mother','$u_family','$u_staff_id','$image',NOW())";
  	$run_data = mysqli_query($con,$insert_data);

  	if($run_data){
		  $added = true;
  	}else{
  		echo "Data not insert";
  	}

}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Data Mahasiswa</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
	<a><img src="images\logo-unesa.png" alt="" width="100px" style="margin-top:20px"></a>
	<center><h1>Data Mahasiswa Universitas Negeri Surabaya</h1></center><br><hr>


<?php
	if($added){
		echo "
			<div class='btn-success' style='padding: 15px; text-align:center;'>
				Data Mahasiswa Berhasil Diinputkan.
			</div><br>
		";
	}

?>


	<a href="logout.php" class="btn btn-success"><i class="fa fa-lock"></i> Logout</a>
	<button class="btn btn-success" type="button" data-toggle="modal" data-target="#myModal">
	<i class="fa fa-plus"></i> Add New Student
	</button>
	<a href="#" class="btn btn-success pull-right"><i class="fa fa-download"></i> Export Data</a><hr>
		<table class="table table-bordered table-striped table-hover" id="myTable">
		<thead>
			<tr>
			   <th class="text-center" scope="col">No</th>
				<th class="text-center" scope="col">Nama</th>
				<th class="text-center" scope="col">NIM</th>
				<th class="text-center" scope="col">No Telepon</th>
				<th class="text-center" scope="col">Staff Id</th>
				<th class="text-center" scope="col">View</th>
				<th class="text-center" scope="col">Edit</th>
				<th class="text-center" scope="col">Delete</th>
			</tr>
		</thead>
		
			<?php
        	$get_data = "SELECT * FROM student_data order by 1 desc";
        	$run_data = mysqli_query($con,$get_data);
			$i = 0;
        	while($row = mysqli_fetch_array($run_data))
        	{
				$sl = ++$i;
				$id = $row['id'];
				$u_card = $row['u_card'];
				$u_f_name = $row['u_f_name'];
				$u_l_name = $row['u_l_name'];
				$u_phone = $row['u_phone'];
				$u_family = $row['u_family'];
				$u_staff_id = $row['staff_id'];

        		$image = $row['image'];

        		echo "

				<tr>
				<td class='text-center'>$sl</td>
				<td class='text-left'>$u_f_name   $u_l_name</td>
				<td class='text-left'>$u_card</td>
				<td class='text-left'>$u_phone</td>
				<td class='text-center'>$u_staff_id</td>
			
				<td class='text-center'>
					<span>
					<a href='#' class='btn btn-success mr-3 profile' data-toggle='modal' data-target='#view$id' title='Prfile'><i class='fa fa-address-card-o' aria-hidden='true'></i></a>
					</span>
					
				</td>
				<td class='text-center'>
					<span>
					<a href='#' class='btn btn-warning mr-3 edituser' data-toggle='modal' data-target='#edit$id' title='Edit'><i class='fa fa-pencil-square-o fa-lg'></i></a>

					     
					    
					</span>
					
				</td>
				<td class='text-center'>
					<span>
					
						<a href='#' class='btn btn-danger deleteuser' title='Delete'>
						     <i class='fa fa-trash-o fa-lg' data-toggle='modal' data-target='#$id' style='' aria-hidden='true'></i>
						</a>
					</span>
					
				</td>
			</tr>


        		";
        	}
        	?>
		</table>
	</div>


	<!---Add in modal---->

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
		<center><h1>Insert Data</h1></center>
    
      </div>
      <div class="modal-body">
        <form method="POST" enctype="multipart/form-data">
			
<div class="form-row">
<div class="form-group col-md-6">
<label for="inputEmail4">NIM</label>
<input type="text" class="form-control" name="card_no" placeholder="Enter 12-digit Student Id." maxlength="12" required>
</div>
<div class="form-group col-md-6">
<label for="inputPassword4">No Telepon</label>
<input type="phone" class="form-control" name="user_phone" placeholder="Enter 12-digit Mobile no." maxlength="12" required>
</div>
</div>


<div class="form-row">
<div class="form-group col-md-6">
<label for="firstname">First Name</label>
<input type="text" class="form-control" name="user_first_name" placeholder="Enter First Name">
</div>
<div class="form-group col-md-6">
<label for="lastname">Last Name</label>
<input type="text" class="form-control" name="user_last_name" placeholder="Enter Last Name">
</div>
</div>


<div class="form-row">
<div class="form-group col-md-6">
<label for="fathername">Nama Ayah</label>
<input type="text" class="form-control" name="user_father" placeholder="Enter Father's Name">
</div>
<div class="form-group col-md-6">
<label for="mothername">Nama Ibu</label>
<input type="text" class="form-control" name="user_mother" placeholder="Enter Mother's Name">
</div>
</div>


<div class="form-row">
<div class="form-group col-md-6">
<label for="email">Email Address</label>
<input type="email" class="form-control" name="user_email" placeholder="Enter Email Address">
</div>
<div class="form-group col-md-6">
<label for="aadharno">NIK</label>
<input type="text" class="form-control" name="user_aadhar" maxlength="12" placeholder="Enter 12-digit NIK ">
</div>
</div>

<div class="form-row">
<div class="form-group col-md-6">
<label for="inputState">Jenis Kelamin</label>
<select id="inputState" name="user_gender" class="form-control">
  <option selected>Choose...</option>
  <option>Male</option>
  <option>Female</option>
</select>
</div>
<div class="form-group col-md-6">
<label for="inputPassword4">Tanggal Lahir</label>
<input type="date" class="form-control" name="user_dob" placeholder="Enter Tanggal Lahir">
</div>
</div>


<div class="form-group">
<label for="family">Family Member's</label>
    <textarea class="form-control" name="family" placeholder="Enter Jumlah Keluarga" rows="3"></textarea>
</div>

<div class="form-group">
<label for="inputAddress">Kelurahan</label>
<input type="text" class="form-control" name="village" placeholder="Enter Nama Kelurahan">
</div>
<div class="form-group">
<label for="inputAddress2">Kode Pos</label>
<input type="text" class="form-control" name="police_station" placeholder="Enter Kode Pos">
</div>
<div class="form-row">
<div class="form-group col-md-6">
<label for="inputCity">Kota</label>
<input type="text" class="form-control" name="dist" placeholder="Enter Nama Kota">
</div>
<div class="form-group col-md-4">
<label for="inputState">Negara</label>
<select name="state" class="form-control">
  <option selected>Choose...</option>
  <option value="Indonesia">Indonesia</option>
  <option value="Singapura">Singapura</option>
  <option value="Malaysia">Malaysia</option>
  <option value="Jepang">Jepang</option>
</select>
</div>
<div class="form-group col-md-2">
<label for="inputZip">RT/RW</label>
<input type="text" class="form-control" name="pincode">
</div>
</div>

<div class="form-group">
<label for="inputAddress">Staff Id yang menginputkan data mahasiswa</label>
<input type="text" class="form-control" name="staff_id" maxlength="12" placeholder="Enter 12-digit Staff Id">
</div>
			
        	<div class="form-group">
        		<label>Image</label>
        		<input type="file" name="image" class="form-control" >
        	</div>
        	
        	 <input type="submit" name="submit" class="btn btn-info btn-large" value="Submit">
        	
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<!------DELETE modal---->




<!-- Modal -->
<?php

$get_data = "SELECT * FROM student_data";
$run_data = mysqli_query($con,$get_data);

while($row = mysqli_fetch_array($run_data))
{
	$id = $row['id'];
	echo "

<div id='$id' class='modal fade' role='dialog'>
  <div class='modal-dialog'>

    <!-- Modal content-->
    <div class='modal-content'>
      <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal'>&times;</button>
        <h4 class='modal-title text-center'>Anda yakin ingin menghapusnya?</h4>
      </div>
      <div class='modal-body'>
        <a href='delete.php?id=$id' class='btn btn-danger' style='margin-left:250px'>Delete</a>
      </div>
      
    </div>

  </div>
</div>


	";
	
}


?>


<!-- View modal  -->
<?php 

// <!-- profile modal start -->
$get_data = "SELECT * FROM student_data";
$run_data = mysqli_query($con,$get_data);

while($row = mysqli_fetch_array($run_data))
{
	$id = $row['id'];
	$card = $row['u_card'];
	$name = $row['u_f_name'];
	$name2 = $row['u_l_name'];
	$father = $row['u_father'];
	$mother = $row['u_mother'];
	$gender = $row['u_gender'];
	$email = $row['u_email'];
	$aadhar = $row['u_aadhar'];
	$Bday = $row['u_birthday'];
	$family = $row['u_family'];
	$phone = $row['u_phone'];
	$address = $row['u_state'];
	$village = $row['u_village'];
	$police = $row['u_police'];
	$dist = $row['u_dist'];
	$pincode = $row['u_pincode'];
	$state = $row['u_state'];
	$time = $row['uploaded'];
	$image = $row['image'];
	echo "

		<div class='modal fade' id='view$id' tabindex='-1' role='dialog' aria-labelledby='userViewModalLabel' aria-hidden='true'>
		<div class='modal-dialog'>
			<div class='modal-content'>
			<div class='modal-header'>
				<h3 class='modal-title' id='exampleModalLabel'>Profile <i class='fa fa-user-circle-o' aria-hidden='true'></i></h3>
				<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
				<span aria-hidden='true'>&times;</span>
				</button>
			</div>
			<div class='modal-body'>
			<div class='container' id='profile'> 
				<div class='row'>
					<div class='col-sm-4 col-md-2'>
						<img src='upload_images/$image' alt='' style='width: 140px; height: 180px;' ><br>
		
						<i class='fa fa-id-card' aria-hidden='true'></i> $card<br>
						<i class='fa fa-phone' aria-hidden='true'></i> $phone  <br>
						Input Date : $time
					</div>
					<div class='col-sm-3 col-md-6'>
						<h3 class='text-primary'>$name $name2</h3>
						<p class='text-secondary'>
						<strong>Nama Ayah : </strong> $father <br>
						<strong>Nama Ibu : </strong>$mother <br>
						<strong>NIK : </strong> $aadhar <br>
						<i class='fa fa-venus-mars' aria-hidden='true'></i> $gender
						<br />
						<i class='fa fa-envelope-o' aria-hidden='true'></i> $email
						<br />
						<div class='card' style='width: 18rem;'>
						<i class='fa fa-users' aria-hidden='true'></i> Familiy :
								<div class='card-body'>
								<p> $family </p>
								</div>
						</div>
						
						<i class='fa fa-home' aria-hidden='true'> Alamat : </i> $village, $police, <br> $dist, $state - $pincode
						<br />
						</p>
						<!-- Split button -->
					</div>
				</div>

			</div>   
			</div>
			<div class='modal-footer'>
				<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
			</div>
			</form>
			</div>
		</div>
		</div> 


    ";
}


// <!-- profile modal end -->


?>





<!----edit Data--->

<?php

$get_data = "SELECT * FROM student_data";
$run_data = mysqli_query($con,$get_data);

while($row = mysqli_fetch_array($run_data))
{
	$id = $row['id'];
	$card = $row['u_card'];
	$name = $row['u_f_name'];
	$name2 = $row['u_l_name'];
	$father = $row['u_father'];
	$mother = $row['u_mother'];
	$gender = $row['u_gender'];
	$email = $row['u_email'];
	$aadhar = $row['u_aadhar'];
	$Bday = $row['u_birthday'];
	$family = $row['u_family'];
	$phone = $row['u_phone'];
	$address = $row['u_state'];
	$village = $row['u_village'];
	$police = $row['u_police'];
	$dist = $row['u_dist'];
	$pincode = $row['u_pincode'];
	$state = $row['u_state'];
	$staffCard = $row['staff_id'];
	$time = $row['uploaded'];
	$image = $row['image'];
	echo "

<div id='edit$id' class='modal fade' role='dialog'>
  <div class='modal-dialog'>

    <!-- Modal content-->
    <div class='modal-content'>
      <div class='modal-header'>
             <button type='button' class='close' data-dismiss='modal'>&times;</button>
             <h2 class='modal-title text-center'>Edit your Data</h2> 
      </div>

      <div class='modal-body'>
        <form action='edit.php?id=$id' method='post' enctype='multipart/form-data'>

		<div class='form-row'>
		<div class='form-group col-md-6'>
		<label for='inputEmail4'>NIM</label>
		<input type='text' class='form-control' name='card_no' placeholder='Enter 12-digit Student Id.' maxlength='12' value='$card' required>
		</div>
		<div class='form-group col-md-6'>
		<label for='inputPassword4'>No Telepon</label>
		<input type='phone' class='form-control' name='user_phone' placeholder='Enter 10-digit Mobile no.' maxlength='10' value='$phone' required>
		</div>
		</div>
		
		
		<div class='form-row'>
		<div class='form-group col-md-6'>
		<label for='firstname'>First Name</label>
		<input type='text' class='form-control' name='user_first_name' placeholder='Enter First Name' value='$name'>
		</div>
		<div class='form-group col-md-6'>
		<label for='lastname'>Last Name</label>
		<input type='text' class='form-control' name='user_last_name' placeholder='Enter Last Name' value='$name2'>
		</div>
		</div>
		
		
		<div class='form-row'>
		<div class='form-group col-md-6'>
		<label for='fathername'>Nama Ayah</label>
		<input type='text' class='form-control' name='user_father' placeholder='Enter First Name' value='$father'>
		</div>
		<div class='form-group col-md-6'>
		<label for='mothername'>Nama Ibu</label>
		<input type='text' class='form-control' name='user_mother' placeholder='Enter Last Name' value='$mother'>
		</div>
		</div>
		
		
		<div class='form-row'>
		<div class='form-group col-md-6'>
		<label for='email'>Email Address</label>
		<input type='email' class='form-control' name='user_email' placeholder='Enter Email id' value='$email'>
		</div>
		<div class='form-group col-md-6'>
		<label for='aadharno'>NIK</label>
		<input type='text' class='form-control' name='user_aadhar' maxlength='12' placeholder='Enter 12-digit Aadhar no. ' value='$aadhar'>
		</div>
		</div>
		
		<div class='form-row'>
		<div class='form-group col-md-6'>
		<label for='inputState'>Gender</label>
		<select id='inputState' name='user_gender' class='form-control' value='$gender'>
		  <option selected>$gender</option>
		  <option>Male</option>
		  <option>Female</option>
		</select>
		</div>
		<div class='form-group col-md-6'>
		<label for='inputPassword4'>Tanggal Lahir</label>
		<input type='date' class='form-control' name='user_dob' placeholder='Date of Birth' value='$Bday'>
		</div>
		</div>
		
		
		<div class='form-group'>
		<label for='family'>Family Member's</label>
			<textarea class='form-control' name='family' rows='3'>$family</textarea>
		</div>
		
		
		<div class='form-group'>
		<label for='inputAddress'>Kelurahan</label>
		<input type='text' class='form-control' name='village' placeholder='1234 Main St' value='$village'>
		</div>
		<div class='form-group'>
		<label for='inputAddress2'>Kode Pos</label>
		<input type='text' class='form-control' name='police_station' placeholder='Enter police station' value='$police'>
		</div>
		<div class='form-row'>
		<div class='form-group col-md-6'>
		<label for='inputCity'>Kabupaten</label>
		<input type='text' class='form-control' name='dist' value='$dist'>
		</div>
		<div class='form-group col-md-4'>
		<label for='inputState'>Negara</label>
		<select name='state' class='form-control'>
		  <option>$state</option>
		  <option value='Indonesia'>Indonesia</option>
		  <option value='Singapura'>Singapura</option>
		  <option value='Malaysia'>Malaysia</option>
		  <option value='Jepang'>Jepang</option>
		</select>
		</div>
		<div class='form-group col-md-2'>
		<label for='inputZip'>RT/RW</label>
		<input type='text' class='form-control' name='pincode' value='$pincode'>
		</div>
		</div>
		
		
		<div class='form-group'>
		<label for='inputAddress'>Staff Id yang menginputkan data mahasiswa</label>
		<input type='text' class='form-control' name='staff_id' maxlength='12' placeholder='Enter 12-digit Staff Id' value='$staffCard'>
		</div>
        	

        	<div class='form-group'>
        		<label>Image</label>
        		<input type='file' name='image' class='form-control'>
        		<img src = 'upload_images/$image' style='width:50px; height:50px'>
        	</div>

        	
        	
			 <div class='modal-footer'>
			 <input type='submit' name='submit' class='btn btn-info btn-large' value='Submit'>
			 <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
		 </div>


        </form>
      </div>

    </div>

  </div>
</div>


	";
}


?>

<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();

    });
  </script>

</body>
</html>
