## Laravel Assignment

create API for user authentication and profile update. Admin can create an user using email, then system send an inviatation mail to user. then  user can register using email. After user registration system send another email including 6 digits verification code. Also your can update their process after authentication process is done.

## Setup Project

- update composer [composer update]
- generate app key [php artisan key:generate]
- migrate database [php artisan migrate]
- install passport [php artisan passport:install]
- seed database [php artisan seed:db] 
    check user seed file and change with it your details.
- Now Send the API request.

