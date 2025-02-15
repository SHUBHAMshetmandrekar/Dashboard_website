<?php
include 'db_connection.php';
$sql = "SELECT * FROM personal_details";
$register = $conn->query($sql);
$data = array();
if ($register->num_rows > 0) {
    while ($row = $register->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    echo "0 results";
}
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Members</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.dataTables.css">
    <style>
        body {
            font-family: "Lato", sans-serif;
            background-color: #f8f9fa;
        }

        .sidebar {
            height: 100%;
            width: 200px;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: white;
            overflow-x: hidden;
            padding-top: 16px;
            border-right: 2px solid #ccc;
            color: #ffffff;
        }

        .sidebar a {
            padding: 6px 8px 6px 16px;
            text-decoration: none;
            font-size: 20px;
            color: #adb5bd;
            display: block;
        }

        .sidebar a:hover {
            color: #ffb44b;
        }

        .main {
            margin-left: 220px;
            padding: 20px;
            font-size: 18px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table.dataTable {
            width: 100%;
            margin: 0 auto;
            clear: both;
            border-collapse: separate;
            border-spacing: 0;
            border: 1px solid #ddd;
            background-color: #ffffff;
        }

        table.dataTable thead th {
            background-color: #343a40;
            color: #ffffff;
            text-align: center;
        }

        table.dataTable tbody td {
            text-align: center;
            padding: 8px;
        }

        table.dataTable tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table.dataTable tbody tr:hover {
            background-color: #e9ecef;
        }

        table.dataTable thead th,
        table.dataTable tfoot th {
            font-weight: bold;
        }

        .buttons-container {
            margin: 20px 0;
            text-align: center;
        }

        .btn {
            margin: 5px;
            padding: 10px 20px;
            font-size: 16px;
            color: #ffffff;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .btn-red {
            background-color: #dc3545;
        }

        .btn-red:hover {
            background-color: #c82333;
        }

        .btn-blue {
            background-color: #17a2b8;
        }

        .btn-blue:hover {
            background-color: #138496;
        }

        .sidenav a:hover,
        .dropdown-btn:hover {
            color: #ffb44b;
        }

        .sidenav a,
        .dropdown-btn {
            padding: 6px 8px 6px 16px;
            text-decoration: none;
            font-size: 20px;
            color: #818181;
            display: block;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
            outline: none;
        }



        /* Add an active class to the active dropdown button */
        .active {
            background-color: rgb(187, 187, 187);
            color: #fff;
        }

        /* Dropdown container (hidden by default). Optional: add a lighter background color and some left padding to change the design of the dropdown content */
        .dropdown-container {
            display: none;
            background-color: #fff;
            padding-left: 8px;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <img src="images/logo.jpeg" style="height: 100px; width: 100px;">
        <a href="index.php"><img src="images/icon _dashboard.png">Dashboard</a>
        <br><button class="dropdown-btn"><img src="images/department.png"> Department
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-container">
            <a href="#">Technical </a>
            <a href="#">Sports</a>
            <a href="#">Education</a>
            <a href="#">HR</a>
        </div>
        <br><a href="all_members.php"><img src="images/member.png"> All Members</a>
        <br><a href="#contact"><img src="images/finance.png"> Balance</a>
        <br><a href="#clients"><img src="images/analysis.png"> Analysis</a>
        <br><a href="#contact"><img src="images/documents.png"> Document</a>
    </div>
    <div class="main">
        <table id="records_table" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone no</th>
                    <th>Alt phone no</th>
                    <th>Address</th>
                    <th>College</th>
                    <th>College dept</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;
                foreach ($data as $row) {
                    echo "<tr>";
                    echo "<td>" . $i . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["ph_no"] . "</td>";
                    echo "<td>" . $row["alt_ph_no"] . "</td>";
                    echo "<td>" . $row["address"] . "</td>";
                    echo "<td>" . $row["college"] . "</td>";
                    echo "<td>" . $row["college_dpt"] . "</td>";
                    echo "</tr>";
                    $i++;
                }
                ?>
            </tbody>
        </table>
        <div class="buttons-container">
            <button id="download_excel" class="btn">Download as Excel</button>
            <button id="download_pdf" class="btn btn-red">Download as PDF</button>
            <button id="print" class="btn btn-blue">Print</button>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.print.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#records_table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', 'print'
                ]
            });

            $('#download_excel').on('click', function() {
                table.button('.buttons-excel').trigger();
            });

            $('#download_pdf').on('click', function() {
                table.button('.buttons-pdf').trigger();
            });

            $('#print').on('click', function() {
                table.button('.buttons-print').trigger();
            });
        });

        function myFunction() {
            var x = document.getElementById("myTopnav");
            if (x.className === "topnav") {
                x.className += " responsive";
            } else {
                x.className = "topnav";
            }
        }

        var dropdown = document.getElementsByClassName("dropdown-btn");
        var i;

        for (i = 0; i < dropdown.length; i++) {
            dropdown[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var dropdownContent = this.nextElementSibling;
                if (dropdownContent.style.display === "block") {
                    dropdownContent.style.display = "none";
                } else {
                    dropdownContent.style.display = "block";
                }
            });
        }
    </script>
</body>

</html>