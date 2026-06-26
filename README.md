# Pritech Task

This task features its basic requirements and bonus features that were mentioned in the task.


## Tech Stack

- **PHP**: 8.4
- **Framework**: Laravel 13
- **Database**: MySQL (default)

## Getting Started

### Prerequisites

- PHP 8.4+
- Composer
- Node.js & NPM

### Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/oltion63/pritechTask.git
   cd pritechTask
   ```

2. Install PHP dependencies:
   ```bash
   composer install
   ```

3. Install and compile frontend assets:
   ```bash
   npm install
   npm run build
   ```

4. Configure your environment:
   ```bash
   php artisan key:generate
   ```

5. Run migrations and seed the database:
   ```bash
   php artisan migrate --seed
   ```

**Note**: The database seeding process creates dummy data for testing purposes. It is recommended to register a new user account via the application's registration page to access and test features properly.


## Development

To start the local development server:
```bash
php artisan serve
```

And compile assets in real-time:
```bash
npm run dev
```
