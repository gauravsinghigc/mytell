<?php
if (isset($_SESSION['LOGIN_USER_ID'])) {
    $UserId = $_SESSION['LOGIN_USER_ID'];
    define("LOGIN_USER_ID", $UserId);
    define("LOGIN_UserId", FETCH("SELECT * FROM users where UserId='$UserId'", "UserId"));
    define("LOGIN_UserFullName", FETCH("SELECT * FROM users where UserId='$UserId'", "UserFullName"));
    define("LOGIN_UserPhoneNumber", FETCH("SELECT * FROM users where UserId='$UserId'", "UserPhoneNumber"));
    define("LOGIN_UserEmailId", FETCH("SELECT * from users where UserId='$UserId'", "UserEmailId"));
    define("LOGIN_UserCreatedAt", FETCH("SELECT * FROM users where UserId='$UserId'", "UserCreatedAt"));
    define("LOGIN_UserUpdatedAt", FETCH("SELECT * FROM users where UserId='$UserId'", "UserUpdatedAt"));
    define("LOGIN_UserStatus", FETCH("SELECT * FROM users where UserId='$UserId'", "UserStatus"));
    define("LOGIN_UserProfileImage1", FETCH("SELECT * FROM users WHERE UserId='$UserId'", "UserProfileImage"));
    define("LOGIN_UserType", FETCH("SELECT * FROM users WHERE UserId='$UserId'", "UserType"));

    //user image
    if (LOGIN_UserProfileImage1 == "default.png") {
        define("LOGIN_UserProfileImage", STORAGE_URL_D . "/default.png");
    } else {
        define("LOGIN_UserProfileImage", STORAGE_URL_U . "/" . LOGIN_UserId . "/img/" . LOGIN_UserProfileImage1);
    }

    //no login
} else {
    header("location:" . DOMAIN . "/auth/");
}
