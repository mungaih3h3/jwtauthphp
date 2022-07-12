<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Firebase\JWT\JWT;

Route::get("protected", function(Request $request) {
	return response()->json($request->decoded);
})->middleware("jwt-auth");

Route::get("unprotected", function(Request $request) {
	return response("Success", 200);
});

Route::get("token", function() {
	$payload = [
		"email" => "mungccccaihaha@gmail.com"
	];
	$jwt = JWT::encode($payload, env("JWT_KEY"), 'HS256');
	return response()->json([
		"token" => $jwt
	]);
});