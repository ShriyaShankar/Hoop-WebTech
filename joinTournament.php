<html>
    <head>
        <!--Include jQuery and Bootstrap scripts-->
        <title>Host Tournament</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="main.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <script src="main.js"></script>
        <style>
            table {
                width:95%;
            }
            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
            }
            th, td {
                padding: 15px;
                text-align: left;
            }
            table#t01 tr:nth-child(even) {
                background-color: #eee;
            }
            table#t01 tr:nth-child(odd) {
                background-color: #fff;
            }
            table#t01 th {
                background-color: black;
                color: white;
            }
            </style>
    </head>

    <body id="body">
    <ul id = "nav_bar">
    
    <li class="navLi"><a id="nav1" href = "home.html">Home</a></li>
    <li class="navLi"><a id="nav2" href = "faq.html">FAQs</a></li>
    <li class="navLi" id="litext">HOOP - A SPORTS FORUM</li>
    <li class="navLi" style="float:right"><a id = "nav3" href = "login.html">Logout</a></li>
    <li class="navLi" style="float:right"><a id = "nav3" href = "about.html">About/Contact Us</a></li>
 
  </ul>

  <br><br>
        
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
            else{
            // echo "Connection successful";
            }

            // Query to select respective fields from the table
            $sql = "SELECT * FROM host_tournament";
            $result = $conn->query($sql);
            
            echo '<table border="0" cellspacing="2" cellpadding="2"> 
                
                <tr> 
                    <td> <font face="Arial"><b>ID</font> </td> 
                    <td> <font face="Arial"><b>Host</font> </td> 
                    <td> <font face="Arial"><b>Sport</font> </td> 
                    <td> <font face="Arial"><b>Start Date</font> </td> 
                    <td> <font face="Arial"><b>End Date</font> </td>
                    <td> <font face="Arial"><b>Tournament Name</font> </td>
                    <td> <font face="Arial"><b>Venue</font> </td>
                    <td> <font face="Arial"><b>Contact Name</font> </td>
                    <td> <font face="Arial"><b>Contact Number</font> </td>

                </tr>';
 
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $field1name = $row["ID"];
                        $field2name = $row["Host"];
                        $field3name = $row["Sport"];
                        $field4name = $row["StartDate"];
                        $field5name = $row["EndDate"];
                        $tournament_name=$row['tournament_name'];
                        $tournament_venue=$row['tournament_venue'];
                        $contact_name=$row['contact_name'];
                        $contact_number=$row['contact_number'];
                    
                        echo '<tr> 
                                <td>'.$field1name.'</td> 
                                <td>'.$field2name.'</td> 
                                <td>'.$field3name.'</td>
                                <td>'.$field4name.'</td> 
                                <td>'.$field5name.'</td>
                                <td>'.$tournament_name.'</td>
                                <td>'.$tournament_venue.'</td>
                                <td>'.$contact_name.'</td>
                                <td>'.$contact_number.'</td>
                            </tr>';
                }
                $result->free();
            } 
        ?>
    </body>
</html>
