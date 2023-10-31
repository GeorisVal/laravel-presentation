<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Steps

1) sail up -d
2) npm install
3) npm run dev
4) sail composer require laravel/breeze --dev
5) sail artisan breeze:install 
   Breeze with Alpine
   Yes
   PHPUnit
6) sail artisan migrate
7) Changer méthode connexion email -> password ? Si non, skip 7
7a) Changer migration: database > migrations > 2014_10_12_0000000_create_users_table.php
	Replace 'name' by 'username' on line 16; add ->unique()
7b) Changer factory & seeder
	database > factories > UserFactory.php
		'name' => fake()->name() to 'username' => fake()->userName()
	database > seeders > DatabaseSeeder.php
		Line 18: 'name' to 'username'
7c) Changer login request: App > Http > Requests > Auth > LoginRequest.php, 'email' to 'username' 
	Line 44
	Line 48
	Line 71
	Line 83
7d) Changer 'ProfileUpdateRequest': App > Http > Requests > ProfileUpdateRequest.php
	Line 19: 'name' to 'username', copy/paste Rule::unique from email to username
7e) Changer 'register' controller: App > Http > Controllers > Auth > RegisteredUserController.php
	Line 34: change 'name' to 'username', add "'unique:'.User::class" in array
	Line 40: 'name' => $request->name to 'username' => $request->username
7f) Changer 'user' model: App > Http > Models > User.php
	Line 21: 'name' to 'username'
7g) Changer views: 
	resources > views > auth > login.blade.php
		Replace 'email' with 'username'
			Lines 10, 11
	resources > views > auth > register.blade.php
		Replace 'name' with 'username'
			Lines 7, 8, 9
	resources > views > layouts > navigation.blade.php
		Replace 'name' with 'username'
			Lines 26, 78
		Remove useless line 79
	resources > views > profile > partials > update-profile-information-form.blade.php
		Replace 'name' with 'username'
			Lines 21, 22, 23
8) Create files
	Make model + controller + migration + seeder
		sail artisan make:model -msc Posts
9) Edit migrations, add columns, etc.
	text
	longText
	boolean
	float
	default
	nullable
10) Talk about routes and middlewares
11) Generate new middleware with sail artisan make:middleware isAdmin
11a)
    if(Auth::user() && Auth::user()->isAdmin === 1) {
        return $next($request);
    }

        return redirect(RouteServiceProvider::HOME)->with('error', __(('text.access_denied')));

12) Generate seeders based on migration
13) Talk about other Artisan commands
14) Tinker
    App\Models\User::factory()->create(['name' => 'Billy']) (q to exit)
    $user = App\Models\User::find(id) (q to exit)
    $user->update(['email' => 'test@email.co'])
    $user (q to exit)
