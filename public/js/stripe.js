
//Create a Stripe client.
var stripe = Stripe('pk_test_5NttTTdFvFw7lINYyNniaxFb');

var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
  base: {
    color: '#32325d',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
};

// Create an instance of the card Element.
var card = elements.create('card', {hidePostalCode: true, style: style});

// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');

// Handle form submission.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();

  stripe.createToken(card).then(function(result) {
    console.log('result.error', result.error);
    console.log('result', result);
    console.log('result.token', result.token);
    var errorElement = document.getElementById('card-errors');
    if (result.error) {
      if(result.error.code == 'incomplete_number'){
        result.error.message = 'Votre numero de carte est incomplet ou vide';
        errorElement.textContent = result.error.message;
      } else if(result.error.code == 'invalid_number'){
        result.error.message = "Veuillez saisir comme numero de carte 4242 4242 4242 4242";
        errorElement.textContent = result.error.message;
      } else if(result.error.code == 'incomplete_expiry'){
        result.error.message = "Votre date d'expiration est incomplète ou vide";
        errorElement.textContent = result.error.message;
      } else if(result.error.code == 'invalid_expiry_year_past'){
        result.error.message = "Votre date d'expiration n'est pas bonne, l'année est antérieure ou n'existe pas";
        errorElement.textContent = result.error.message;
      } else if(result.error.code == 'incomplete_cvc'){
        result.error.message = "Votre CVC est incomplet ou vide";
        errorElement.textContent = result.error.message;
      } else if(result.error){
        // Inform the user if there was an error.
        result.error.message = "Une erreur est survenue";
        errorElement.textContent = result.error.message;
      }
    } else {
      // Send the token to your server.
      stripeTokenHandler(result.token);
    }

    if(result.error = undefined){
      console.log('result.token2', result.token);
      // Send the token to your server.
      stripeTokenHandler(result.token);
    }
  });
});

// Submit the form with the token ID.
function stripeTokenHandler(token) {
  console.log('goku');
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  // Submit the form
  form.submit();
};







// Create a Stripe client.
// var stripe = Stripe('pk_test_5NttTTdFvFw7lINYyNniaxFb');

// // Create an instance of Elements.
// var elements = stripe.elements();

// // Custom styling can be passed to options when creating an Element.
// // (Note that this demo uses a wider set of styles than the guide below.)
// var style = {
//   base: {
//     color: '#32325d',
//     lineHeight: '18px',
//     fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
//     fontSmoothing: 'antialiased',
//     fontSize: '16px',
//     '::placeholder': {
//       color: '#aab7c4'
//     }
//   },
//   invalid: {
//     color: '#fa755a',
//     iconColor: '#fa755a'
//   }
// };

// // Create an instance of the card Element.
// var card = elements.create('card', {style: style});

// // Add an instance of the card Element into the `card-element` <div>.
// card.mount('#card-element');

// // Handle real-time validation errors from the card Element.
// card.addEventListener('change', function(event) {
//   var displayError = document.getElementById('card-errors');
//   if (event.error) {
//     displayError.textContent = event.error.message;
//   } else {
//     displayError.textContent = '';
//   }
// });

// // Handle form submission.
// var form = document.getElementById('payment-form');
// form.addEventListener('submit', function(event) {
//   event.preventDefault();

//   stripe.createToken(card).then(function(result) {
//     if (result.error) {
//       // Inform the user if there was an error.
//       var errorElement = document.getElementById('card-errors');
//       errorElement.textContent = result.error.message;
//     } else {
//       // Send the token to your server.
//       stripeTokenHandler(result.token);
//     }
//   });
// });

// // Submit the form with the token ID.
// function stripeTokenHandler(token) {
//   // Insert the token ID into the form so it gets submitted to the server
//   var form = document.getElementById('payment-form');
//   var hiddenInput = document.createElement('input');
//   hiddenInput.setAttribute('type', 'hidden');
//   hiddenInput.setAttribute('name', 'stripeToken');
//   hiddenInput.setAttribute('value', token.id);
//   form.appendChild(hiddenInput);

//   // Submit the form
//   form.submit();
// }