<?php

require_once 'db.php';
$db = new Database();

if (isset($_POST['action']) && $_POST['action'] == "view") {
    $output = '';
    $data = $db->read();
    if ($db->totalRowCount() > 0) {
        $output .= '<table class="table table-striped table-sm table-bordered">
        <thead>
            <tr class="text-center">
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Age</th>
                <th>Email Address</th>
                <th>Contact No.</th>
                <th>
                    Action
                </th>
            </tr>
        </thead>
        <tbody>';
        foreach ($data as $row) {
            $output .= '<tr class="text-center text-secondary">
            <td>' . $row['id'] . '</td>
            <td>' . $row['fname'] . '</td>
            <td>' . $row['lname'] . '</td>
            <td>' . $row['age'] . '</td>
            <td>' . $row['email'] . '</td>
            <td>' . $row['contact'] . '</td>
            <td>
                <a href="#" title="View Details" class="text-success infoBtn" id="'.$row['id'].'"><i class="fas fa-info-circle fa-lg"></i></a>&nbsp;&nbsp;
                <a href="#" title="Edit" class="text-primary editBtn" data-toggle="modal" data-target="#editModal" id="'.$row['id'].'"><i class="fas fa-edit fa-lg"></i></a>&nbsp;&nbsp;
                <a href="#" title="Delete" class="text-danger delBtn" id="'.$row['id'].'"><i class="fas fa-trash-alt fa-lg"></i></a>
            </td>
            </tr>';
        }
        $output .= '</tbody></table>';
        echo $output;
    }
    else{
        echo '<h3 class="text-center text-secondary mt-5">:(NO any user present in the Database!)</h3>';
    }
}

// $name_error = '';  
// $email_error = '';  
// $cont_error = '';  
// $output = '';
// if(isset($_POST['insert'])){
//     if(empty($_POST["fname"]))
//       {
//         $name_error = "<p>Please Enter Name</p>";  
//       }
//     else 
//     {
//         if(!preg_match("/^[a-zA-Z ]*$/", $_POST["fname"]))  
//         {  
//             $name_error = "<p>Only Letters and whitespace allowed</p>";  
//         }  
//     }

//     if(empty($_POST["lname"]))
//       {  
//            $name_error = "<p>Please Enter Name</p>";  
//       } 
//     else 
//     {
//         if(!preg_match("/^[a-zA-Z ]*$/", $_POST["lname"]))  
//         {  
//             $name_error = "<p>Only Letters and whitespace allowed</p>";  
//         }  
//     }

//     if(empty($_POST["email"]))  
//       {  
//            $email_error = "<p>Please Enter Email</p>";  
//       }  
//       else  
//       {  
//            if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))  
//            {  
//                 $email_error = "<p>Invalid Email formate</p>";  
//            }  
//       }
// }

if (isset($_POST['action']) && $_POST['action'] == "insert"){
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $age=$_POST['age'];
    $email=$_POST['email'];
    $contact=$_POST['contact'];

    if($fname==NULL||$lname==NULL||$age==NULL||$email==NULL||$contact==NULL){
        $result=[
            'status'=>00,
            'message'=> 'ALL fields are required',
            'id'=>0
        ];
        echo json_encode($result);
        return;
    }
    if(!preg_match("/^[a-zA-Z ]*$/", $fname)){
        $result=[
            'status'=>422,
            'message'=>'First Name : Only alphabet and white space are allowed',
            'id'=>'1'
        ];
        echo json_encode($result);
        return;
    }
    // else{
    //     $result=['status'=>204];
    //     echo json_encode($result);
    //     return;
    // }
    if(!preg_match("/^[a-zA-Z ]*$/", $lname)){
        $result=[
            'status'=>422,
            'message'=>'Last Name : Only alphabet and white space are allowed',
            'id'=>'2'
        ];
        echo json_encode($result);
        return;
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result=[
            'status'=>422,
            'message'=>'Email: Invalid email format',
            'id'=>'3'
        ];
        echo json_encode($result);
        return;
    }

    if(!preg_match("/^[0-9]*$/",$contact)){
        $result=[
            'status'=>422,
            'message'=>'Number: Only numeric value is allowed',
            'id'=>'4'
        ];
        echo json_encode($result);
        return;
    }
    if(strlen($contact)!=10){
        $result=[
            'status'=>422,
            'message'=>'Number: Mobile no must contain 10 digits.',
            'id'=>'5'            
        ];
        echo json_encode($result);
        return;
    }



    $db->insert($fname,$lname,$age,$email,$contact);

    if($db){
        $result=[
            'status'=>200,
            'message'=>'User created Successfully'
        ];
        echo json_encode($result);
        return;
    }
    else{
        $result=[
            'status'=>500,
            'message'=>'Error in creating user'
        ];
        echo json_encode($result);
        return;
    }
}

if(isset($_POST['edit_id'])){
    $id=$_POST['edit_id'];

    $row = $db->getUserById($id);
    echo json_encode($row);
}

if (isset($_POST['action']) && $_POST['action'] == "update"){
    $id=$_POST['id'];
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $age=$_POST['age'];
    $email=$_POST['email'];
    $contact=$_POST['contact'];


    if($fname==NULL||$lname==NULL||$age==NULL||$email==NULL||$contact==NULL){
        $result=[
            'status'=>422,
            'message'=> 'All fields are required'
        ];
        echo json_encode($result);
        return;
    }
    if(!preg_match("/^[a-zA-Z ]*$/", $fname)){
        $result=[
            'status'=>422,
            'message'=>'First Name : Only alphabet and white space are allowed'
        ];
        echo json_encode($result);
        return;
    }
    if(!preg_match("/^[a-zA-Z ]*$/", $lname)){
        $result=[
            'status'=>422,
            'message'=>'Last Name : Only alphabet and white space are allowed'
        ];
        echo json_encode($result);
        return;
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result=[
            'status'=>422,
            'message'=>'Email: Invalid email format'
        ];
        echo json_encode($result);
        return;
    }

    if(!preg_match("/^[0-9]*$/",$contact)){
        $result=[
            'status'=>422,
            'message'=>'Number: Only numeric value is allowed'
        ];
        echo json_encode($result);
        return;
    }
    if(strlen($contact)!=10){
        $result=[
            'status'=>422,
            'message'=>'Number: Mobile no must contain 10 digits.'
        ];
        echo json_encode($result);
        return;
    }
    

    $db->update($id,$fname,$lname,$age,$email,$contact);

    if($db){
        $result=[
            'status'=>200,
            'message'=>'User Updated Successfully'
        ];
        echo json_encode($result);
        return;
    }
    else{
        $result=[
            'status'=>500,
            'message'=>'Error in Updating user'
        ];
        echo json_encode($result);
        return;
    }

}

if(isset($_POST['del_id'])){
    $id=$_POST['del_id'];

    $db->delete($id);
}


if(isset($_POST['info_id'])){
    $id=$_POST['info_id'];

    $row = $db->getUserById($id);
    echo json_encode($row);

}

//export
if(isset($_GET['export']) && $_GET['export'] == "excel"){
    header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename=users.xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    $data = $db->read();
    echo '<table border="1">';
    echo '<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Age</th><th>Email Id</th><th>Contact No. </th></tr>';

    foreach($data as $row){
        echo '<tr>
            <td>'.$row['id'].'</td>
            <td>'.$row['fname'].'</td>
            <td>'.$row['lname'].'</td>
            <td>'.$row['age'].'</td>
            <td>'.$row['email'].'</td>
            <td>'.$row['contact'].'</td>
            </tr>';
    }
    echo '</table>';
}

?>