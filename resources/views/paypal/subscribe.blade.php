<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suscripción PayPal</title>
</head>
<body>

    <h1>Suscríbete al plan premium</h1>
    
    <div id="paypal-button-container-P-77C972192U696212FM4DXGNA"></div>
    <script src="https://www.paypal.com/sdk/js?client-id=Ab2GdNz6ABzc3H6S95-UpP6mwERCHvTGZJg1-XEdk9qAuAHos5kaf3Sl4KcVx-lx17HknE6Z-mFhHUsW&vault=true&intent=subscription" data-sdk-integration-source="button-factory"></script>
    <script>
        paypal.Buttons({
            style: {
                shape: 'rect',
                color: 'gold',
                layout: 'vertical',
                label: 'subscribe'
            },
            createSubscription: function(data, actions) {
                return actions.subscription.create({
                    plan_id: 'P-77C972192U696212FM4DXGNA'
                });
            },
            onApprove: function(data, actions) {
                alert("Suscripción exitosa! ID de la suscripción: " + data.subscriptionID);
            }
        }).render('#paypal-button-container-P-77C972192U696212FM4DXGNA');
    </script>

</body>
</html>
