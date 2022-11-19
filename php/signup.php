<?php

session_start();
include_once "config.php";

$fname = mysqli_real_escape_string($conn, $_POST['fname']);
$lname = mysqli_real_escape_string($conn, $_POST['lname']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password)){
    // email validation
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        // let's check email already exist or not
        $sql = mysqli_query($conn, "SELECT email FROM users WHERE email = '{$email}'");
        if(mysqli_num_rows($sql) > 0){
            echo "$email - already exist!";
        }else{
            // let's checl user upload file or not 
            if(isset($_FILES['image'])){
                $img_name = $_FILES['image']['name'];     //user uploaded img name
                $img_type = $_FILES['image']['type'];     //user uploaded img type
                $tmp_name = $_FILES['image']['tmp_name']; //this temporary name used to save/move file in our folder
                $img_size = $_FILES['image']['size'];      //user uploaded img size
                //let's get the extension of the uploaded file

                $img_explode = explode('.', $img_name);
                $img_ext = end($img_explode);            //last element after (.)

                $extensions = ['png','jpeg','jpg'];      //supported file extension

                if(in_array($img_ext, $extensions) === true){//if extension is valid
                    $time = time();   //using time for unique file name

                    // let's move the user uploaded file to our folder 
                    $new_img_name = $time.$img_name;

                    if(move_uploaded_file($tmp_name, "images/".$new_img_name)){//if file moved successfully

                        $status = "Active Now"; //if user signed up , status gonna be Active Now
                        $random_id = rand(time(), 10000000); //random id for user


                        //let's insert all user inside db table

                        $sql2 = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, email, password, img, status) VALUES ({$random_id}, '{$fname}', '{$lname}', '{$email}', '{$password}', '{$new_img_name}', '{$status}')");

                        if($sql2){
                            $sql3 = mysqli_query($conn, "SELECT * FROM users WHERE email='{$email}'");
                            if(mysqli_num_rows($sql3) > 0){
                                $row = mysqli_fetch_assoc($sql3);
                                $_SESSION['unique_id'] = $row['unique_id'];    //using unique id for session variable
                                echo "success";
                            }

                        }else{
                            echo "Something went wrong!";
                        }
                    }  

                }
                
               

                else{
                    echo "Please select an image file - jpeg,jpg,png!";
                }
            }else{
                echo "Please select an Image file!";
            }
        }


    }else{
        echo "$email - This is not a valid email!";
    }
}else{
    echo "All input fields are required";
}



?>