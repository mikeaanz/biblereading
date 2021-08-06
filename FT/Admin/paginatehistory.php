 <?php

        if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = 10;
        $offset = ($pageno-1) * $no_of_records_per_page;

        $conn=mysql_connect("localhost","","","dbmonitoring");
        // Check connection
        if (mysql_connect_errno()){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            die();
        }

        $total_pages_sql = "SELECT COUNT(*) FROM feedback";
        $result = mysql_query($conn,$total_pages_sql);
        $total_rows = mysql_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);

        $sql = "SELECT * FROM feedback LIMIT $offset, $no_of_records_per_page";
        $res_data = mysql_query($conn,$sql);
        while($row = mysql_fetch_array($res_data)){
            //here goes the data
        }
        mysql_close($conn);
    ?>
    <ul class="pagination">
        <li><a href="?pageno=1">First</a></li>
        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
        </li>
        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
        </li>
        <li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
    </ul>