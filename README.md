# ZephyrPHP Starter

Create a new ZephyrPHP CMS website.

## Installation

```bash
composer create-project zephyrphp/starter mysite
cd mysite
php craftsman serve
```

Open `http://localhost:8000` — the setup wizard will guide you through database configuration and admin account creation.

## What's Included

- **CMS Admin Panel** — Visual page builder, theme customizer, media library
- **Content Collections** — Create any content type with custom fields
- **User Management** — Role-based permissions
- **AI Content Tools** — Generate pages with AI (Gemini, Claude, OpenAI, etc.)
- **Plugin System** — Extend with hooks and filters
- **Analytics** — Built-in privacy-safe page tracking

## Directory Structure

```
mysite/
├── app/
│   ├── Controllers/Auth/    # Login controller
│   ├── Models/              # User & Role models
│   └── Setup/               # Setup wizard
├── config/
│   ├── app.php              # App name, env, timezone
│   └── ai.php               # AI provider config
├── pages/
│   ├── auth/                # Login page
│   ├── setup/               # Setup wizard
│   └── themes/hello/        # Default theme
├── public/                  # Web root
├── routes/web.php           # Route definitions
└── storage/                 # Logs, cache, uploads
```

## Documentation

[https://zephyrphp.com/docs](https://zephyrphp.com/docs)

## License

MIT License
