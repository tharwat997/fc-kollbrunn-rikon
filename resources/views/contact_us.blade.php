@extends('layouts.app')
@section('css')
    <script src="https://www.google.com/recaptcha/api.js?onload=vueRecaptchaApiLoaded&render=explicit" async defer></script>
@endsection
@section('content')
    <section id="contactUs">
        <contact></contact>
    </section>
@endsection