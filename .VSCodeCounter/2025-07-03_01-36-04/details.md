# Details

Date : 2025-07-03 01:36:04

Directory c:\\EDBERTO\\SEMESTRE 8.1\\SIG\\ProyectoFinal\\laravel_backend_zapateria

Total : 98 files,  11095 codes, 1242 comments, 824 blanks, all 13161 lines

[Summary](results.md) / Details / [Diff Summary](diff.md) / [Diff Details](diff-details.md)

## Files
| filename | language | code | comment | blank | total |
| :--- | :--- | ---: | ---: | ---: | ---: |
| [README.md](/README.md) | Markdown | 45 | 0 | 22 | 67 |
| [app/Console/Kernel.php](/app/Console/Kernel.php) | PHP | 15 | 7 | 6 | 28 |
| [app/Exceptions/Handler.php](/app/Exceptions/Handler.php) | PHP | 17 | 9 | 5 | 31 |
| [app/Http/Controllers/AsignacionController.php](/app/Http/Controllers/AsignacionController.php) | PHP | 85 | 7 | 26 | 118 |
| [app/Http/Controllers/Auth/AuthenticatedSessionController.php](/app/Http/Controllers/Auth/AuthenticatedSessionController.php) | PHP | 26 | 8 | 13 | 47 |
| [app/Http/Controllers/Auth/EmailVerificationNotificationController.php](/app/Http/Controllers/Auth/EmailVerificationNotificationController.php) | PHP | 18 | 3 | 6 | 27 |
| [app/Http/Controllers/Auth/NewPasswordController.php](/app/Http/Controllers/Auth/NewPasswordController.php) | PHP | 38 | 8 | 8 | 54 |
| [app/Http/Controllers/Auth/PasswordResetLinkController.php](/app/Http/Controllers/Auth/PasswordResetLinkController.php) | PHP | 25 | 8 | 7 | 40 |
| [app/Http/Controllers/Auth/RegisteredUserController.php](/app/Http/Controllers/Auth/RegisteredUserController.php) | PHP | 35 | 6 | 8 | 49 |
| [app/Http/Controllers/Auth/VerifyEmailController.php](/app/Http/Controllers/Auth/VerifyEmailController.php) | PHP | 24 | 3 | 6 | 33 |
| [app/Http/Controllers/CompraController.php](/app/Http/Controllers/CompraController.php) | PHP | 120 | 0 | 10 | 130 |
| [app/Http/Controllers/Controller.php](/app/Http/Controllers/Controller.php) | PHP | 135 | 1 | 23 | 159 |
| [app/Http/Controllers/DistribuidorController.php](/app/Http/Controllers/DistribuidorController.php) | PHP | 73 | 1 | 11 | 85 |
| [app/Http/Controllers/ProductoController.php](/app/Http/Controllers/ProductoController.php) | PHP | 102 | 4 | 27 | 133 |
| [app/Http/Controllers/VehiculoController.php](/app/Http/Controllers/VehiculoController.php) | PHP | 42 | 4 | 16 | 62 |
| [app/Http/Kernel.php](/app/Http/Kernel.php) | PHP | 42 | 20 | 7 | 69 |
| [app/Http/Middleware/Authenticate.php](/app/Http/Middleware/Authenticate.php) | PHP | 11 | 3 | 4 | 18 |
| [app/Http/Middleware/EncryptCookies.php](/app/Http/Middleware/EncryptCookies.php) | PHP | 8 | 6 | 4 | 18 |
| [app/Http/Middleware/EnsureEmailIsVerified.php](/app/Http/Middleware/EnsureEmailIsVerified.php) | PHP | 18 | 5 | 5 | 28 |
| [app/Http/Middleware/PreventRequestsDuringMaintenance.php](/app/Http/Middleware/PreventRequestsDuringMaintenance.php) | PHP | 8 | 6 | 4 | 18 |
| [app/Http/Middleware/RedirectIfAuthenticated.php](/app/Http/Middleware/RedirectIfAuthenticated.php) | PHP | 20 | 5 | 6 | 31 |
| [app/Http/Middleware/TrimStrings.php](/app/Http/Middleware/TrimStrings.php) | PHP | 11 | 5 | 4 | 20 |
| [app/Http/Middleware/TrustHosts.php](/app/Http/Middleware/TrustHosts.php) | PHP | 12 | 5 | 4 | 21 |
| [app/Http/Middleware/TrustProxies.php](/app/Http/Middleware/TrustProxies.php) | PHP | 14 | 10 | 5 | 29 |
| [app/Http/Middleware/ValidateSignature.php](/app/Http/Middleware/ValidateSignature.php) | PHP | 8 | 11 | 4 | 23 |
| [app/Http/Middleware/VerifyCsrfToken.php](/app/Http/Middleware/VerifyCsrfToken.php) | PHP | 8 | 6 | 4 | 18 |
| [app/Http/Requests/Auth/LoginRequest.php](/app/Http/Requests/Auth/LoginRequest.php) | PHP | 51 | 21 | 14 | 86 |
| [app/Models/Asignacion.php](/app/Models/Asignacion.php) | PHP | 20 | 0 | 6 | 26 |
| [app/Models/AsignacionDistribuidor.php](/app/Models/AsignacionDistribuidor.php) | PHP | 16 | 0 | 5 | 21 |
| [app/Models/Compra.php](/app/Models/Compra.php) | PHP | 37 | 0 | 5 | 42 |
| [app/Models/DetalleCompra.php](/app/Models/DetalleCompra.php) | PHP | 32 | 0 | 7 | 39 |
| [app/Models/Distribuidor.php](/app/Models/Distribuidor.php) | PHP | 24 | 0 | 5 | 29 |
| [app/Models/MetodoPago.php](/app/Models/MetodoPago.php) | PHP | 18 | 0 | 7 | 25 |
| [app/Models/Producto.php](/app/Models/Producto.php) | PHP | 32 | 0 | 6 | 38 |
| [app/Models/TipoProducto.php](/app/Models/TipoProducto.php) | PHP | 22 | 0 | 5 | 27 |
| [app/Models/Ubicacion.php](/app/Models/Ubicacion.php) | PHP | 48 | 0 | 4 | 52 |
| [app/Models/User.php](/app/Models/User.php) | PHP | 40 | 16 | 8 | 64 |
| [app/Models/Vehiculo.php](/app/Models/Vehiculo.php) | PHP | 32 | 0 | 4 | 36 |
| [app/Providers/AppServiceProvider.php](/app/Providers/AppServiceProvider.php) | PHP | 12 | 8 | 5 | 25 |
| [app/Providers/AuthServiceProvider.php](/app/Providers/AuthServiceProvider.php) | PHP | 16 | 10 | 7 | 33 |
| [app/Providers/BroadcastServiceProvider.php](/app/Providers/BroadcastServiceProvider.php) | PHP | 12 | 3 | 5 | 20 |
| [app/Providers/EventServiceProvider.php](/app/Providers/EventServiceProvider.php) | PHP | 21 | 12 | 6 | 39 |
| [app/Providers/RouteServiceProvider.php](/app/Providers/RouteServiceProvider.php) | PHP | 24 | 10 | 7 | 41 |
| [bootstrap/app.php](/bootstrap/app.php) | PHP | 17 | 30 | 9 | 56 |
| [composer.json](/composer.json) | JSON | 67 | 0 | 1 | 68 |
| [composer.lock](/composer.lock) | JSON | 8,196 | 0 | 1 | 8,197 |
| [config/app.php](/config/app.php) | PHP | 28 | 131 | 32 | 191 |
| [config/auth.php](/config/auth.php) | PHP | 28 | 74 | 14 | 116 |
| [config/broadcasting.php](/config/broadcasting.php) | PHP | 36 | 23 | 13 | 72 |
| [config/cache.php](/config/cache.php) | PHP | 59 | 34 | 19 | 112 |
| [config/cors.php](/config/cors.php) | PHP | 11 | 12 | 12 | 35 |
| [config/database.php](/config/database.php) | PHP | 83 | 47 | 22 | 152 |
| [config/filesystems.php](/config/filesystems.php) | PHP | 32 | 32 | 13 | 77 |
| [config/hashing.php](/config/hashing.php) | PHP | 14 | 32 | 9 | 55 |
| [config/logging.php](/config/logging.php) | PHP | 79 | 34 | 19 | 132 |
| [config/mail.php](/config/mail.php) | PHP | 61 | 54 | 20 | 135 |
| [config/queue.php](/config/queue.php) | PHP | 51 | 42 | 17 | 110 |
| [config/sanctum.php](/config/sanctum.php) | PHP | 15 | 41 | 11 | 67 |
| [config/services.php](/config/services.php) | PHP | 17 | 11 | 7 | 35 |
| [config/session.php](/config/session.php) | PHP | 23 | 157 | 35 | 215 |
| [config/view.php](/config/view.php) | PHP | 10 | 20 | 7 | 37 |
| [database/factories/UserFactory.php](/database/factories/UserFactory.php) | PHP | 25 | 14 | 6 | 45 |
| [database/migrations/2014\_10\_12\_000000\_create\_users\_table.php](/database/migrations/2014_10_12_000000_create_users_table.php) | PHP | 25 | 6 | 4 | 35 |
| [database/migrations/2014\_10\_12\_100000\_create\_password\_reset\_tokens\_table.php](/database/migrations/2014_10_12_100000_create_password_reset_tokens_table.php) | PHP | 19 | 6 | 4 | 29 |
| [database/migrations/2019\_08\_19\_000000\_create\_failed\_jobs\_table.php](/database/migrations/2019_08_19_000000_create_failed_jobs_table.php) | PHP | 23 | 6 | 4 | 33 |
| [database/migrations/2019\_12\_14\_000001\_create\_personal\_access\_tokens\_table.php](/database/migrations/2019_12_14_000001_create_personal_access_tokens_table.php) | PHP | 24 | 6 | 4 | 34 |
| [database/migrations/2025\_05\_15\_141416\_create\_compras\_table.php](/database/migrations/2025_05_15_141416_create_compras_table.php) | PHP | 22 | 6 | 4 | 32 |
| [database/migrations/2025\_05\_21\_015024\_create\_productos\_table.php](/database/migrations/2025_05_21_015024_create_productos_table.php) | PHP | 24 | 7 | 4 | 35 |
| [database/migrations/2025\_05\_23\_012938\_create\_distribuidors\_table.php](/database/migrations/2025_05_23_012938_create_distribuidors_table.php) | PHP | 20 | 6 | 4 | 30 |
| [database/migrations/2025\_05\_23\_033558\_create\_vehiculos\_table.php](/database/migrations/2025_05_23_033558_create_vehiculos_table.php) | PHP | 24 | 7 | 4 | 35 |
| [database/migrations/2025\_05\_23\_034333\_create\_asignacions\_table.php](/database/migrations/2025_05_23_034333_create_asignacions_table.php) | PHP | 20 | 6 | 4 | 30 |
| [database/migrations/2025\_06\_28\_140923\_create\_tipo\_productos\_table.php](/database/migrations/2025_06_28_140923_create_tipo_productos_table.php) | PHP | 19 | 6 | 4 | 29 |
| [database/migrations/2025\_06\_28\_145609\_create\_metodo\_pagos\_table.php](/database/migrations/2025_06_28_145609_create_metodo_pagos_table.php) | PHP | 19 | 6 | 4 | 29 |
| [database/migrations/2025\_06\_29\_003436\_create\_detalle\_compras\_table.php](/database/migrations/2025_06_29_003436_create_detalle_compras_table.php) | PHP | 22 | 6 | 5 | 33 |
| [database/migrations/2025\_06\_29\_171836\_create\_ubicacions\_table.php](/database/migrations/2025_06_29_171836_create_ubicacions_table.php) | PHP | 21 | 6 | 4 | 31 |
| [database/migrations/2025\_06\_29\_200028\_create\_asignacion\_distribuidors\_table.php](/database/migrations/2025_06_29_200028_create_asignacion_distribuidors_table.php) | PHP | 20 | 6 | 4 | 30 |
| [database/seeders/DatabaseSeeder.php](/database/seeders/DatabaseSeeder.php) | PHP | 23 | 6 | 8 | 37 |
| [database/seeders/MetodoPagoSeeder.php](/database/seeders/MetodoPagoSeeder.php) | PHP | 20 | 3 | 4 | 27 |
| [database/seeders/ProductoSeeder.php](/database/seeders/ProductoSeeder.php) | PHP | 23 | 3 | 5 | 31 |
| [database/seeders/TipoProductoSeeder.php](/database/seeders/TipoProductoSeeder.php) | PHP | 26 | 3 | 5 | 34 |
| [database/seeders/UserSeeder.php](/database/seeders/UserSeeder.php) | PHP | 122 | 3 | 10 | 135 |
| [phpunit.xml](/phpunit.xml) | XML | 30 | 2 | 1 | 33 |
| [public/index.php](/public/index.php) | PHP | 14 | 30 | 12 | 56 |
| [routes/api.php](/routes/api.php) | PHP | 40 | 45 | 16 | 101 |
| [routes/auth.php](/routes/auth.php) | PHP | 29 | 0 | 9 | 38 |
| [routes/channels.php](/routes/channels.php) | PHP | 5 | 10 | 4 | 19 |
| [routes/console.php](/routes/console.php) | PHP | 6 | 10 | 4 | 20 |
| [routes/web.php](/routes/web.php) | PHP | 6 | 10 | 5 | 21 |
| [tests/CreatesApplication.php](/tests/CreatesApplication.php) | PHP | 13 | 3 | 6 | 22 |
| [tests/Feature/Auth/AuthenticationTest.php](/tests/Feature/Auth/AuthenticationTest.php) | PHP | 35 | 0 | 13 | 48 |
| [tests/Feature/Auth/EmailVerificationTest.php](/tests/Feature/Auth/EmailVerificationTest.php) | PHP | 42 | 0 | 13 | 55 |
| [tests/Feature/Auth/PasswordResetTest.php](/tests/Feature/Auth/PasswordResetTest.php) | PHP | 36 | 0 | 14 | 50 |
| [tests/Feature/Auth/RegistrationTest.php](/tests/Feature/Auth/RegistrationTest.php) | PHP | 19 | 0 | 6 | 25 |
| [tests/Feature/ExampleTest.php](/tests/Feature/ExampleTest.php) | PHP | 11 | 4 | 5 | 20 |
| [tests/TestCase.php](/tests/TestCase.php) | PHP | 7 | 0 | 4 | 11 |
| [tests/Unit/ExampleTest.php](/tests/Unit/ExampleTest.php) | PHP | 10 | 3 | 4 | 17 |
| [vendor/spatie/ignition/resources/compiled/ignition.css](/vendor/spatie/ignition/resources/compiled/ignition.css) | PostCSS | 1 | 2 | 0 | 3 |
| [vendor/spatie/ignition/resources/compiled/ignition.js](/vendor/spatie/ignition/resources/compiled/ignition.js) | JavaScript JSX | 6 | 0 | 1 | 7 |

[Summary](results.md) / Details / [Diff Summary](diff.md) / [Diff Details](diff-details.md)