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

        <form action="register_member.php" method="POST" enctype="multipart/form-data">
            <div class="form-logo">
                <img src="images/logo.jpeg" alt="Organization Logo">
            </div>
            <h1>Member Registration</h1>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="ph_no">Phone Number:</label>
            <input type="text" id="ph_no" name="ph_no" required>

            <label for="alt_ph_no">Alternate Phone Number:</label>
            <input type="text" id="alt_ph_no" name="alt_ph_no">

            <label for="address">Address:</label>
            <textarea id="address" name="address" required></textarea>

            <label for="college">College:</label>
            <select id="college" name="college" required>
                <option value="">None</option>
                <option value="AITD">Agnel Institute of Technology and Design</option>
                <option value="GEC">Goa Engineering College</option>
                <option value="PCCE">Padre Conceicao College of Engineering</option>
                <option value="RIT">Shree Rayeshwar Institute of Engineering & Information Technology</option>
            </select>

            <label for="college_dept">College Department:</label>
            <select id="college_dept" name="college_dept" onchange="showOtherDeptInput(this)" required>
                <option value="">None</option>
                <option value="CSE">Computer Science</option>
                <option value="ECE">Electronics and Communication</option>
                <option value="ME">Mechanical</option>
                <option value="CE">Civil</option>
                <option value="Other">Other</option>
            </select>
            <input type="text" id="other_college_dept" name="other_college_dept" class="hidden" placeholder="Please specify">

            <label for="department">Organization Department:</label>
            <select id="department" name="department" required>
                <option value="">None</option>
                <option value="Technical">Technical Department</option>
                <option value="Educational">Educational Department</option>
                <option value="Sports">Sports Department</option>
                <option value="Media and Marketing">Media and marketing Department</option>
                <option value="Human Resource">Human Resource</option>
            </select>

            <label for="designation">Designation:</label>
            <select id="designation" name="designation" required>
                <option value="">None</option>
                <option value="Member">Member</option>
                <option value="Department Head">Department Head</option>
                <option value="Treasurer">Treasurer</option>
                <option value="Assistant Treasurer">Assistant Treasurer</option>
                <option value="Secretary">Secretary</option>
                <option value="President">President</option>
            </select>

            <label for="profile_image">Profile Image:</label>
            <input type="file" id="profile_image" name="profile_image" class="file-input" accept="image/*" required>
            <span class="file-label">Accepted formats: JPG, PNG, GIF</span>

            <label for="identity_document">Identity Document (PDF):</label>
            <input type="file" id="identity_document" name="identity_document" class="file-input" accept="application/pdf" required>
            <span class="file-label">Accepted format: PDF</span>

            <button type="submit">Register</button>
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