<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

There are two types of user. Admin and Subadmin.

Every user can only see their own profile information using JWT Token which will generate while login. The token need to pass with Bearer through header authorization. After logout the token will be destroyed and users can't see their information.

The database name is laravel_jwt_mult_auth.

In Postman we need to send this data:

Admin Registration: 127.0.0.1:8000/api/admin/reg?name=admin2&email=admin2@e.c&password=aaaaaaaa&password_confirmation=aaaaaaaa
Admin Login: 127.0.0.1:8000/api/admin/login?email=admin1@e.c&password=aaaaaaaa
Admin Profile: 127.0.0.1:8000/api/admin/profile
Admin Logout: 127.0.0.1:8000/api/admin/logout

Sub Admin Registraion: 127.0.0.1:8000/api/subadmin/reg?name=subadmin2&email=subadmin2@e.c&password=aaaaaaaa&password_confirmation=aaaaaaaa
Sub Admin Login: 127.0.0.1:8000/api/subadmin/login?email=subadmin2@e.c&password=aaaaaaaa
Sub Admin Profile: 127.0.0.1:8000/api/subadmin/profile
Sub Admin Logout: 127.0.0.1:8000/api/subadmin/logout
