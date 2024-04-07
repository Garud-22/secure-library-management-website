<?php
include("data.php");
$admin_id = $_SESSION['admin_id'];
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
    <title>Admin Dashboard</title>
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
                <button class="btn-style" style="background-color:purple;">Admin</button>
                <button class="btn-style" style="cursor:pointer" onclick="open_part('addbook')">Add Book</button>
                <button class="btn-style" style="cursor:pointer" onclick="open_part('addstd')">Add Student</button>
                <button class="btn-style" style="cursor:pointer" onclick="open_part('bookreport')">Book Report</button>
                <button class="btn-style" style="cursor:pointer" onclick="open_part('stdreport')">Student Report</button>
                <button class="btn-style" style="cursor:pointer" onclick="open_part('bookrequests')">Book Requests</button>
                <button class="btn-style" style="cursor:pointer" onclick="open_part('issuereport')">Issue Report</button>
                <a href="index.php"></a><button class="btn-style" style="cursor:pointer">Logout</button></a>
            </div>
            <div class="right-inner-div">
                <div id="addbook" style="display:none">
                    <button class="btn-style">Add book</button>
                    <form action="add_book_page.php" method="post" enctype="multipart/form-data">
                        <table style="padding-left:30%;padding-top:2%;;border-collapse:separate;border-spacing:0 15px">
                            <tr>
                                <td><label for="bookname">Book name:</label></td>
                                <td><input type="text" name="bookname"></td>
                            </tr>
                            <tr>
                                <td><label for="bookauthor">Book author:</label></td>
                                <td><input type="text" name="bookauthor"></td>
                            </tr>
                            <tr>
                                <td><label for="bookquantity">Book quantity:</label></td>
                                <td><input type="number" name="bookquantity"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input type="submit" value="Submit"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><?php echo $msg ?></td>
                            </tr>
                        </table>
                    </form>
                </div>

                <div id="addstd" style="display:none">
                    <button class="btn-style">Add student</button>
                    <form action="add_std_page.php" method="post" enctype="multipart/form-data">
                        <table style="padding-left:30%;padding-top:2%;;border-collapse:separate;border-spacing:0 15px">
                            <tr>
                                <td><label for="addname">Name:</label></td>
                                <td><input type="text" name="addname"></td>
                            </tr>
                            <tr>
                                <td><label for="addemail">Email:</label></td>
                                <td><input type="email" name="addemail"></td>
                            </tr>
                            <tr>
                                <td><label for="addpass">Password:</label></td>
                                <td><input type="password" name="addpass"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input type="submit" value="Submit"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><?php echo $msg ?></td>
                            </tr>
                        </table>
                    </form>
                </div>

                <div id="bookreport" style="display:none">
                    <button class="btn-style">Book Report</button>
                    <?php
                    $obj = new data();
                    $obj->set_connection();
                    $recordset = $obj->book_report();
                    $table = "<table style='border:1px solid;border-collapse:collapse;width:100%'><tr><th style='border: 1px solid;'>Name</th><th style='border: 1px solid;'>Author</th><th style='border: 1px solid;'>Quantity</th><th style='border: 1px solid;'>Available</th><th style='border: 1px solid;'>On Rent</th><th>Delete</th></tr>";
                    foreach ($recordset as $row) {
                        $table .= "<tr>";
                        $table .= "<td style='border: 1px solid;'>$row[1]</td>";
                        $table .= "<td style='border: 1px solid;'>$row[2]</td>";
                        $table .= "<td style='border: 1px solid;'>$row[3]</td>";
                        $table .= "<td style='border: 1px solid;'>$row[4]</td>";
                        $table .= "<td style='border: 1px solid;'>$row[5]</td>";
                        $table .= "<td style='border: 1px solid;'><a href='delete_book.php?delete_book_id=$row[0]'><button type='button'>Delete</button></a></td>";
                        $table .= "</tr>";
                    }
                    $table .= "</table><br>";
                    echo $table;
                    echo $msg;
                    ?>
                </div>

                <div id="stdreport" style="display:none">
                    <button class="btn-style">Student Report</button>
                    <?php
                    $obj = new data();
                    $obj->set_connection();
                    $recordset = $obj->std_report();
                    $table = "<table style='border:1px solid;border-collapse:collapse;width:100%'><tr><th style='border: 1px solid;'>Name</th><th style='border: 1px solid;'>Email</th><th>Delete</th></tr>";
                    foreach ($recordset as $row) {
                        $table .= "<tr>";
                        $table .= "<td style='border: 1px solid;'>$row[1]</td>";
                        $table .= "<td style='border: 1px solid;'>$row[2]</td>";
                        $table .= "<td style='border: 1px solid;'><a href='delete_std.php?delete_std_id=$row[0]'><button type='button'>Delete</button></a></td>";
                        $table .= "</tr>";
                    }
                    $table .= "</table><br>";
                    echo $table;
                    echo $msg;
                    ?>
                </div>


                <div id="bookrequests" style="display:none">
                    <button class="btn-style">Book Requests</button>
                    <?php
                    $obj = new data();
                    $obj->set_connection();
                    $recordset = $obj->get_book_requests();
                    $table = "<table style='border:1px solid;border-collapse:collapse;width:100%'><tr><th style='border: 1px solid;'>Student Name</th><th style='border: 1px solid;'>Book Name</th><th style='border: 1px solid;'>No. of Days</th><th>Approve</th></tr>";
                    foreach ($recordset as $row) {
                        $table .= "<tr>";
                        $table .= "<td style='border: 1px solid;'>$row[1]</td>";
                        $table .= "<td style='border: 1px solid;'>$row[2]</td>";
                        $table .= "<td style='border: 1px solid;'>$row[3]</td>";
                        $table .= "<td style='border: 1px solid;'><a href='approve_book_request.php?reqid=$row[0]&stdname=$row[1]&bookname=$row[2]&numdays=$row[3]'><button type='button'>Approve</button></a></td>";
                        $table .= "</tr>";
                    }
                    $table .= "</table><br>";
                    echo $table;
                    ?>
                </div>

                <div id="issuereport" style="display:none">
                    <button class="btn-style">Issued Books Record</button>
                    <?php
                    $obj = new data();
                    $obj->set_connection();
                    $recordset = $obj->issue_report();
                    $table = "<table style='border:1px solid;border-collapse:collapse;width:100%'><tr><th style='border: 1px solid;'>Student ID</th><th style='border: 1px solid;'>Student Name</th><th style='border: 1px solid;'>Book Name</th><th style='border: 1px solid;'>No. of Days</th><th style='border: 1px solid;'>Borrow Date</th><th style='border: 1px solid;'>Return Date</th></tr>";
                    foreach ($recordset as $row) {
                        $table .= "<tr>";
                        $table .= "<td style='border: 1px solid;'>$row[1]</td>";
                        $table .= "<td style='border: 1px solid;'>$row[2]</td>";
                        $table .= "<td style='border: 1px solid;'>$row[3]</td>";
                        $table .= "<td style='border: 1px solid;'>$row[4]</td>";
                        $table .= "<td style='border: 1px solid;'>$row[5]</td>";
                        $table .= "<td style='border: 1px solid;'>$row[6]</td>";
                        $table .= "</tr>";
                    }
                    $table .= "</table>";
                    echo $table;
                    ?>
                </div>
            </div>
            <script>
                function open_part(portion) {
                    document.getElementById("addbook").style.display = "none";
                    document.getElementById("addstd").style.display = "none";
                    document.getElementById("bookreport").style.display = "none";
                    document.getElementById("bookrequests").style.display = "none";
                    document.getElementById("issuereport").style.display = "none";
                    if (portion == "stdreport") {
                        document.getElementById("stdreport").style.display = "block";
                    } else {
                        document.getElementById("stdreport").style.display = "none";
                        var i;
                        var x = ['addbook', 'addstd', 'bookreport', 'bookrequests', 'issuereport'];
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