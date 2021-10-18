## How to Set up the project

- Create .env file if not exist into project's root.
- Copy content from `.env.example` and paste it into `.env`
- Run `composer install`
- Run `php artisan key:generate`
- Set up the DB configurations into `.env`

      DB_CONNECTION=mysql
      DB_HOST=127.0.0.1
      DB_PORT=3306 (your sql port number)
      DB_DATABASE=lara_builder (database name)
      DB_USERNAME=root (database username)
      DB_PASSWORD=root (database password)


- Run `php artisan migrate --seed`

## Import Postman Collection

Import postman collection from `project_root/postman/postman_collection.json`

    ### Default User Credentials

- Email : `Brenden_Kutch8@yahoo.com`
- Password : `mHdN2jB6Jh3wUPj`
    ### Default Admin Credentials

- Email : `Jevon_Ullrich@hotmail.com`
- Password : `LIDL3E0qpatL8K5`

Note: you can change the admin / user credentials as you want and then again you have to run php artisan migrate:fresh --seed


#### Other Information :

- Role Admin will have all the permission by default.
- We are providing Roles / Permissions APIs from where you can create new role and assign permissions to related Role
- If You are assigning some Role to User then all permissions of that Role will be default assigned to that user.
