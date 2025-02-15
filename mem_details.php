<?php
include('db_connection.php');

if (isset($_GET['mem_id'])) {
    $mem_id = $_GET['mem_id'];
} else {
    die('mem_id not specified.');
}

$query = "SELECT pd.*, d.*, doc.*
          FROM personal_details pd
          LEFT JOIN department d ON pd.mem_id = d.mem_id
          LEFT JOIN document doc ON pd.mem_id = doc.mem_id
          WHERE pd.mem_id = ?";


$stmt = $conn->prepare($query);
if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($conn->error));
}

$stmt->bind_param('i', $mem_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result === false) {
    die('Execute failed: ' . htmlspecialchars($stmt->error));
}

$person = $result->fetch_assoc();
if ($person === null) {
    die('No records found.');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Details</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <link rel="stylesheet" href="css/mem_details.css">
</head>

<body>
    <div class="resume-container">
        <header class="resume-header">
            <div class="logo">
                <img src="images/logo.jpeg" alt="Organization Logo">
            </div>
            <div class="header-title">
                <h1>Member Details</h1>
            </div>
        </header>
        <div class="profile-section">
            <div class="profile-photo" onclick="openModal()">
                <img src="<?php echo $person['profile_image']; ?>" alt="Profile Photo" id="profileImage">
            </div>
            <div class="employee-info">
                <h1><?php echo $person['name']; ?></h1>
                <p><strong><?php echo $person['designation']; ?></strong></p>
                <p>SP<?php echo $person['mem_id']; ?></p>
                <button class="edit-btn" onclick="editDetails()">Edit Details</button>
                <button class="edit-btn" onclick="downloadPDF()">Download</button>
            </div>
        </div>
        <div class="resume-body">
            <div class="section">
                <h2>Contact Information</h2>
                <p><img src="images/email.png"> <?php echo $person['email']; ?></p>
                <p><img src="images/phone.png"> <?php echo $person['ph_no']; ?></p>
                <p><img src="images/phone.png"> <?php echo $person['alt_ph_no'] . " (alt)";  ?></p>
                <p><img src="images/address.png"> <?php echo $person['address']; ?></p>
            </div>
            <div class="section">
                <h2>Education</h2>
                <p><strong>College:</strong> <?php echo $person['college']; ?></p>
                <p><strong>Department:</strong> <?php echo $person['college_dpt']; ?></p>
            </div>
            <div class="section">
                <h2>DepartmentInformation</h2>
                <p><strong>Department:</strong> <?php echo $person['dpt_name']; ?></p>
                <p><strong>Designation:</strong> <?php echo $person['designation']; ?></p>
            </div>
        </div>
        <footer class="footer">
            <p>&copy; 2024 SocialPact.</p>
        </footer>
    </div>

    <!-- Modal for profile photo -->
    <div id="photoModal" class="modal">
        <span class="close" onclick="closeModal()">&times;</span>
        <img class="modal-content" id="modalImage">
        <div class="caption">
            <button onclick="changePhoto()">Change Photo</button>
        </div>
    </div>
    <script>
        function openModal() {
            var modal = document.getElementById("photoModal");
            var modalImg = document.getElementById("modalImage");
            var profileImg = document.getElementById("profileImage");
            modal.style.display = "block";
            modalImg.src = profileImg.src;
        }

        function closeModal() {
            var modal = document.getElementById("photoModal");
            modal.style.display = "none";
        }

        function changePhoto() {
            var newPhotoUrl = prompt("Enter the URL of the new photo:");
            if (newPhotoUrl) {
                var profileImg = document.getElementById("profileImage");
                profileImg.src = newPhotoUrl;
                closeModal();
            }
        }


        function downloadPDF() {
            // Hide the buttons before generating the PDF
            var buttons = document.querySelectorAll('.edit-btn');
            buttons.forEach(button => button.style.display = 'none');

            var footer = document.querySelector('.footer');
            footer.style.display = 'none';

            // Use html2pdf to generate the PDF
            var element = document.querySelector('.resume-container');
            html2pdf().from(element).set({
                margin: [0.5, 0.5, 0.5, 0.5], // margins in inches
                filename: '<?php echo $person['name']; ?>_Details.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2
                },
                jsPDF: {
                    unit: 'in',
                    format: 'letter',
                    orientation: 'portrait'
                }
            }).save().then(function() {
                // Show the buttons again after the PDF is generated
                footer.style.display = 'inline-block';
                buttons.forEach(button => button.style.display = 'inline-block');
            });
        }
    </script>


    <script>
        function openModal() {
            var modal = document.getElementById("photoModal");
            var modalImg = document.getElementById("modalImage");
            var profileImg = document.getElementById("profileImage");
            modal.style.display = "block";
            modalImg.src = profileImg.src;
        }

        function closeModal() {
            var modal = document.getElementById("photoModal");
            modal.style.display = "none";
        }

        function changePhoto() {
            var newPhotoUrl = prompt("Enter the URL of the new photo:");
            if (newPhotoUrl) {
                var profileImg = document.getElementById("profileImage");
                profileImg.src = newPhotoUrl;
                closeModal();
            }
        }

        function editDetails() {
            location.href = "edit_member.php?mem_id=<?php echo $person['mem_id']; ?>";
        }
    </script>
</body>

</html>