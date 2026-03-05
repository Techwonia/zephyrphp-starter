# ZephyrPHP Starter

A CMS-powered starting point for ZephyrPHP applications.

> Light as a breeze, fast as the wind.

## Installation

```bash
composer create-project zephyrphp/starter my-app
cd my-app
cp .env.example .env
php craftsman key:generate
```

Configure your database in `.env`:
```
DB_CONNECTION=pdo_mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=zephyrphp
DB_USERNAME=root
DB_PASSWORD=
```

Create database tables and start the server:
```bash
php craftsman db:schema
php craftsman serve
```

Your application will be running at `http://localhost:8000`

## Getting Started

1. Visit `/register` to create your first account (first user gets admin role)
2. Visit `/cms` to access the CMS dashboard
3. Create page types, collections, and content through the CMS admin

## Included Modules

- **Database** - Doctrine ORM integration
- **Auth** - Session-based authentication (login, register, logout)
- **Authorization** - Gates, policies, and roles
- **CMS** - Content management with page builder, collections, and themes

## Directory Structure

```
my-app/
├── app/
│   ├── Controllers/
│   │   ├── Auth/           # Login & Register controllers
│   │   └── HomeController  # Home page
│   ├── Models/
│   │   ├── User.php        # User model with roles
│   │   └── Role.php        # Role model
│   └── Middleware/
├── config/
│   ├── app.php             # Application settings
│   ├── auth.php            # Auth provider config
│   ├── modules.php         # Module on/off switches
│   └── assets.php          # Asset collections
├── pages/
│   ├── auth/               # Login & register views
│   ├── layouts/            # Base layout
│   ├── errors/             # Error pages
│   └── themes/default/     # CMS theme (layouts, templates, partials)
├── public/                 # Web root (index.php)
├── routes/                 # Route definitions
├── storage/                # Logs and cache
└── tests/
```

## Documentation

Visit [https://zephyrphp.com/docs](https://zephyrphp.com/docs) for full documentation.

## Author

**Techwonia**
- ZephyrPHP: [zephyrphp.com](https://zephyrphp.com)
- Company: [techwonia.com](https://techwonia.com)
- Email: opensource@techwonia.com
- GitHub: [@Techwonia](https://github.com/Techwonia)

## License

MIT License - see [LICENSE](LICENSE) for details.
