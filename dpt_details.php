<?php
include 'db_connection.php';

if (isset($_GET['dpt_name'])) {
    $dpt = $_GET['dpt_name'];
} else {
    die('depatment not specified.');
}

$sql1 = "SELECT pd.*, d.*, doc.*
          FROM personal_details pd
          LEFT JOIN department d ON pd.mem_id = d.mem_id
          LEFT JOIN document doc ON pd.mem_id = doc.mem_id
          WHERE d.designation != 'Department Head' AND d.dpt_name = $dpt
";

$sql2 = "SELECT pd.*, d.*, doc.*
FROM personal_details pd
LEFT JOIN department d ON pd.mem_id = d.mem_id
LEFT JOIN document doc ON pd.mem_id = doc.mem_id
WHERE d.designation = 'Department Head' AND d.dpt_name = $dpt
";

$result = $conn->query($sql1);
$head = $conn->query($sql2);
?>

<!DOCTYPE html>

<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard</title>


<head>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/dpt_details.css">
    <link rel="stylesheet" href="css/styles.css">

    <style>
        .main-division {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
        }

        .main-section {
            width: 100%;
            padding: 10px;
            background-color: #f2f2f2;
            border-radius: 5px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            margin-top: 10px;
            transition: 0.3s;
            display: flex;
            flex-wrap: wrap;
            margin-left: 415px;

        }
    </style>

</head>

<body>
    <script src="js/script.js"></script>


    <div class="main">



        <div class="topnav" id="myTopnav">
            <a href="#signout" style="margin-left: 95%;"><img src="images/power.png"></a>
        </div>
        <script>
            function myFunction() {
                var x = document.getElementById("myTopnav");
                if (x.className === "topnav") {
                    x.className += " responsive";
                } else {
                    x.className = "topnav";
                }
            }
        </script>

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

        <div class="main-division">
            <?php
            if ($head->num_rows > 0) {
                // Output data of each row
                while ($row = $head->fetch_assoc()) {
                    echo '<div class="card">
                                <div class="img">
                                <img class="img"src="' . $row["profile_image"] . '" alt="Department Image">
                                </div>
                                <span>' . $row["name"] . '</span>
                                <p class="info">ID : SP' . $row["mem_id"] . '</p>
                                <p class="info">Dept :' . $row["dpt_name"] . '</p>
                                <p class="info">Desig:' . $row["designation"] . '</p>
                                <button><a href="mem_details.php?mem_id=' . $row["mem_id"] . '">View Details</a></button>
                              </div>';
                }
            } else {
                echo "NO Department Head found";
            }
            $conn->close();
            ?>
            <div class="main-section">
                <?php
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="card" style="background-color:#4366A9;">
                                <div class="img">
                                <img class="img"src="' . $row["profile_image"] . '" alt="Department Image">
                                </div>
                                <span>' . $row["name"] . '</span>
                                <p class="info">ID : SP' . $row["mem_id"] . '</p>
                                <p class="info">Dept :' . $row["dpt_name"] . '</p>
                                <p class="info">Desig:' . $row["designation"] . '</p>
                                <button style="background-color:#FFB44B ;"><a href="mem_details.php?mem_id=' . $row["mem_id"] . '">View Details</a></button>
                              </div>';
                    }
                } else {
                    echo "No Member found";
                }

                ?>
            </div>
        </div>

        <script>
            /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
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

            // Create a "close" button and append it to each list item
            var myNodelist = document.getElementsByTagName("LI");
            var i;
            for (i = 0; i < myNodelist.length; i++) {
                var span = document.createElement("SPAN");
                var txt = document.createTextNode("\u00D7");
                span.className = "close";
                span.appendChild(txt);
                myNodelist[i].appendChild(span);
            }

            // Click on a close button to hide the current list item
            var close = document.getElementsByClassName("close");
            var i;
            for (i = 0; i < close.length; i++) {
                close[i].onclick = function() {
                    var div = this.parentElement;
                    div.style.display = "none";
                }
            }

            // Add a "checked" symbol when clicking on a list item
            var list = document.querySelector('ul');
            list.addEventListener('click', function(ev) {
                if (ev.target.tagName === 'LI') {
                    ev.target.classList.toggle('checked');
                }
            }, false);

            // Create a new list item when clicking on the "Add" button
            function newElement() {
                var li = document.createElement("li");
                var inputValue = document.getElementById("myInput").value;
                var t = document.createTextNode(inputValue);
                li.appendChild(t);
                if (inputValue === '') {
                    alert("You must write something!");
                } else {
                    document.getElementById("myUL").appendChild(li);
                }
                document.getElementById("myInput").value = "";

                var span = document.createElement("SPAN");
                var txt = document.createTextNode("\u00D7");
                span.className = "close";
                span.appendChild(txt);
                li.appendChild(span);

                for (i = 0; i < close.length; i++) {
                    close[i].onclick = function() {
                        var div = this.parentElement;
                        div.style.display = "none";
                    }
                }
            }
        </script>
</body>

</html>