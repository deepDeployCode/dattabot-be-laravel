# introduce

<h5>API dattabot di build on framework laravel version 9 with versi php 8.0, make sure your version php greether than >=7 </h5>

<h5>
module php require for use this is project is: pdo_mysqli, mysqli, xml, mbstring, curl, xml, zip, tokenizer, mongodb
</h5>

```bash
#dependancy usage:
1. passport JWT
2. psr/http-message
3. oauth2-server

```

# Composer Run

```Bash
composer install
```

# Migrate Run

```Bash
php artisan migrate (required)
# migrate refresh event update schema column table
php artisan migrate:refresh (optional)
# event delete all structure table
php artisan migrate:rollback (optional)

```

# Seeder Run

```Bash
php artisan db:seed
```

# Passport JWT install

```Bash
php artisan passport:install
```

# Start Server

```Bash
php artisan serve
```

# Test Endpoint API

```Bash
#Login
{{base_url}}/api/v1/auth/login ->POST

#baseUrl
base url use on local. ex:http://localhost:8000 atau http://127.0.0.1:8000
but if we use url from server like this. ex: https://dev-api-dattabot.betalogika.tech
```

# Access API with session

<h5>if want to consume api with session and then send two object params to request header, like this</h5>

```JSON
{
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {{token}}",
}
```

# Test Request TDC API

```Bash

#hint
1. -H : is request header
2. -d : is request params (query,body)
3. -X : is request method (get,post,put,delete,...dst)

curl -X GET \https://dev-api-dattabot.betalogika.tech => base URL

#hit login API via body/request params //umail is username or password
curl -H 'Content-Type: application/json' \
      -d '{ "umail":"dattabot@gmail.com", "password": "12345678910"}' \
      -X POST \
      https://dev-api-dattabot.betalogika.tech/api/v1/auth/login

#hit register API via body/request params
curl -H 'Content-Type: application/json' \
      -d '{ "name":"dattabot", "username": "dattabot", "email": "dattabot@gmail.com", "password": "12345", "password_confirmation": "12345"}' \
      -X POST \
      https://dev-api-dattabot.betalogika.tech/api/v1/auth/register


#hit logout user
curl -H 'Content-Type: application/json' \
    -H 'Accept: application/json' \
    -H 'Authorization: Bearer {{token}}' \
    -X POST \
    https://dev-api-dattabot.betalogika.tech/api/v1/auth/logout

```

# Env

```Bash
#please download this env and try on your local
Link: https://docs.google.com/document/d/1UwpTaMkT_yRKjBFGVek9ZEA09EGoiqY2svWfLU4Q560/edit?usp=sharing
```
