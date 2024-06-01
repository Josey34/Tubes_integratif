@extends('layouts.main');

@section('container')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <h1 class="h3 mb-3 fw-normal text-center">Register</h1>

                <form action="/register" method="post">
                    @csrf
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" placeholder="name" required>
                    <br>
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" placeholder="email" required>
                    <br>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="password" required>
                    <br>
                    <button class="btn btn-primary w-100 py-2 mt-3" type="submit">Register</button>
                </form>
                <small class="d-block text-center mt-3">Already registered? <a href="/login">Login</a></small>
            </div>
        </div>
    </div>
@endsection
