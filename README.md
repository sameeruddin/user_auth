# user_auth
Basic user authentication system using PHP &amp; MySQL

Clone the repository to `htdocs` or `www` repository according to the tool (XAMPP or LAMPP)

Prerequisites:
1. XAMPP -> Start (Apache & MySQL)
   using PHPMyAdmin, create a database `user_auth` and import the `user_credentials` sql file
2. In `db_config.php` file, assumption for MySQL db connection has no password.

Use-case Execution:
1. Visit the index page, `localhost/user_auth/`
2. Create an account by visiting, `Register Here` page
3. If registration is successfull then, visit the Log In page
4. Enter the registered account credentials to access `dashboard` page
5. If the details are matched then, dashboard page will be loaded
6. In dashboard page, you have abutton to Log Out from your account.


