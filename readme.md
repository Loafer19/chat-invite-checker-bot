# working

From [BotFather](https://t.me/BotFather), get your bot token and paste it in the `.env` file.

Then, run the following commands to set up a:

- database

```bash
php database/migrate.php
```

- telegram webhook:

```bash
php telegram/webhook.php
```

## start

Run for development:
```bash
php -S localhost:8000
```

Open in browser: