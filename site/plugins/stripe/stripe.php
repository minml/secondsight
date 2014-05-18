<?php

	function stripe($key, $price, $desc){
		include("site/plugins/stripe/stripe-php-1.13.0/lib/Stripe.php");
	
		$token = $key;
		
		// Set your secret key: remember to change this to your live secret key in production
		// See your keys here https://manage.stripe.com/account
		Stripe::setApiKey("sk_test_a2Y5HE0f5atOfEP55IyOlf0o");
		
		// Create the charge on Stripe's servers - this will charge the user's card
		try {
		$charge = Stripe_Charge::create(array(
		  "amount" => $price, // amount in cents, again
		  "currency" => "GBP",
		  "card" => $token,
		  "description" => "$desc"
		));
		} catch(Stripe_CardError $e) {
		 	return false;
		}
	}
?>