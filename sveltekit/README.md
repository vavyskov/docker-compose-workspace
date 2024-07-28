# create-svelte

Notes:
```
(export NODE_EXTRA_CA_CERTS=/usr/local/share/ca-certificates/CA_1.crt)
export ORIGIN=https://dev-sveltekit.example.com
export PORT=80
node build/index.js

"dev": "export NODE_EXTRA_CA_CERTS=/usr/local/share/ca-certificates/CA_1.crt && vite dev --host --port 3001",
"build": "export NODE_EXTRA_CA_CERTS=/usr/local/share/ca-certificates/CA_1.crt && vite build",
"preview": "export NODE_EXTRA_CA_CERTS=/usr/local/share/ca-certificates/CA_1.crt && vite preview --host --port 3001",
"prod": "export NODE_EXTRA_CA_CERTS=/usr/local/share/ca-certificates/CA_1.crt && export ORIGIN=https://dev-sveltekit.example.com && export PORT=3001 && node build/index.js",
"test": "npm run test:integration && npm run test:unit",
```

---

## Quick start

1. Clone or download this repository.
1. Run command:
    ```bash
    (cp .env.example .env)
    cp .docker/dev/.env.local.example .docker/dev/.env.local
    sh dev_sveltekit_up.sh
    ```
1. SSH:
    ```bash
    ssh -p 2254 sveltekit@localhost
    ```

Everything you need to build a Svelte project, powered by [`create-svelte`](https://github.com/sveltejs/kit/tree/main/packages/create-svelte).

## Creating a project

If you're seeing this, you've probably already done this step. Congrats!

```bash
# create a new project in the current directory
npm create svelte@latest

# create a new project in my-app
npm create svelte@latest my-app
```

## Developing

Once you've created a project and installed dependencies with `npm install` (or `pnpm install` or `yarn`), start a development server:

```bash
(npm install)
npm run dev

# or start the server and open the app in a new browser tab
npm run dev -- --open
```

(Developing port: `5173`)

Doporučený postup testování vzhledu e-maulu (HTML i textová verze):
1. Linux + MailCatcher
2. Apple + iPad (iPhone, macOS atd.)
3. Outlook Web App
4. Windows + Outlook

## Testing

```bash
npm run test
```

Testy:
- Unit: `npm run test:unit`
- Integrační: `npm run test:integration`
  - Spouštět z lokálního počítače (Playwright nepodporuje Alpine linux)
    - ```bash
      npx playwright install
      ```

Playwright příklady:
- `npx playwright test` runs the end-to-end tests.
- `npx playwright test --headed` runs a visual representation of the tests.
- `npx playwright test --ui` starts the interactive UI mode.
- `npx playwright test --project=chromium` runs the tests only on Desktop Chrome.
- `npx playwright test example` runs the tests in a specific file.
- `npx playwright test --debug` runs the tests in debug mode.
- `npx playwright codegen` auto generate tests with Codegen.

## Building

To create a production version of your app:

```bash
(npm install)
npm run build
(npm run preview)
```

Preview URL: `dev-sveltekit.example.com` (kontrola kvality v Lighthouse)
Preview Port: `4173` (test odesílání pošty z vývoje do reálné poštovní schránky)

You can preview the production build with `npm run preview`.

> To deploy your app, you may need to install an [adapter](https://kit.svelte.dev/docs/adapters) for your target environment.
