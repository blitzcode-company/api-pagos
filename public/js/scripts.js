
var stripe = Stripe("pk_test_51Q7PphGPwkmlbJzo1CHwmGLAomHbpPzjotthLhHjFv2F0HBUeME9ahkbBzPMY6JC9ZpgHH71bidQNg1ReTpoKCuK00ak6M8ArZ");
var elements = stripe.elements();
var style = {
    base: {
        color: "#32325d",   
        fontFamily: 'Roboto, sans-serif',
        fontSmoothing: "antialiased",
        fontSize: "16px",
        "::placeholder": {
            color: "#aab7c4"
        }
    },
    invalid: {
        color: "#fa755a",
        iconColor: "#fa755a"
    }
};

var cardNumber = elements.create('cardNumber', { style: style });
var cardExpiry = elements.create('cardExpiry', { style: style });
var cardCvc = elements.create('cardCvc', { style: style });

cardNumber.mount('#card-number-element');
cardExpiry.mount('#card-expiry-element');
cardCvc.mount('#card-cvc-element');

[cardNumber, cardExpiry, cardCvc].forEach(function(element) {
    element.on('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }

        if (element === cardNumber) {
            var cardBrandIcon = document.getElementById('card-brand-icon');
            if (event.brand) {
                switch(event.brand) {
                    case 'visa':
                        cardBrandIcon.src = 'https://img.icons8.com/color/48/000000/visa.png';
                        break;
                    case 'mastercard':
                        cardBrandIcon.src = 'https://img.icons8.com/color/48/000000/mastercard.png';
                        break;
                    case 'amex':
                        cardBrandIcon.src = 'https://img.icons8.com/color/48/000000/amex.png';
                        break;
                    case 'discover':
                        cardBrandIcon.src = 'https://img.icons8.com/color/48/000000/discover.png';
                        break;
                    default:
                        cardBrandIcon.src = 'https://img.icons8.com/ios-filled/50/000000/bank-card-back-side.png';
                }
            } else {
                cardBrandIcon.src = 'https://img.icons8.com/ios-filled/50/000000/bank-card-back-side.png';
            }
        }
    });
});

var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
    event.preventDefault();
    stripe.createToken(cardNumber).then(function(result) {
        if (result.error) {
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = result.error.message;
        } else {
            stripeTokenHandler(result.token);
        }
    });
});

function stripeTokenHandler(token) {
    var form = document.getElementById('payment-form');
    var hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'stripeToken');
    hiddenInput.setAttribute('value', token.id);
    form.appendChild(hiddenInput);
    form.submit();
}
