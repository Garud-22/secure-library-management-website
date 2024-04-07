<?php
session_start();
include("db.php");
class data extends db
{
    private $book_name;
    private $book_author;
    private $book_publisher;
    private $book_quantity;
    private $book_borrowed;
    private $borrowing_std;
    private $days;
    private $borrow_date;
    private $return_date;
    private $std_name;
    private $std_email;
    private $std_pass;
    private $books_available;
    private $books_on_rent;
    function __construct()
    {
    }

    function std_login($p1, $p2)
    {
        $q = "select * from std where email='$p1' and pass='$p2'";
        $record_set = $this->connection->query($q);
        $result = $record_set->rowCount();
        if ($result > 0) {
            foreach ($record_set->fetchAll() as $row) {
                $std_id = $row['id'];
                $_SESSION['std_id'] = $std_id;
                header("Location:std_dashboard.php");
            }
        } elseif ($result <= 0) {
            header("Location:index.php?msg=Invalid Credentials");
        }
    }

    function admin_login($p1, $p2)
    {
        $q = "select * from admin where email='$p1' and pass='$p2'";
        $record_set = $this->connection->query($q);
        $result = $record_set->rowCount();
        if ($result > 0) {
            foreach ($record_set->fetchAll() as $row) {
                $admin_id = $row['id'];
                $_SESSION['admin_id'] = $admin_id;
                header("Location:admin_dashboard.php");
            }
        } elseif ($result <= 0) {
            header("Location:index.php?msg=Invalid Credentials");
        }
    }

    function get_std_detail($std_id)
    {
        $q = "select * from std where id='$std_id'";
        $data = $this->connection->query($q);
        return $data;
    }

    function add_std($std_name, $std_email, $std_pass)
    {
        $this->std_name = $std_name;
        $this->std_email = $std_email;
        $this->std_pass = $std_pass;

        $q = "insert into std (id, name, email, pass) values ('', '$std_name', '$std_email', '$std_pass')";
        if ($this->connection->exec($q)) {
            header("Location:admin_dashboard.php?msg=New student added");
        } else {
            header("Location:admin_dashboard.php?msg=Failed to add new student");
        }
    }

    function add_book($book_name, $book_author, $book_quantity)
    {
        $this->book_name = $book_name;
        $this->book_author = $book_author;
        $this->book_quantity = $book_quantity;

        $q = "insert into book (id, name, author, quantity, available, rent) values ('', '$book_name', '$book_author', '$book_quantity', '$book_quantity', 0)";
        if ($this->connection->exec($q)) {
            header("Location:admin_dashboard.php?msg=New book added");
        } else {
            header("Location:admin_dashboard.php?msg=Failed to add new book");
        }
    }

    function std_report()
    {
        $q = "select * from std";
        $data = $this->connection->query($q);
        return $data;
    }

    function book_report()
    {
        $q = "select * from book";
        $data = $this->connection->query($q);
        return $data;
    }

    function delete_book($delete_book_id)
    {
        $q = "delete from book where id='$delete_book_id'";
        if ($this->connection->exec($q)) {
            header("Location:admin_dashboard.php?msg=Deletion Successful");
        } else {
            header("Location:admin_dashboard.php?msg=Deletion Unsuccessful");
        }
    }

    function delete_std($delete_std_id)
    {
        $q = "delete from std where id='$delete_std_id'";
        if ($this->connection->exec($q)) {
            header("Location:admin_dashboard.php?msg=Deletion Successful");
        } else {
            header("Location:admin_dashboard.php?msg=Deletion Unsuccessful");
        }
    }

    function get_book_requests()
    {
        $q = "select * from bookrequests";
        $data = $this->connection->query($q);
        return $data;
    }

    function approve_book_requests($book_name, $std_name, $num_days, $borrow_date, $return_date, $req_id)
    {
        $this->$book_name = $book_name;
        $this->$std_name = $std_name;
        $this->$num_days = $num_days;
        $this->$borrow_date = $borrow_date;
        $this->$return_date = $return_date;
        $this->$req_id = $req_id;

        $q = "select * from book where name='$book_name'";
        $record_set = $this->connection->query($q);
        $q = "select * from std where name='$std_name'";
        $record_set1 = $this->connection->query($q);
        $result = $record_set1->rowCount();

        if ($result > 0) {
            foreach ($record_set1->fetchAll() as $row) {
                $std_id = $row['id'];
            }

            foreach ($record_set as $row) {
                $book_id = $row['id'];
                $new_book_available = $row['available'] - 1;
                $new_book_rent = $row['rent'] + 1;
            }

            $q = "update book set available='$new_book_available', rent='$new_book_rent' where id='$book_id'";
            if ($this->connection->exec($q)) {
                $q = "insert into issuebook (issue_id, std_id, std_name, book_name, num_days, borrow_date, return_date) values ('', '$std_id', '$std_name', '$book_name', '$num_days', '$borrow_date', '$return_date')";
                if ($this->connection->exec($q)) {
                    $q = "delete from bookrequests where req_id='$req_id'";
                    $this->connection->exec($q);
                    header("Location:admin_dashboard.php?msg=Book approved");
                } else {
                    header("Location:admin_dashboard.php?msg=Failed to approve book");
                }
            } else {
                header("Location:admin_dashboard.php?msg=Failed to approve book");
            }
        } else {
            header("Location:admin_dashboard.php?msg=Invalid student name");
        }
    }

    function issue_report()
    {
        $q = "select * from issuebook";
        $data = $this->connection->query($q);
        return $data;
    }

    function available_books()
    {
        $q = "select * from book where available != 0";
        $data = $this->connection->query($q);
        return $data;
    }

    function request_book($std_id, $book_id)
    {
        $q = "select * from book where id='$book_id'";
        $record_set = $this->connection->query($q);

        $q = "select * from std where id='$std_id'";
        $record_set1 = $this->connection->query($q);

        foreach ($record_set1 as $row) {
            $std_name = $row['name'];
        }

        foreach ($record_set->fetchAll() as $row) {
            $book_name = $row['name'];
        }

        $num_days = 7;

        $q = "insert into bookrequests (req_id, std_name, book_name, num_days) values ('', '$std_name', '$book_name', '$num_days')";
        if ($this->connection->exec($q)) {
            header("Location:std_dashboard.php?msg=Book request successful");
        } else {
            header("Location:std_dashboard.php?msg=Book request unsuccessful");
        }
    }

    function get_issued_books($std_id){
        $q = "select * from issuebook where std_id='$std_id'";
        $data = $this->connection->query($q);
        return $data;
    }

    function return_book($issue_id){
        $q = "select * from issuebook where issue_id='$issue_id'";
        $record_set = $this->connection->query($q);
        foreach($record_set->fetchAll() as $row){
            $book_name = $row['book_name'];
        }

        $q = "select * from book where name='$book_name'";
        $record_set = $this->connection->query($q);
        foreach($record_set->fetchAll() as $row){
            $new_book_available = $row['available'] + 1;
            $new_book_rent = $row['rent'] - 1;
        }
        $q = "update book set available='$new_book_available', rent='$new_book_rent' where name='$book_name'";
        $this->connection->exec($q);

        $q = "delete from issuebook where issue_id='$issue_id'";
        if($this->connection->exec($q)){
            header("Location:std_dashboard.php?msg=Book returned successfully");
        }
        else{
            header("Location:std_dashboard.php?msg=Book return unsuccessful");
        }
    }
}
