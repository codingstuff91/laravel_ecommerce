@extends('layouts.master')

@section('extra_head_scripts')
    <script src="https://js.stripe.com/v3/"></script> 
@endsection

@section('meta_csrf')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <div class="col-md-12">
        <h1 class="text-center">Paiment de votre commande</h1>
    </div>
    <div class="row mt-4">
        <div class="col-md-6">
            <form id="payment-form" action="{{ route('checkout.store') }}" method="POST">
                @csrf
                
                <!-- Elements will create input elements here -->
                <div id="card-element">
                </div>
                
                <!-- We'll put the error messages in this element -->
                <div id="card-errors" role="alert"></div>
                
                <button id="submit" class="btn btn-success btn-block mt-4">Valider le paiement de {{ getPrice(Cart::total()) }}</button>
            </form>
        </div>
    </div>
@endsection

@section('extra_body_scripts')
    <script>
        var stripe = Stripe('pk_test_51GqI2FFgsOsmNHZpsdMTvda0carQN3md468tutSifZBqWjyYPCYdgabbR0Rsaim71UAmHhTY7RMUrhuAYDuEjpLg005CPTC5dO');
        var elements = stripe.elements();

        var style = {
            base: {
            color: "#32325d",
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
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

        var card = elements.create("card", { style: style });
        card.mount("#card-element");

        card.on('change', ({error}) => {
            const displayError = document.getElementById('card-errors');
            if (error) {
                displayError.classList.add('mt-4','alert','alert-warning')
                displayError.textContent = error.message;
            } else {
                displayError.classList.remove('mt-4','alert','alert-warning')
                displayError.textContent = '';
            }
        });

        // Submission of the payment to stripe
        var form = document.getElementById('payment-form');
        const submitButton = document.querySelector("#submit");

        form.addEventListener('submit', function(ev) {
            ev.preventDefault();
            submitButton.disabled = true;
            stripe.confirmCardPayment("{{ $client_secret }}", {
                    payment_method: {
                    card: card
                }
            }).then(function(result) {
                if (result.error) {
                    // Show error to your customer (e.g., insufficient funds)
                    submitButton.disabled = false;
                    console.log(result.error.message);
                } else {
                    // The payment has been processed!
                    if (result.paymentIntent.status === 'succeeded') {
                        console.log(result.paymentIntent);                    
                        
                        var paymentIntent = result.paymentIntent;
                        var form = document.getElementById("payment-form");
                        var token = document.querySelector("meta[name='csrf-token']").getAttribute('content');
                        var url = form.action;
                        var redirect = "/thanks";
                        
                        // Request to store generic informations in DB
                        fetch(
                            url,
                            {
                                headers : {
                                    "Content-Type": "application/json",
                                    "Accept" : "application/json, text-plain, */*",
                                    "X-Request-With" : "SMLHttpRequest",
                                    "X-CSRF-TOKEN" : token
                                },
                                method : "post",
                                body : JSON.stringify({
                                    paymentIntent : paymentIntent
                                })
                            
                            }).then((response)=>{
                                window.location.href = redirect;
                        }).catch((error)=>{
                            console.log(error);                            
                        });

                    }
                }
            });
        });
    </script>
@endsection