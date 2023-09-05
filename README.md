## Starting the service
1. With composer installed on your machine, navigate to the application's root directory
2. Run `composer install` to install required dependencies
3. Run Docker container `./vendor/bin/sail up`
4. Run migration files `./vendor/bin/sail artisan migrate`

You should be able to access the application through localhost at port 8888 as configured in the docker-compose.yml file
## Api Routes
**Add** 

`localhost:8888/api/item/add`

**Delete** 

`localhost:8888/api/item/delete`

**Mark Complete** 

`localhost:8888/api/item/mark-complete`

**list** 

`localhost:8888/api/items/list`

## Getting the bearer token

1. Login using the route `localhost:8888/auth/google`
2. Get Bearer token via `localhost:8888/auth/token`

## Testing the application

Use Postman to test the methods above by performing GET requests including authorization token.


