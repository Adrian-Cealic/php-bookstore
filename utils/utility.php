<?php
function ValidateUserFile($file, $dir)
{
    $upload_dir = "../assets/$dir/";
    $allowed_types = ['image/png', 'image/jpeg', 'image/gif', 'image/jpg'];
    $errors = [];
    $profile_pic_path = null;

    if ($file['error'] == UPLOAD_ERR_OK) {
        if (in_array($file['type'], $allowed_types)) {
            $file_ext = pathinfo($file['name'], PATHINFO_EXTENSION);
            $file_name = uniqid() . '.' . $file_ext;
            $file_path = $upload_dir . $file_name;

            if (move_uploaded_file($file['tmp_name'], $file_path)) {
                $profile_pic_path = $file_name;
            } else {
                $errors[] = 'Failed to upload profile picture.';
            }
        } else {
            $errors[] = 'Invalid file type. Only PNG, JPEG, GIF, and JPG are allowed.';
        }
    } elseif ($file['error'] != UPLOAD_ERR_NO_FILE) {
        $errors[] = 'An error occurred during the file upload.';
    }

    return ['path' => $profile_pic_path, 'errors' => $errors];
}
