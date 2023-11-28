# Laravel Framework

**Description:** The Laravel Framework is a powerful PHP framework for web artisans. It provides an elegant syntax, a robust set of tools, and a vibrant developer community.
Tampilan https://tampilandiplomat3.vercel.app/
## Installation

Make sure you have [Composer](https://getcomposer.org/) installed. Then run the following command:

```bash
composer create-project --prefer-dist laravel/laravel my-laravel-app
```

## Project Structure

The project follows the standard Laravel directory structure:

- `app/`: Contains the application's core code.
- `database/`: Houses database migrations and seeders.
- `public/`: The web server's document root.
- `resources/`: Contains views, language files, and assets.
- `routes/`: Defines the application's routes.
- `tests/`: Contains automated tests.

## Dependencies

- **PHP:** Requires PHP version 7.2.5 or higher.
- **laravel/framework:** The core Laravel framework.
- **laravel/ui:** Frontend scaffolding for Bootstrap, Vue, or React (version 2.4).
- **laravel/tinker:** Interactive REPL for Laravel.
- **barryvdh/laravel-dompdf:** Laravel wrapper for the Dompdf library.
- **fideloper/proxy:** Trusting proxy load balancer for Laravel.
- **fruitcake/laravel-cors:** Adds CORS (Cross-Origin Resource Sharing) support.
- **guzzlehttp/guzzle:** HTTP client for sending HTTP requests.
- **maatwebsite/excel:** A package for reading and writing Excel files.
- **realrashid/sweet-alert:** A beautiful replacement for JavaScript's alert.
- **spatie/laravel-permission:** Handles user permissions and roles.

## Development Dependencies

- **facade/ignition:** A beautiful error page for Laravel.
- **fzaninotto/faker:** A library for generating fake data.
- **mockery/mockery:** Mockery is a simple yet flexible PHP mock object framework.
- **nunomaduro/collision:** Better error reporting.
- **phpunit/phpunit:** Unit testing framework.

## Autoloading

The project follows the PSR-4 autoloading standard for classes.

## Configuration

- `optimize-autoloader`: Optimizes the autoloader for better performance.
- `preferred-install`: Installs packages from "dist" by default.
- `sort-packages`: Sorts packages by name when updating.

## Chart JS Integration

This project utilizes Chart.js for data visualization. Please refer to the relevant documentation to integrate and customize charts in your application.

## Scripts

- `post-autoload-dump`: Runs various tasks after the autoloader is dumped.
- `post-root-package-install`: Copies the `.env.example` file to `.env` upon package installation.
- `post-create-project-cmd`: Generates an application key after creating a new project.

## Contributing

Please read [CONTRIBUTING.md](CONTRIBUTING.md) for details on our code of conduct and the process for submitting pull requests.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details.
