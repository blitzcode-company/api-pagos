<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Pago con Stripe</title>
    <script src="https://js.stripe.com/v3/"></script>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <div class="container">
        <h2>Formulario de Pago con Stripe</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('stripe.process') }}" method="POST" id="payment-form">
            @csrf
            <div class="form-group">
                <label for="card-number-element">Número de Tarjeta</label>
                <div id="card-number-element" class="StripeElement"></div>
                <img src="https://img.icons8.com/ios-filled/50/000000/bank-card-back-side.png" id="card-brand-icon"
                    class="card-icon" alt="Card Brand">
            </div>

            <div class="form-group">
                <label for="card-expiry-element">Fecha de Caducidad</label>
                <div id="card-expiry-element" class="StripeElement"></div>
            </div>

            <div class="form-group">
                <label for="card-cvc-element">CVC</label>
                <div id="card-cvc-element" class="StripeElement"></div>
            </div>

            <div id="card-errors" role="alert"></div>

            <button type="submit">Pagar $10</button>
        </form>
    </div>
    <script src="js/scripts.js"></script>
</body>

</html>
