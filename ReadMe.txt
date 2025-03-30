This file contains of two parts: in Ukrainian and English
Цей файл складається з двох частин: на українській і на англійській

Instructions in English:
 First. You need to execute 'docker-compose up' command in terminal, then go to app
 directory with this command 'docker-compose exec app bash' and run migrations with 'php artisan migrate'

After that you need to register, you can do it manually via this link 'http://localhost:8000/register'
 or with postman using Post request http://localhost:8000/api/register, here is JSON template for it:
 {
     "name": "your_name",
     "email": "user@example.com",
     "password": "your_password",
     "confirm_password": "your_password"
 }

 Then take Bearer Token in the response of your request, and after that you can test all features of
 this program, here are all links for testing API requests and templates for them:

create product:
 POST http://127.0.0.1:8000/api/create_product
{
    "name": "dxracer",
    "description": "cool chair",
    "price": "999",
    "category_id": "1",
    "image": "asd.jpg"
}    //IMPORTANT: you need to category in DataBase previously


get list of products:
GET http://127.0.0.1:8000/api/products || http://127.0.0.1:8000/api/products{id}
{
    "category_id": "2",
    "max_price": "1000"
}  // also you can use min_price

update product:
PUT http://127.0.0.1:8000/api/products/{id}
{
    "name": "new_dxracer",
    "description": "super cool chair",
    "price": "500",
    "category_id": "1",
    "image": "asd.jpg"
}

delete product:
DELETE http://127.0.0.1:8000/api/products/{id}


create comment
POST http://127.0.0.1:8000/api/comments
{
    "content": "some coment",
    "user_id": "1",
    "product_id": "2"
}

delete comment
DELETE http://127.0.0.1:8000/api/comments/{id}

Get comments
http://127.0.0.1:8000/api/comments/{id}

Make order
POST http://127.0.0.1:8000/api/orders
{
    "items": [
        { "product_id": 2, "quantity": 17 }
    ]
}

View order history
GET http://127.0.0.1:8000/api/orders


Спочатку. Вам потрібно виконати команду 'docker-compose up' у терміналі, потім перейдіть у директорію app за допомогою цієї команди 'docker-compose exec app bash' і запустіть міграції командою 'php artisan migrate'

Після цього вам потрібно зареєструватися, ви можете зробити це вручну за цим посиланням 'http://localhost:8000/register'
або через Postman, використовуючи POST-запит http://localhost:8000/api/register, ось JSON-шаблон для цього:



{
    "name": "your_name",
    "email": "user@example.com",
    "password": "your_password",
    "confirm_password": "your_password"
}
Потім візьміть Bearer Token у відповіді на ваш запит, і після цього ви можете тестувати всі функції
цієї програми, ось усі посилання для тестування API-запитів і шаблони для них:

Створити продукт:
POST http://127.0.0.1:8000/api/create_product

{
    "name": "dxracer",
    "description": "cool chair",
    "price": "999",
    "category_id": "1",
    "image": "asd.jpg"
}  //ВАЖЛИВО: вам потрібно попередньо додати категорію в базу даних

Отримати список продуктів:
GET http://127.0.0.1:8000/api/products || http://127.0.0.1:8000/api/products{id}
{
    "category_id": "2",
    "max_price": "1000"
}
// також ви можете використовувати min_price

Оновити продукт:
PUT http://127.0.0.1:8000/api/products/{id}
{
    "name": "new_dxracer",
    "description": "super cool chair",
    "price": "500",
    "category_id": "1",
    "image": "asd.jpg"
}
Видалити продукт:
DELETE http://127.0.0.1:8000/api/products/{id}

Створити коментар:
POST http://127.0.0.1:8000/api/comments

{
    "content": "some coment",
    "user_id": "1",
    "product_id": "2"
}
Видалити коментар:
DELETE http://127.0.0.1:8000/api/comments/{id}

Отримати коментарі:
GET http://127.0.0.1:8000/api/comments/{id}

Зробити замовлення:
POST http://127.0.0.1:8000/api/orders
{
    "items": [
        { "product_id": 2, "quantity": 17 }
    ]
}
Переглянути історію замовлень:
GET http://127.0.0.1:8000/api/orders
