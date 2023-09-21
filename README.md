<br/>
<p align="center">
  <a href="https://github.com/IsmoilObidov/LaravelShop">
    <img src="https://www.mystoma.ru/blog/wp-content/uploads/2016/09/магазин.png" alt="Logo" width="80" height="80">
  </a>

  <h3 align="center">Документация </h3>

  <p align="center">
    Кратко о том как работает мой проект 
    <br/>
    <br/>
    <a href="https://github.com/IsmoilObidov/LaravelShop"><strong>Explore the docs »</strong></a>
    <br/>
    <br/>
    <a href="https://github.com/IsmoilObidov/LaravelShop">View Demo</a>
    .
    <a href="https://github.com/IsmoilObidov/LaravelShop/issues">Report Bug</a>
    .
    <a href="https://github.com/IsmoilObidov/LaravelShop/issues">Request Feature</a>
  </p>
</p>

![Downloads](https://img.shields.io/github/downloads/IsmoilObidov/LaravelShop/total) ![Contributors](https://img.shields.io/github/contributors/IsmoilObidov/LaravelShop?color=dark-green) ![Forks](https://img.shields.io/github/forks/IsmoilObidov/LaravelShop?style=social) ![Stargazers](https://img.shields.io/github/stars/IsmoilObidov/LaravelShop?style=social) ![Issues](https://img.shields.io/github/issues/IsmoilObidov/LaravelShop) ![License](https://img.shields.io/github/license/IsmoilObidov/LaravelShop) 

## Table Of Contents

* [About the Project](#about-the-project)
* [Built With](#built-with)
* [Getting Started](#getting-started)
  * [Prerequisites](#prerequisites)
  * [Installation](#installation)
* [Usage](#usage)
* [Contributing](#contributing)
* [License](#license)
* [Authors](#authors)
* [Acknowledgements](#acknowledgements)

## About The Project

![Screen Shot](https://avatars.mds.yandex.net/i?id=59251b40ab32fe3686518e95d833ea2912a90f14-9213890-images-thumbs&n=13)

Программа сделано для тестовое задание.
П/С: только бэкенд часть, можно тестировать в ``POSTMAN`` 

У себя содержит раздел :
* Аутентификации
* Продукты
* Корзина 
* Мульти Категории 

 

## Built With

* ``PHP - 8.1``
* ``Laravel - ^10.10``

## Getting Started

Это пример того, как вы можете дать инструкции по настройке вашего проекта локально.
Чтобы запустить локальную копию, выполните следующие простые шаги.

### Prerequisites

Это пример того, как составить список вещей, необходимых для использования программного обеспечения, и того, как их установить.


### Installation

1.  Установить [Open Server Panel](https://ospanel.io/download/)


2. Clone the repo
```sh
git clone https://github.com/IsmoilObidov/LaravelShop.git
```

3. Установить Пакеты

```JS
composer install
```
4. Установить Laravel Shopping.postman_collection.json файл в своем workspace в postman 

## Usage

Установить настройки 
```JS
php artisan migrate --seed
```


## admin
          Username: admin
          Password: reteryut10

## user
         Username: user
         Password: reteryut10

___________________________________________________


`` Остальное по тз `` 

Кратко о том как работает ``  мульти  категория ``  

## Давайте разберёмся

Как работает система мультикатегорий (иерархическая структура категорий), которую мы создали на Laravel.

### Модель и структура БД

В таблице `categories` у нас есть колонка `parent_id`, которая ссылается на тот же `id` в этой же таблице. Это создаёт иерархическую (деревянную) структуру.

1. Если у категории `parent_id` равен `NULL`, это означает, что данная категория является основной (родительской) категорией.
2. Если у категории `parent_id` имеет значение (например, 5), это означает, что эта категория является дочерней (подкатегорией) к категории с `id` равным 5.

### Модель Category

Внутри модели `Category` у нас есть два отношения:

1. `parent()`: Возвращает родительскую категорию для текущей категории (если она существует). Это отношение `belongsTo`, потому что дочерняя категория принадлежит родительской.
2. `children()`: Возвращает коллекцию дочерних категорий для текущей категории (если они существуют). Это отношение `hasMany`, так как у одной родительской категории может быть множество дочерних категорий.

### Контроллер

1. В методе `create()` мы получаем все основные категории (те, у которых нет родителей) и передаём их в представление. Это позволяет нам выбрать родительскую категорию при создании новой.
2. В методе `store()` мы сохраняем новую категорию в базу данных. Если был выбран `parent_id`, то новая категория становится дочерней для выбранной родительской категории.
3. В методе `destroy()` мы просто удаляем категорию. Из-за настроенного внешнего ключа с `onDelete('cascade')` при удалении родительской категории будут автоматически удалены все её дочерние категории.

### Представление

В представлении у нас есть форма для создания новой категории. В этой форме можно выбрать родительскую категорию из выпадающего списка. Если родительская категория не выбрана, новая категория становится основной.

---

## Contributing



### Creating A Pull Request

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

Distributed under the MIT License. See [LICENSE](https://github.com/IsmoilObidov/LaravelShop/blob/main/LICENSE.md) for more information.

## Authors

* **ISMOILOBIDOV** - *Science Fiction* - [ISMOILOBIDOV](https://github.com/IsmoilObidov/) - *Built ReadME*
