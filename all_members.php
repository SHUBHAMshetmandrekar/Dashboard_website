<?php
include 'db_connection.php';
$sql = "SELECT pd.*, d.*
FROM personal_details pd
LEFT JOIN department d
ON pd.mem_id = d.dpt_id
";
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="css/all_members.css">
    <style>
        .main {
            margin-left: 200px;
            padding: 20px;
            background-color: #f1f1f1;
            overflow: auto;
            height: 100vh;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <img src="images/logo.jpeg" style="height: 100px; width: 100px;"></img>
        <a href="index.php"><img src="images/icon _dashboard.png"></img> Dashboard</a>
        <br><button class="dropdown-btn"> <img src="images/department.png"></img>Department
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-container">
            <a href="dpt_details.php?dpt_name='Technical'">Technical </a>
            <a href="dpt_details.php?dpt_name='Sports'">Sports</a>
            <a href="dpt_details.php?dpt_name='Educational'">Education</a>
            <a href="dpt_details.php?dpt_name='Human Resource'">HR</a>
            <a href="dpt_details.php?dpt_name='Media and Marketing'">Media and Marketing</a>
        </div>
        <br><button class="dropdown-btn"> <img src="images/member.png"></img>Members
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-container">
            <a href="all_members.php">All Members </a>
            <a href="add_member.php">Add Member</a>
        </div>

        <br><a href="balance.php"><img src="images/finance.png"></img> Balance</a>
        <br><a href="#clients"><img src="images/analysis.png"></img> Analysis</a>
        <br><a href="#contact"><img src="images/documents.png"></img> Document</a>
    </div>
    <div class="main">
        <div class="top-buttons">
            <button onclick="goBack()" class="btn btn-back">Back</button>
            <button onclick="direct()" class="btn btn-add">Add Member</button>
        </div>
        <div class="table-wrapper">
            <table id="example" class="display" style="width:100%">
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
                        <th>Department</th>
                        <th>Designation</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($data as $row) {
                        echo "<tr>";
                        echo "<td>" . $i . "</td>";
                        echo "<td><a href='mem_details.php?mem_id=" . $row["mem_id"] . "'>" . $row["name"] . "</a></td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . $row["ph_no"] . "</td>";
                        echo "<td>" . $row["alt_ph_no"] . "</td>";
                        echo "<td>" . $row["address"] . "</td>";
                        echo "<td>" . $row["college"] . "</td>";
                        echo "<td>" . $row["college_dpt"] . "</td>";
                        echo "<td>" . $row["dpt_name"] . "</td>";
                        echo "<td>" . $row["designation"] . "</td>";
                        echo "</tr>";
                        $i++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="buttons-container">
            <button id="download_excel" class="btn">Download as Excel</button>
            <button id="download_pdf" class="btn btn-red">Download as PDF</button>
            <button id="print" class="btn btn-blue">Print</button>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.14/jspdf.plugin.autotable.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });

        function direct() {
            window.location.href = "add_member.php";
        }

        function goBack() {
            location.href = "index.php";
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

        document.getElementById('download_excel').addEventListener('click', function() {
            var wb = XLSX.utils.table_to_book(document.getElementById('example'), {
                sheet: "Sheet JS"
            });
            XLSX.writeFile(wb, 'members.xlsx');
        });

        document.getElementById('download_pdf').addEventListener('click', function() {
            const {
                jsPDF
            } = window.jspdf;
            const doc = new jsPDF();

            // Get the table
            const table = document.querySelector("#example");

            // Use autoTable to format the table data with font size adjustments
            doc.autoTable({
                html: table,
                theme: 'striped',
                styles: {
                    fontSize: 5, // Adjust the font size as needed
                    cellPadding: 1,
                },
                headStyles: {
                    fillColor: [22, 160, 133],
                    textColor: [255, 255, 255],
                    fontSize: 8, // Adjust the header font size if needed
                },
                bodyStyles: {
                    fontSize: 7,
                },
                startY: 20, // Start position for the table
            });

            // Save the PDF
            doc.save("members.pdf");
        });



        document.getElementById('print').addEventListener('click', function() {
            window.print();
        });
    </script>
</body>

</html>