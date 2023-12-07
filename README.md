# Personal Blog

Simple admin panel for your personal blog.

## Getting Started

### Prerequisites

- PHP 8.1 or higher
- Installed [Composer](https://getcomposer.org/)
- Configured PHP environment *(php-cli, php-mbstring and etc)* for working with Laravel

### Installing

Clone this repository to your computer, and go to application directory:

```shell
$ git clone https://github.com/Tiamenti/personal-blog.git
$ cd personal-blog
```

Install dependencies:

```shell
$ composer install
```

Copy the environment file:

```shell
$ cp .env.example .env
```

Generate an application key:

```shell
$ php artisan key:generate
```

Set up your database connection in the `.env` file and run the migrations: 

```shell
$ php artisan migrate
```

Create the symbolic link:

```shell
$ php artisan storage:link
```

*If uploaded images are not displayed after creating the symbolic link, you may have forgotten to change the `APP_URL` in the `.env` file.*

### Start development

To create a user with maximum permissions, run the following command with a username, email, and password:

```shell
$ php artisan orchid:admin admin admin@admin.com password
```

To populate the database with test data, use command:

```shell
$ php artisan db:seed
```

After it, run the development server:

```shell
$ php artisan serve
```

And enjoy!

## Deployment

To deploy the project to production, follow the steps in the [Installing](#installing) section. And run ProductionSeeder:

```shell
$ php artisan db:seed --class=ProductionSeeder
```

This seeder will configure the manager role in the database, which is necessary to create a manager account in the admin panel.

## Built With

* [Laravel](https://laravel.com/docs/10.x) - The web framework used
* [Orchid](https://orchid.software/) - Used to generate the interface of the admin panel

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/Tiamenti/personal-blog/tags).
