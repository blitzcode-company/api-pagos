# API-Pagos

<p align="center">
    <img src="https://drive.google.com/uc?export=download&id=1yyVoEHmLQgzYpDJJJvjtpo1MHdZNP84k" width="200">
</p>

### Configuración del proyecto

-   Para comenzar, clona el repositorio de GitHub a tu máquina local. Abre una terminal y ejecuta el siguiente comando:

`Vía SSH:`

```
git clone git@github.com:blitzcode-company/api-pagos.git
```

`Vía HTTPS:`

```
git clone https://github.com/blitzcode-company/api-pagos.git
```

-   Ingresamos al proyecto `cd api-pagos` y ejecutamos:

```
composer install
```

-   Dentro del directorio del proyecto de Laravel, generamos el archivo .env con el siguiente comando:

```
cp .env.example .env
```

-   Configuramos la base de datos dentro del archivo .env:

```
DB_HOST=mysql
DB_PORT=3306
```

- Generar la clave de la aplicación

```
php artisan key:generate
```

## Dependencia en Oauth-api

Este proyecto depende del servicio de autenticación OAuth proporcionado por el repositorio [Oauth-api](https://github.com/blitzcode-company/Oauth-api).

## Docker Compose

Inicia el proyecto con el siguiente comando:

```
sudo docker-compose up -d
```
El proyecto estará corriendo en el puerto **8003**. Puede corroborarlo ingresando a `http://localhost:8003/`. 

**Nota:** Luego debes iniciar el proyecto de Oauth-api.


## Realizar Pagos con Paypal

<p align="center">
    <img src="https://drive.google.com/uc?export=download&id=1AAH0JU3V_nt6OfIrvt3-wa2QXgW458EP" width="400">
</p>

### Cuenta de PayPal

Para crear cuentas sandbox, visita: [Cuentas Sandbox de PayPal](https://developer.paypal.com/dashboard/accounts).

Para ingresar a las cuentas, utiliza: [PayPal Sandbox](https://www.sandbox.paypal.com).

#### Cuentas de prueba creadas previamente:

- **Cuenta de Negocio:**
  - Correo: `Blitzvideo@business.com`
  - Contraseña: `Codeloco123`

- **Cuenta Personal:**
  - Correo: `diego.blitzvideo@personal.com`
  - Contraseña: `User123.`

#### Tarjetas de Crédito:

- **VISA**
  - Número de tarjeta: `4359357022550530`
  - Fecha de caducidad: `10/2029`
  - CVC: Cualquier 3 dígitos.

- **MASTERCARD**
  - Número de tarjeta: `5235908196330203`
  - Fecha de caducidad: `10/2029`
  - CVC: Cualquier 3 dígitos.

#### Generador de tarjetas:
Puedes generar tarjetas para pruebas usando el siguiente enlace: [Generador de tarjetas de PayPal](https://developer.paypal.com/api/rest/sandbox/card-testing/#link-creditcardgeneratorfortesting).

### Agrega tus credenciales de PayPal al archivo `.env`:
- `PAYPAL_CLIENT_ID=XXXX`
- `PAYPAL_SECRET=XXXX`


## Realizar Pagos Stripe

<p align="center">
    <img src="https://drive.google.com/uc?export=download&id=1exzUrvse4DXDmDfqEIFiJqbRSxeFFHv1" width="400">
</p>

- Tarjetas de pruebas: [Tarjetas de Prueba de Stripe](https://docs.stripe.com/testing#international-cards)
- Ver todas las transacciones de Stripe aquí: [Dashboard de Stripe](https://dashboard.stripe.com/test/dashboard)

### Agrega tus credenciales de Stripe al archivo `.env`:

- `STRIPE_KEY=XXXX`
- `STRIPE_SECRET=XXXX`
- `STRIPE_PRICE_ID=XXXX`




