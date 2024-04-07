<?php
include("data.php");
$std_id = $_SESSION['std_id'];
$msg = "";
if (!empty($_REQUEST['msg'])) {
    $msg = $_REQUEST['msg'];
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viweport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <title>Student Dashboard</title>
    <style>
        .lib-logo {
            height: 6%;
            width: 35%;
            margin: auto;
        }

        .div-style {
            text-align: center;
            margin: 5px;
        }

        .btn-style {
            background-color: rgb(0, 102, 255);
            margin-top: 8px;
            height: 40px;
            width: 100%;
            font-size: large;
        }

        .inner-div {
            padding-left: 8%;
            padding-right: 8%;
        }

        .left-inner-div {
            width: 20%;
            float: left;
        }

        .right-inner-div {
            width: 78%;
            float: right;
            padding-left: 2%;
        }
    </style>
</head>

<body>
    <div class="div-style">
        <div><img class="lib-logo" src="lib logo.png" /></div>
        <div class="inner-div">
            <div class="left-inner-div">
                <button class="btn-style" style="background-color:purple;">Student</button>
                <button class="btn-style" style="cursor:pointer" onclick="open_part('myaccount')">My Account</button>
                <button class="btn-style" style="cursor:pointer" onclick="open_part('requestbook')">Request Book</button>
                <button class="btn-style" style="cursor:pointer" onclick="open_part('booksissued')">Book Issued</button>
                <a href="index.php"></a><button class="btn-style" style="cursor:pointer">Logout</button></a>
            </div>
            <div class="right-inner-div">
                <div id="myaccount" style="display:none">
                    <button class="btn-style">My Account</button>
                    <?php
                    $obj = new data();
                    $obj->set_connection();
                    $recordset = $obj->get_std_detail($std_id);
                    foreach ($recordset as $row) {
                        $id = $row[0];
                        $name = $row[1];
                        $email = $row[2];
                    }
                    ?>
                    <p style="font-weight:bold;font-size:large"><u>Student ID:</u> &nbsp; <?php echo $id ?></p>
                    <p style="font-weight:bold;font-size:large"><u>Student name:</u> &nbsp; <?php echo $name ?></p>
                    <p style="font-weight:bold;font-size:large"><u>Student email:</u> &nbsp; <?php echo $email ?></p>
                </div>

                <div id="requestbook" style="display:none">
                    <button class="btn-style">Request Book</button>
                    <?php
                    $obj = new data();
                    $obj->set_connection();
                    $recordset = $obj->available_books();
                    $table = "<table style='border:1px solid;border-collapse:collapse;width:100%'><tr><th style='border: 1px solid;'>Book ID</th><th style='border: 1px solid;'>Book Name</th><th style='border: 1px solid;'>Book Author</th><th>Request Book</th></tr>";
                    foreach ($recordset as $row) {
                        $table .= "<tr>";
                        $table .= "<td style='border: 1px solid;'>$row[0]</td>";
                        $table .= "<td style='border: 1px solid;'>$row[1]</td>";
                        $table .= "<td style='border: 1px solid;'>$row[2]</td>";
                        $table .= "<td style='border: 1px solid;'><a href='request_book.php?stdid=$std_id&bookid=$row[0]'><button type='button'>Request</button></a></td>";
                        $table .= "</tr>";
                    }
                    $table .= "</table><br>";
                    echo $table;
                    echo $msg;
                    ?>
                </div>

                <div id="booksissued" style="display:none">
                    <button class="btn-style">Books Issued</button>
                    <?php
                    $obj = new data();
                    $obj->set_connection();
                    $record_set = $obj->get_issued_books($std_id);
                    $table = "<table style='border:1px solid;border-collapse:collapse;width:100%'><tr><th style='border: 1px solid;'>Book Name</th><th style='border: 1px solid;'>Issued On</th><th style='border: 1px solid;'>Return Date</th><th>Return Book</th></tr>";
                    foreach ($record_set as $row) {
                        $table .= "<tr>";
                        $table .= "<td style='border: 1px solid;'>$row[3]</td>";
                        $table .= "<td style='border: 1px solid;'>$row[5]</td>";
                        $table .= "<td style='border: 1px solid;'>$row[6]</td>";
                        $table .= "<td style='border: 1px solid;'><a href='return_book.php?issueid=$row[0]'><button type='button'>Return</button></a></td>";
                        $table .= "</tr>";
                    }
                    $table .= "</table><br>";
                    echo $table;
                    echo $msg;
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        function open_part(portion) {
            document.getElementById("myaccount").style.display = "none";
            document.getElementById("booksissued").style.display = "none";
            if (portion == "requestbook") {
                document.getElementById("requestbook").style.display = "block";
            } else {
                document.getElementById("requestbook").style.display = "none";
                var i;
                var x = ['myaccount', 'booksissued'];
                for (i = 0; i < x.length; i++) {
                    if (x[i] != portion) {
                        document.getElementById(x[i]).style.display = "none";
                    } else if (x[i] == portion) {
                        document.getElementById(portion).style.display = "block";
                    }
                }
            }
        }
    </script>
</body>

</html>