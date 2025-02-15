<?php
include('db_connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    if (isset($_POST['mem_id'])) {
        $mem_id = $_POST['mem_id'];
    } else {
        die('mem_id not specified.');
    }

    $name = $_POST['name'];
    $email = $_POST['email'];
    $ph_no = $_POST['ph_no'];
    $alt_ph_no = $_POST['alt_ph_no'];
    $address = $_POST['address'];
    $college = $_POST['college'];
    $college_dept = $_POST['college_dept'];
    if ($college_dept == 'Other') {
        $college_dept = $_POST['other_college_dept'];
    }
    $department = $_POST['department'];
    $designation = $_POST['designation'];

    // File upload logic
    $profile_image = $_FILES['profile_image']['name'];
    $identity_document = $_FILES['identity_document']['name'];

    // Handle profile image upload
    if (!empty($profile_image)) {
        $profile_image_tmp = $_FILES['profile_image']['tmp_name'];
        $profile_image_ext = pathinfo($profile_image, PATHINFO_EXTENSION);
        $profile_image_new_name = "profile_" . $mem_id . "." . $profile_image_ext;
        $profile_image_dest = "uploads/profile_images/" . $profile_image_new_name;
        move_uploaded_file($profile_image_tmp, $profile_image_dest);
    } else {
        $profile_image_new_name = null; // or fetch existing from DB if required
    }

    // Handle identity document upload
    if (!empty($identity_document)) {
        $identity_document_tmp = $_FILES['identity_document']['tmp_name'];
        $identity_document_ext = pathinfo($identity_document, PATHINFO_EXTENSION);
        $identity_document_new_name = "identity_" . $mem_id . "." . $identity_document_ext;
        $identity_document_dest = "uploads/identity_documents/" . $identity_document_new_name;
        move_uploaded_file($identity_document_tmp, $identity_document_dest);
    } else {
        $identity_document_new_name = null; // or fetch existing from DB if required
    }

    // Update personal details
    $query = "UPDATE personal_details SET name = ?, email = ?, ph_no = ?, alt_ph_no = ?, address = ?, college = ?, college_dpt = ? WHERE mem_id = ?";
    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }
    $stmt->bind_param('sssssssi', $name, $email, $ph_no, $alt_ph_no, $address, $college, $college_dept, $mem_id);
    $stmt->execute();
    if ($stmt->error) {
        die('Execute failed: ' . htmlspecialchars($stmt->error));
    }
    $stmt->close();

    // Update department
    $query = "UPDATE department SET dpt_name = ?, designation = ? WHERE mem_id = ?";
    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }
    $stmt->bind_param('sss', $department, $designation, $mem_id);
    $stmt->execute();
    if ($stmt->error) {
        die('Execute failed: ' . htmlspecialchars($stmt->error));
    }
    $stmt->close();

    // Update document details
    if (!is_null($profile_image_new_name) || !is_null($identity_document_new_name)) {
        $query = "UPDATE document SET profile_image = IFNULL(?, profile_image), identity_document = IFNULL(?, identity_document) WHERE mem_id = ?";
        $stmt = $conn->prepare($query);
        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($conn->error));
        }
        $stmt->bind_param('ssi', $profile_image_new_name, $identity_document_new_name, $mem_id);
        $stmt->execute();
        if ($stmt->error) {
            die('Execute failed: ' . htmlspecialchars($stmt->error));
        }
        $stmt->close();
    }

    // Redirect to the member's details page or a success page
    header("Location: mem_details.php?mem_id=" . htmlspecialchars($mem_id));
    exit();
} else {
    die('Invalid request.');
}
