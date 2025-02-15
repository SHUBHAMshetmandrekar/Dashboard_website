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
    <title>Member Registration</title>
    <link rel="stylesheet" href="css/add_member.css">
</head>

<body>
    <div style="display:flex;">
        <form action='edit_mem_details.php' method="POST" enctype="multipart/form-data">
            <div class="form-logo">
                <img src="images/logo.jpeg" alt="Organization Logo">
            </div>
            <h1>Member Registration</h1>
            <input type="hidden" id="mem_id" name="mem_id" value="<?php echo htmlspecialchars($person['mem_id']); ?>">

            <label for="name">Member ID:</label>
            <input type="text" value="<?php echo "SP" . htmlspecialchars($person['mem_id']); ?>" disabled>

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($person['name']); ?>">

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($person['email']); ?>">

            <label for="ph_no">Phone Number:</label>
            <input type="text" id="ph_no" name="ph_no" value="<?php echo htmlspecialchars($person['ph_no']); ?>">

            <label for="alt_ph_no">Alternate Phone Number:</label>
            <input type="text" id="alt_ph_no" name="alt_ph_no" value="<?php echo htmlspecialchars($person['alt_ph_no']); ?>">

            <label for="address">Address:</label>
            <textarea id="address" name="address"><?php echo htmlspecialchars($person['address']); ?></textarea>

            <label for="college">College:</label>
            <select id="college" name="college">
                <option value="">None</option>
                <option value="AITD" <?php echo ($person['college'] == 'AITD') ? 'selected' : ''; ?>>Agnel Institute of Technology and Design</option>
                <option value="GEC" <?php echo ($person['college'] == 'GEC') ? 'selected' : ''; ?>>Goa Engineering College</option>
                <option value="PCCE" <?php echo ($person['college'] == 'PCCE') ? 'selected' : ''; ?>>Padre Conceicao College of Engineering</option>
                <option value="RIT" <?php echo ($person['college'] == 'RIT') ? 'selected' : ''; ?>>Shree Rayeshwar Institute of Engineering & Information Technology</option>
            </select>

            <label for="college_dept">College Department:</label>
            <select id="college_dept" name="college_dept" onchange="showOtherDeptInput(this)">
                <option value="">None</option>
                <option value="CSE" <?php echo ($person['college_dpt'] == 'CSE') ? 'selected' : ''; ?>>Computer Science</option>
                <option value="ECE" <?php echo ($person['college_dpt'] == 'ECE') ? 'selected' : ''; ?>>Electronics and Communication</option>
                <option value="ME" <?php echo ($person['college_dpt'] == 'ME') ? 'selected' : ''; ?>>Mechanical</option>
                <option value="CE" <?php echo ($person['college_dpt'] == 'CE') ? 'selected' : ''; ?>>Civil</option>
                <option value="Other" <?php echo ($person['college_dpt'] == 'Other') ? 'selected' : ''; ?>>Other</option>
            </select>
            <input type="text" id="other_college_dept" name="other_college_dept" class="<?php echo ($person['college_dpt'] == 'Other') ? '' : 'hidden'; ?>" placeholder="Please specify" value="<?php echo ($person['college_dpt'] == 'Other') ? htmlspecialchars($person['other_college_dpt']) : ''; ?>">

            <label for="department">Organization Department:</label>
            <select id="department" name="department">
                <option value="">None</option>
                <option value="Technical" <?php echo ($person['dpt_name'] == 'Technical') ? 'selected' : ''; ?>>Technical Department</option>
                <option value="Educational" <?php echo ($person['dpt_name'] == 'Educational') ? 'selected' : ''; ?>>Marketing Department</option>
                <option value="Sports" <?php echo ($person['dpt_name'] == 'Sports') ? 'selected' : ''; ?>>Sports Department</option>
                <option value="Media & marketing" <?php echo ($person['dpt_name'] == 'Media & marketing') ? 'selected' : ''; ?>>Media and Marketing Department</option>
                <option value="Human Resource" <?php echo ($person['dpt_name'] == 'Human Resource') ? 'selected' : ''; ?>>Human Resources</option>
            </select>

            <label for="designation">Designation:</label>
            <select id="designation" name="designation">
                <option value="">None</option>
                <option value="Member" <?php echo ($person['designation'] == 'Member') ? 'selected' : ''; ?>>Member</option>
                <option value="Department Head" <?php echo ($person['designation'] == 'Department Head') ? 'selected' : ''; ?>>Department Head</option>
                <option value="Treasurer" <?php echo ($person['designation'] == 'Treasurer') ? 'selected' : ''; ?>>Treasurer</option>
                <option value="Assistant Treasurer" <?php echo ($person['designation'] == 'Assistant Treasurer') ? 'selected' : ''; ?>>Assistant Treasurer</option>
                <option value="Secretary" <?php echo ($person['designation'] == 'Secretary') ? 'selected' : ''; ?>>Secretary</option>
                <option value="President" <?php echo ($person['designation'] == 'President') ? 'selected' : ''; ?>>President</option>
            </select>

            <label for="profile_image">Profile Image:</label>
            <input type="file" id="profile_image" name="profile_image" class="file-input" accept="image/*">
            <span class="file-label">Accepted formats: JPG, PNG, GIF</span>

            <label for="identity_document">Identity Document (PDF):</label>
            <input type="file" id="identity_document" name="identity_document" class="file-input" accept="application/pdf">
            <span class="file-label">Accepted format: PDF</span>

            <button type="submit">Save Changes</button>
        </form>
        <div class="topnav">
            <a href="all_members.php" class="split">Back</a>
        </div>
    </div>
    <script>
        function showOtherDeptInput(select) {
            const otherInput = document.getElementById('other_college_dept');
            if (select.value === 'Other') {
                otherInput.classList.remove('hidden');
                otherInput.setAttribute('required', 'required');
            } else {
                otherInput.classList.add('hidden');
                otherInput.removeAttribute('required');
            }
        }
    </script>
</body>

</html>