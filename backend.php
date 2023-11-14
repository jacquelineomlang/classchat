<?php
$server_name = "localhost";
$username = "root";
$password = "";
$db_name = "classchat_database";

/*connect to mysql*/
$conn = mysqli_connect($server_name, $username, $password, $db_name);

/*check if the database is successfully connected*/
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//function for adding in database
function addDatabase( $conn, $id_number, $name, $email, $password_encrypted){
    //inserting the data into student_table
    $query = "INSERT INTO student_table (ID_number, Name, Email, Password) 
    VALUES('$id_number', '$name', '$email', '$password_encrypted')";
    mysqli_query($conn, $query);
    header('location: try.php');
}

//check id
function checkIDExist($conn, $id_number) {
    $check_query = "SELECT * FROM student_table WHERE ID_number = '$id_number'";
    $result = mysqli_query($conn, $check_query);

    if (!$result) {
        // Handle the query error if needed
        die("Error in checkIDExist query: " . mysqli_error($conn));
    }

    return mysqli_num_rows($result) > 0;
}


//check if the signup button for the student has been click
if (isset($_POST['signupStudent_btn'])) {
    $id_number = $_POST['idNumberStudentSignup'];
    $name = $_POST['nameStudentSignup'];
    $email = $_POST['emailStudentSignup'];
    $password = $_POST['passwordStudentSignup'];
    $confirm_password = $_POST['confirmPasswordStudentSignup'];
    $carsu_email = "@carsu.edu.ph";

    $id_exists = checkIDExist($conn, $id_number);

    if(!$id_exists){
        //check if the password and confirm password match
        if ($password === $confirm_password) {

            //check if the password contains special characters like !@$%&
            if (preg_match('/[!@$%&]/', $password)) {

                //check if the password is 10 characters long
                if (strlen($password) === 10) {
                    //encrypt the password
                    $password_encrypted = md5($password);

                    //calling the function to add in the database
                    addDatabase($conn, $id_number, $name, $email, $password_encrypted);
                }
            }
        }
    }else{
        $ID_error_msg = "<small class='text-danger error_msg text-center'>ID Number is already exists</small>";
    }
}

//check if the signup button for the employee has been click
if (isset($_POST['signupEmployee_btn'])) {
    $employee_number = $_POST['employeeNumberSignup'];
    $name = $_POST['nameEmployeeSignup'];
    $email = $_POST['emailEmployeeSignup'];
    $password = $_POST['passwordEmployeeSignup'];

    //encrypt the password
    $password_encrypted = md5($password);

    //inserting the data into employee_table
    $query = "INSERT INTO employee_table (Employee_number, Name, Email, Password) 
  			  VALUES('$employee_number', '$name', '$email', '$password_encrypted')";
    mysqli_query($conn, $query);
    header('location: try.php');
}
