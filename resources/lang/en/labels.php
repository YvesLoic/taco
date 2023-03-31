<?php

return [
    "actions" => [
        "create" => "Create",
        "update" => "Update",
        "show" => "Show",
        "delete" => "Delete",
        "restore" => "Restore",
        "reset" => "Cancel",
        "messages" => [
            "success" => [
                "title" => "Success",
                "created" => "Provided data saved successfully",
                "updated" => "Provided data updated successfully",
                "deleted" => "Provided data deleted successfully",
                "restored" => "Provided data restored successfully",
                "changed" => "Your password have been changed successfully.",
            ],
            "error" => [
                "title" => "Error",
                "delete_data" => "Requested data is deleted",
                "not_found" => "Requested data not found in the system",
            ],
        ],
    ],
    "rules" => [
        "admin" => "Admin",
        "client" => "Client",
        "driver" => "Driver",
        "super" => "Super Admin",
    ],
    "error" => [
        "403" => "Unauthorized access",
        "404" => "Resource not found",
    ],
    "exception" => [
        "not_found" => "No data found with the value :id",
    ],
    "footer" => "All Rights Reserved.",
    "privacy_policy" => "Privacy Policy",
    "terms_service" => "Terms of Use",
    "created_at" => "Created At",
    "pending" => "Pending",
    "ongoing" => "On Going",
    "ended" => "Ended",
    "broadcast" => "Broadcasting",
    "join_at" => "Joined At",
    "deleted_at" => "Deleted At",
    "status" => "Status",
    "online" => "Online",
    "offline" => "Offline",
    "available" => "Available",
    "no_available" => "Deleted",
    "sidebar" => [
        "home" => "Home",
        "dashboard" => "Dashboard",
        "car_menu_title" => "Car Management",
        "displacement_menu_title" => "Displacement Management",
        "type_menu_title" => "Car Type Management",
        "user_menu_title" => "User Management",
        "city_menu_title" => "City Management",
        "user" => "User",
        "user_list" => "User List",
        "user_add" => "User Add",
        "type" => "Car Type",
        "car" => "Car",
        "type_list" => "Type List",
        "type_add" => "Type Add",
        "city_list" => "City List",
        "city_add" => "Create City",
        "car_list" => "Car List",
        "car_add" => "Car Add",
        "displacement_list" => "Displacement List",
        "displacement_add" => "Displacement Add",
    ],
    "navbar" => [
        "search" => "Type here to search...",
        "en" => "English",
        "fr" => "French",
        "hello" => "Hello",
        "profile" => [
            "show" => "My Profile",
            "show_details" => "View personal profile details.",
            "edit" => "Edit Profile",
            "edit_details" => "Modify your personal details.",
            "account" => "Account settings",
            "account_details" => "Manage your account parameters.",
            "setting" => "Privacy Settings",
            "setting_details" => "Control your privacy parameters.",
            "logout" => "Sign out",
        ],
    ],
    "login_page" => [
        "title" => "Login",
        "forgot" => "Forgot password?",
        "remember" => "Remember Me",
        "first_message" => "Enter your email address and password to access admin panel.",
        "email_label" => "Email address",
        "email_holder" => "Enter your email here...",
        "password_label" => "Password",
        "password_holder" => "Enter your password here...",
        "slider_title1" => "Manage Driver",
        "slider_content1" => "Take global view of available driver in your domain.",
        "slider_title2" => "Manage Client",
        "slider_content2" => "Take global view of available client in your domain.",
        "slider_title3" => "Confidentiality",
        "slider_content3" => "insure that all user's data are confident",
    ],
    "user" => [
        "attr" => [
            "first_name" => "First Name",
            "last_name" => "Last Name",
            "phone" => "Phone Number",
            "email" => "Email Address",
            "rule" => "Rule",
            "picture" => "Profile",
            "current" => "Current Password",
            "new_pass" => "New Password",
            "c_pass" => "Confirmation Password",
            "last_seen" => "Last Seen",
            "city" => "Lives in",
            "credit" => "Credit",
        ],
        "user_form" => [
            "first_name_label" => "User first name",
            "first_name_holder" => "Enter User first name here...",
            "last_name_label" => "User last name",
            "last_name_holder" => "Enter User last name here...",
            "phone_label" => "Phone number",
            "phone_holder" => "Enter phone number here...",
            "email_label" => "Address Email",
            "email_holder" => "Enter mail address here...",
            "password_label" => "User password",
            "password_holder" => "Enter password here...",
            "rule_label" => "User rule",
            "picture_label" => "User picture",
        ],
        "pages" => [
            "index" => [
                "title" => "User List",
                "card_title" => "User List",
                "empty_data" => "No records found....",
            ],
            "edit" => [
                "title" => "Edit my profile",
                "card_title" => "User List",
                "empty_data" => "No records found...",
            ],
            "create" => [
                "title" => "Add User",
                "card_title" => "User Information's",
                "empty_data" => "No records found...",
            ],
            "profile" => [
                "title" => "Profile",
                "edit_title" => "My Profile",
                "personal_nav" => "Personal Information's",
                "change_nav" => "Change Password",
                "about" => "About User",
                "trip" => "Displacements",
                "trip_list" => "User Trip",
                "cars" => "Cars",
                "notices" => "Note",
                "rank" => "User Rank",
                "points" => "Points",
                "more" => "More details",
                "actions" => "Delete/Restore",
            ],
        ],
    ],
    "type" => [
        "attr" => [
            "amount" => "Amount",
            "label" => "Type Name",
        ],
        "form" => [
            "amount_label" => "Amount",
            "amount_holder" => "Enter Type amount here...",
            "label_label" => "Type Name",
            "label_holder" => "Enter Type name here...",
            "type_car" => "Total car",
        ],
        "pages" => [
            "index" => [
                "title" => "Type List",
                "card_title" => "Type List",
            ],
            "create" => [
                "title" => "Add Type",
                "card_title" => "Type Information's",
            ],
            "details" => [
                "title" => "Type Details",
                "card_title" => "Type Information's",
                "car_tab" => "Associated car's",
            ],
        ],
    ],
    "city" => [
        "attr" => [
            "country" => "Country Name",
            "city" => "City Name",
        ],
        "form" => [
            "country_label" => "Country Name",
            "country_holder" => "Enter country name here...",
            "city_label" => "City Name",
            "city_holder" => "Enter Type name here...",
            "effective" => "Total users",
            "city_empty" => "Choose one",
        ],
        "pages" => [
            "index" => [
                "title" => "City List",
                "card_title" => "Cities",
            ],
            "create" => [
                "title" => "Add City",
                "card_title" => "City Information's",
            ],
            "details" => [
                "title" => "City Details",
                "card_title" => "City Information's",
                "car_tab" => "Associated users",
            ],
        ],
    ],
    "car" => [
        "attr" => [
            "color" => "Color",
            "gray_card" => "Type Name",
            "model" => "Car Model",
            "registration_number" => "Registration Number",
            "owner" => "Car Owner",
            "type" => "Car Type",
        ],
        "form" => [
            "color_label" => "Car color",
            "color_holder" => "Enter car color here...",
            "gray_cars_label" => "Gray card",
            "gray_card_holder" => "Enter Gray card here...",
            "model_label" => "Car model",
            "model_holder" => "Enter car model here...",
            "registration_number_label" => "Registration number",
            "registration_number_holder" => "Enter registration number here...",
            "type_label" => "Car type",
            "type_holder" => "Enter car type here...",
            "type_empty" => "Choose one",
            "user_label" => "Car Owner",
            "user_holder" => "Enter car owner here...",
            "user_empty" => "Choose one",
            "car_pics" => "Pictures",
            "pics_label" => "Drag & Drop files here or click to browse.",
        ],
        "pages" => [
            "index" => [
                "title" => "Car List",
                "card_title" => "Car List",
                "empty_data" => "No records found...",
            ],
            "create" => [
                "title" => "Add Car",
                "card_title" => "Car Information's",
            ],
            "details" => [
                "title" => "Car Details",
                "card_title" => "Car Information's",
                "car_tab" => "Car Details",
                "owner_tab" => "Car Owner",
                "type_tab" => "Car Type",
                "gallery" => "Gallery",
                "gallery_num" => "Pics",
                "places" => "Recent Trips",
                "no_pics" => "This car have no images...",
            ],
        ],
    ],
    "displacement" => [
        "attr" => [
            "to" => "To",
            "from" => "From",
            "distance" => "Distance",
            "price" => "Amount",
            "driver" => "Driver",
            "client" => "Client",
            "status" => "Status",
        ],
        "pages" => [
            "index" => [
                "title" => "Trip List",
                "card_title" => "Trip List",
                "empty_data" => "No records found...",
            ],
            "details" => [
                "title" => "Trip Details",
                "card_title" => "Trip representation",
                "client_tab" => "Client",
                "driver_tab" => "Driver",
                "trip_tab" => "Displacement",
                "client_sub" => "About client",
                "driver_sub" => "About driver",
                "trip_sub" => "About displacement",
            ],
        ],
    ],

];
