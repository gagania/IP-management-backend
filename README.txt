1. git clone https://github.com/gagania/IP-management-backend.git
2. go to the clone path
3. run composer install to generate depedencies in vendor folder
4. change .env.example to .env
5. run php artisan key:generate
6. Create database name : ip_management
7.configure .env
  - DB_DATABASE=
  - DB_USERNAME=
  - DB_PASSWORD=
8. run php artisan migrate
9. run php artisan passport:install
10. run php -S localhost:8000 -t public