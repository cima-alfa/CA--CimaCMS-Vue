# Active Branch: v0.0.1

## After cloning this repo, do the following steps:

1. Duplicate the `.env.example` file and rename it to `.env`
2. Setup database connection
3. Duplicate the `vite.config.ts.example` file and rename it to `vite.config.ts`
4. `composer install`
5. `pnpm install`
6. Run `php artisan migrate`
7. Run `php artisan key:generate`
8. Run `php artisan serve`
9. Run `pnpm dev`

Todo:

1. If Front user dashboard exists, redirect registered users with insufficient control panel permissions to Front dashboard
    - Otherwise allow to see their profile in the control panel
2. VerificationController.php

    - `update()` -> Redirect to Front or CMS user dashboard (See number 1)

3. app.php
    - Redirect guest to login page (CMS or Front if enabled in config)
4. web.php (Routes)
    - `verification.notice` route - middleware to redirect already verified users to Front or CMS user dashboard (See number 1)
    - `password.edit` route - middleware to redirect to recovery request page if token and email in the url are invalid
