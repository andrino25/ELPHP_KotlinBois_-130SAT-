## USER REGISTRATION

Request Type: POST<br>
https://gagambrawl-api.vercel.app/api/api/register<br>
Authorization: NONE<br>
Header:

    |----------KEY----------|---------VALUE---------|
    |-Content-Type----------|-application/json------|

Body: form-data

    |----------KEY----------|---------VALUE---------|
    |-email-----------------|-johndoe@gmail.com-----| (required)
    |-password--------------|-123123----------------| (required)
    |-password_confirmation-|-123123----------------| (required)

Returns:

    Response Code: 200
    Body:
    {
        "user": {
            "email": "johndoe@gmail.com",
            "updated_at": "2024-11-20T11:26:06.000000Z",
            "created_at": "2024-11-20T11:26:06.000000Z",
            "id": 1
        },
        "token": "1|S60SKS2CP6HTSG10Fy7MGRKxBNKHW7IEZ7wfI8KM3ed39155"
    }

## USER LOGIN

Request Type: POST<br>
https://gagambrawl-api.vercel.app/api/api/login<br>
Authorization: NONE<br>
Header:

    |----------KEY----------|---------VALUE---------|
    |-Content-Type----------|-application/json------|

Body: form-data

    |----------KEY----------|---------VALUE---------|
    |-email-----------------|-johndoe@gmail.com-----| (required)
    |-password--------------|-123123----------------| (required)

Returns:

    Response Code: 200
    Body:
    {
        "user": {
            "id": 1,
            "email": "johndoe@gmail.com",
            "email_verified_at": null,
            "userFirstName": null,
            "userMiddleName": null,
            "userLastName": null,
            "userAddress": null,
            "userProfilePicRef": null,
            "created_at": "2024-11-20T11:17:28.000000Z",
            "updated_at": "2024-11-20T11:17:28.000000Z"
        },
        "token": "3|s4IgGkEyzGoaBVu1VNBVTSghtiJWZEMx9X4O9olj5b228c7f"
    }

## USER LOGOUT

Request Type: POST<br>
https://gagambrawl-api.vercel.app/api/api/logout<br>
Authorization: Bearer Token (from login response or register response)<br>
Header:

    |----------KEY----------|---------VALUE---------|
    |-Content-Type----------|-application/json------|

Body: NONE<br>

Returns:

    Response Code: 200
    Body:
    {
        "message": "Logged out successfully."
    }

## USER FORGOT PASSWORD

Request Type: POST<br>
https://gagambrawl-api.vercel.app/api/api/user/forgot-password<br>
Authorization: NONE<br>
Header:

    |----------KEY----------|---------VALUE---------|
    |-Content-Type----------|-application/json------|

Body: form-data

    |-------------KEY-------------|---------VALUE---------|
    |-email-----------------------|-johndoe@gmail.com-----| (required)
    |-new_password----------------|-456456----------------| (required)
    |-new_password_confirmation---|-456456----------------| (required)

Returns:

    Response Code: 200

    Body:
    {
        "message": "Password reset successfully. Please log in with your new password."
    }

## USER SHOW PROFILE

Request Type: GET<br>
https://gagambrawl-api.vercel.app/api/api/user<br>
Authorization: Bearer Token (from login response or register response)<br>
Header:

    |----------KEY----------|---------VALUE---------|
    |-Content-Type----------|-application/json------|

Body: NONE<br>

Returns:

    Response Code: 200
    Body:
    {
        "id": 1,
        "email": "johndoe2@gmail.com",
        "email_verified_at": null,
        "userFirstName": null,
        "userMiddleName": null,
        "userLastName": null,
        "userAddress": null,
        "userProfilePicRef": null,
        "created_at": "2024-11-20T11:40:17.000000Z",
        "updated_at": "2024-11-20T11:41:05.000000Z"
    }

## USER EDIT PROFILE

Request Type: POST<br>
URL: https://ratatowi-api.vercel.app/api/api/user/edit<br>
Authorization: Bearer Token (from login response or register response)<br>
Header:

    |----------KEY----------|---------VALUE---------|
    |-Content-Type----------|-application/json------|

Body: form-data

    |----------KEY----------|---------VALUE---------|
    |-_method---------------|-PATCH-----------------| (required)
    |-userFirstName---------|-John------------------| (optional)
    |-userMiddleName--------|-Doe-------------------| (optional)
    |-userLastName----------|-Glabog----------------| (optional)
    |-userAddress-----------|-Eskina Gloria---------| (optional)
    |-userProfilePicRef-----|-(optional, image file, only jpg/jpeg/jfif/png/webp)| (optional)

Returns:

    Response Code: 200
    Body:
    {
        "message": "Profile updated successfully.",
        "user": {
            "id": 1,
            "email": "johndoe2@gmail.com",
            "email_verified_at": null,
            "userFirstName": "John Kyle",
            "userMiddleName": "Mata",
            "userLastName": "Glabog",
            "userAddress": "Eskina Gloria",
            "userProfilePicRef": "https://i.ibb.co/qsFqbLY/987b71d2f934.jpg",
            "created_at": "2024-11-20T11:40:17.000000Z",
            "updated_at": "2024-11-20T11:43:16.000000Z"
        }
    }

## SPIDERS SHOW ALL

Request Type: GET<br>
https://gagambrawl-api.vercel.app/api/api/spiders<br>
Authorization: Bearer Token (from login response or register response)<br>
Header:

    |----------KEY----------|---------VALUE---------|
    |-Content-Type----------|-application/json------|

Body: NONE<br>

Returns:

    Response Code: 200
    Body:
    [
        {
            "id": 1,
            "user_id": 1,
            "spiderSpecies": "Gagamboy",
            "spiderHealthStatus": "Dying",
            "spiderBuyCost": 5,
            "spiderSellPrice": 7,
            "spiderQuantity": 20,
            "spiderImageRef": "https://i.ibb.co/r5c1Dqv/39dc4c94a6f3.jpg",
            "created_at": "2024-11-20T11:21:39.000000Z",
            "updated_at": "2024-11-20T11:21:39.000000Z"
        },
        {
            "id": 2,
            "user_id": 1,
            "spiderSpecies": "Tarantula",
            "spiderHealthStatus": "Dying",
            "spiderBuyCost": 5,
            "spiderSellPrice": 7,
            "spiderQuantity": 20,
            "spiderImageRef": "https://i.ibb.co/r5c1Dqv/39dc4c94a6f3.jpg",
            "created_at": "2024-11-20T11:22:22.000000Z",
            "updated_at": "2024-11-20T11:22:22.000000Z"
        },
        ...
    ]

## SPIDER SHOW SINGLE

Request Type: GET<br>
https://gagambrawl-api.vercel.app/api/api/spiders/{id}<br>
Authorization: Bearer Token (from login response or register response)<br>
Header:

    |----------KEY----------|---------VALUE---------|
    |-Content-Type----------|-application/json------|

Body: NONE<br>

Returns:

    Response Code: 200
    Body:
    {
        "id": 1,
        "user_id": 1,
        "spiderSpecies": "Gagamboy updated",
        "spiderHealthStatus": "Healthy asdas",
        "spiderBuyCost": 5,
        "spiderSellPrice": 7,
        "spiderQuantity": 20,
        "spiderImageRef": "https://i.ibb.co/8g93CSr/51072fc1a54c.jpg",
        "created_at": "2024-11-20T11:21:39.000000Z",
        "updated_at": "2024-11-20T11:23:57.000000Z"
    }

## SPIDER STORE

Request Type: POST<br>
https://gagambrawl-api.vercel.app/api/api/spiders<br>
Authorization: Bearer Token (from login response or register response)<br>
Header:

    |----------KEY----------|---------VALUE---------|
    |-Content-Type----------|-application/json------|

Body: form-data

    |----------KEY----------|---------VALUE---------|
    |-spiderSpecies---------|-Main Course-----------| (required)
    |-spiderHealthStatus----|-Creamy Tomato Soup----| (required)
    |-spiderBuyCost---------|-5---------------------| (required)
    |-spiderSellPrice-------|-9---------------------| (required)
    |-spiderQuantity--------|-20--------------------| (required)
    |-spiderImageRef--------|-(image file upload, only jpg/jpeg/jfif/png)---| (required)

Returns:

    Response Code: 200
    Body:
    {
        "spiderSpecies": "Tarantula",
        "spiderHealthStatus": "Dying",
        "spiderBuyCost": "5",
        "spiderSellPrice": "7",
        "spiderQuantity": "20",
        "spiderImageRef": "https://i.ibb.co/r5c1Dqv/39dc4c94a6f3.jpg",
        "user_id": 1,
        "updated_at": "2024-11-20T11:26:38.000000Z",
        "created_at": "2024-11-20T11:26:38.000000Z",
        "id": 1
    }

## SPIDER UPDATE

Request Type: POST<br>
URL: https://ratatowi-api.vercel.app/api/api/recipes/{id}<br>
Authorization: Bearer Token (from login response or register response)<br>
Header:

    |----------KEY----------|---------VALUE---------|
    |-Content-Type----------|-application/json------|

Body: form-data

    |----------KEY----------|---------VALUE---------|
    |-spiderSpecies---------|-Tarantula 2-----------| (optional)
    |-spiderHealthStatus----|-Dead------------------| (optional)
    |-spiderBuyCost---------|-5---------------------| (optional)
    |-spiderSellPrice-------|-9---------------------| (optional)
    |-spiderQuantity--------|-20--------------------| (optional)
    |-spiderImageRef--------|-(image file upload, only jpg/jpeg/jfif/png)---| (optional)

Returns:

    Response Code: 200
    Body:
    {
        "id": 1,
        "user_id": 1,
        "spiderSpecies": "Tarantula 2",
        "spiderHealthStatus": "Dead",
        "spiderBuyCost": "5",
        "spiderSellPrice": "7",
        "spiderQuantity": "20",
        "spiderImageRef": "https://i.ibb.co/8g93CSr/51072fc1a54c.jpg",
        "created_at": "2024-11-20T11:52:06.000000Z",
        "updated_at": "2024-11-20T11:54:04.000000Z"
    }

## SPIDER DELETE

Request Type: DELETE<br>
https://gagambrawl-api.vercel.app/api/api/spiders/{id}<br>
Authorization: Bearer Token (from login response or register response)<br>
Header:

    |----------KEY----------|---------VALUE---------|
    |-Content-Type----------|-application/json------|

Body: NONE<br>

Returns:

    Response Code: 200
    Body:
    {
        "message": "Tarantula 2 deleted successfully"
    }

## NOTIFICATIONS SHOW ALL

Request Type: GET<br>
https://gagambrawl-api.vercel.app/api/api/user/notifications<br>
Authorization: Bearer Token (from login response or register response)<br>
Header:

    |----------KEY----------|---------VALUE---------|
    |-Content-Type----------|-application/json------|

Body: NONE<br>

Returns:

    Response Code: 200
    Body:
    [
        {
            "id": 1,
            "user_id": 1,
            "spider_id": 1,
            "notifName": "Spider Added",
            "notifContent": "Tarantula has been successfully stored.",
            "notifType": "Creation",
            "created_at": "2024-11-20T11:26:38.000000Z",
            "updated_at": "2024-11-20T11:26:38.000000Z"
        },
        {
            "id": 2,
            "user_id": 1,
            "spider_id": 1,
            "notifName": "Spider Updated",
            "notifContent": "Tarantula 2 has been successfully updated.",
            "notifType": "Update",
            "created_at": "2024-11-20T11:27:53.000000Z",
            "updated_at": "2024-11-20T11:27:53.000000Z"
        },
        {
            "id": 3,
            "user_id": 1,
            "spider_id": 1,
            "notifName": "Spider Deleted",
            "notifContent": "Tarantula 2 has been successfully deleted.",
            "notifType": "Deletion",
            "created_at": "2024-11-20T11:28:13.000000Z",
            "updated_at": "2024-11-20T11:28:13.000000Z"
        }
    ]