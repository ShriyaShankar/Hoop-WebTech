<?php

    //Database credentials
    $servername = "localhost";
    $username = "sportsforum";
    $password = "sp0rtsf0rum";
    $dbname = "sportsforum";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    else
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "SELECT Email,Password FROM registration";
        $result = $conn->query($sql);
        $chk = 0;
        if($email=='' || $password == '')
        {
            echo('<script> alert("alert("Please enter details");
            document.getElementById("login").href = "login.html";</script>');
        }
        elseif ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if($row['Email']==$email)
                {
                    //decrypting password
                    $ciphering = "AES-128-CTR";
                    $options = 0; 
                    $decryption_iv = '1234567891011121'; //decryption initialization vector
                    $decryption_key = 'SportsForum';
                    $decryption=openssl_decrypt ($row['Password'], $ciphering, $decryption_key, $options, $decryption_iv); 
                    if($decryption==$password)
                    {
                        $chk = 1;
                        echo "Login Successful";
                    break;
                    }
                    else{
                        $chk = -1;
                        echo "Incorrect Password. Please enter details again.";
                    }
                }
            }
            if($chk==0)
            {
                echo "<script> alert('Email not found. Please register.')</script>";
            }
            elseif($chk==1)
            {
                echo("<script>alert('Login successful');
                window.location.href = 'home.html';</script>")
            }
        }
    }