            <?php
            include 'db_connection.php';

            $sql = "SELECT COUNT(*) as total_members FROM personal_details";
            $result = $conn->query($sql);

            $total_members = 0;
            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    $total_members = $row["total_members"];
                }
            } else {
                echo "0 results";
            }
            $conn->close();
            ?>


            <!DOCTYPE html>

            <html lang="en">

            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Dashboard</title>

            <head>
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                <link rel="stylesheet" href="css/styles.css">
                <link rel="stylesheet" href="css/index.css">
            </head>

            <body>
                <script src="js/script.js"></script>

                <div class="main">

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

                    <div class="topnav" id="myTopnav">
                        <a href="#signout" style="margin-left: 95%;"><img src="images/power.png"></a>
                    </div>

                    <div class="content">
                        <div class="qoute_box">
                            <img src="images/quote.png" alt="">
                            <p style="color: #317DAF; margin-left: 20%">None of us is as smart as all of us.”</p>
                            <p class="author">– Ken Blanchard</p>
                        </div>

                        <div class="display_member_count">
                            <img src="images/team member.png" alt="">
                            <div class="total-members">Total Members: <?php echo $total_members; ?></div>
                        </div>
                    </div>




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
                    /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content */
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