# ZephyrPHP Starter

A minimal starting point for ZephyrPHP applications.

> Light as a breeze, fast as the wind.

## Installation

```bash
composer create-project zephyrphp/starter my-app
cd my-app
cp .env.example .env
php craftsman key:generate
php craftsman serve
```

Your application will be running at `http://localhost:8000`

## Directory Structure

```
my-app/
├── app/
│   ├── Controllers/    # Application controllers
│   ├── Models/         # Database models
│   └── Middleware/     # HTTP middleware
├── config/             # Configuration files
├── pages/              # Twig view templates
├── public/             # Web root (index.php)
├── routes/             # Route definitions
├── storage/            # Logs and cache
└── tests/              # Test files
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
