# Montera App

CodeIgniter 3 application for Montera's internal operations. The repo includes a local Docker stack for PHP/Apache, with database access taken from the existing `.env`.

## Run locally with Docker

1. Create `.env` in the project root
2. You can start from `.env.docker.example` if you need Docker-oriented defaults
3. Fill in any third-party credentials you need
4. Start the stack:

```bash
docker compose up --build
```

5. Open:
   - App: `http://localhost:8080`

Docker Compose now reads the existing project `.env` file directly and the app container will fail fast if `.env` is missing.
The Docker stack does not start a local MySQL container; the app connects directly to the database defined in `.env`.

## Database setup

Set the real database connection in `.env` and Docker will use those values directly for the app.

## Environment files

- `.env`: active local credentials used by Docker Compose and the app
- `.env.example`: generic variable reference
- `.env.docker.example`: Docker-oriented starting point for local `.env`

## Notes

- Apache `mod_rewrite` is enabled in the image, so root-level `.htaccess` clean URLs work.
- The container bootstraps writable paths under `application/cache` and `application/logs`.
- This setup assumes vendored PHP dependencies already present in the repo; it does not run Composer during image build.
