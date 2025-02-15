<?php
include 'db_connection.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $ph_no = $_POST['ph_no'];
    $alt_ph_no = $_POST['alt_ph_no'];
    $address = $_POST['address'];
    $college = $_POST['college'];
    $college_dept = $_POST['college_dept'] === 'Other' ? $_POST['other_college_dept'] : $_POST['college_dept'];
    $department = $_POST['department'];
    $designation = $_POST['designation'];

    $profile_image = $_FILES['profile_image'];
    $identity_document = $_FILES['identity_document'];

    // Create folder with person's name in the uploads directory
    $folder_name = 'uploads/' . preg_replace('/\s+/', '_', strtolower($name));
    if (!is_dir($folder_name)) {
        mkdir($folder_name, 0777, true);
    }

    $profile_image_ext = pathinfo($profile_image['name'], PATHINFO_EXTENSION);
    $identity_document_ext = pathinfo($identity_document['name'], PATHINFO_EXTENSION);

    $profile_image_new_name = 'profile_' . preg_replace('/\s+/', '_', strtolower($name)) . '.' . $profile_image_ext;
    $identity_document_new_name = 'identity_' . preg_replace('/\s+/', '_', strtolower($name)) . '.' . $identity_document_ext;

    $profile_image_path = $folder_name . '/' . $profile_image_new_name;
    $identity_document_path = $folder_name . '/' . $identity_document_new_name;

    if (move_uploaded_file($profile_image['tmp_name'], $profile_image_path) && move_uploaded_file($identity_document['tmp_name'], $identity_document_path)) {

        if (in_array($designation, ["President", "Secretary", "Treasurer"])) {
            $sql = "SELECT * FROM department WHERE designation='$designation'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<script>
                alert('Error: The designation $designation is already taken.');
                window.history.back();
              </script>";
                exit();
            }
        }
        if ($designation == "Department Head") {
            $sql = "SELECT * FROM department WHERE dpt_name='$department' AND designation='Department Head'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<script>
                alert('Error: The designation $designation is already taken.');
                window.history.back();
              </script>";
                exit();
            }
        }

        // Insert into personal_details
        $stmt = $conn->prepare("INSERT INTO personal_details (name, email, ph_no, alt_ph_no, address, college, college_dpt) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $name, $email, $ph_no, $alt_ph_no, $address, $college, $college_dept);

        if ($stmt->execute()) {
            // Get the last inserted ID
            $mem_id = $conn->insert_id;
        } else {
            echo "<script>alert('Error inserting into personal_details: " . $stmt->error . "');</script>";
            exit;
        }

        // Insert into department with mem_id
        $stmt = $conn->prepare("INSERT INTO department (dpt_name, designation, mem_id) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $department, $designation, $mem_id);

        if ($stmt->execute()) {
            // Insert into document table with mem_id
            $stmt = $conn->prepare("INSERT INTO document (profile_image, identity_document, mem_id) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $profile_image_path, $identity_document_path, $mem_id);

            if ($stmt->execute()) {
                echo "<script>
                    alert('All records inserted successfully.');
                    window.location.href = 'all_members.php';
                </script>";
                exit();
            } else {
                echo "<script>alert('Error inserting into document: " . $stmt->error . "');</script>";
                exit;
            }
        } else {
            echo "<script>alert('Error inserting into department: " . $stmt->error . "');</script>";
            exit;
        }

        $stmt->close();
    } else {
        echo "<script>alert('Failed to upload files.');</script>";
    }
} else {
    echo "<script>alert('Invalid request.');</script>";
    exit;
}
