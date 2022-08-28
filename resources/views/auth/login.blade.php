@extends('layouts.master')

@section('styles')
    <style>

    </style>
@endsection


@section('content')
    <div class="container mt-5">
        <div class="row mt-5 ">
            <div class="col-md-3"></div>
            <div class="col-md-6 mb-4 ">
                <div class="d-flex justify-content-center annimateLogo">
                    <img class=" rounded rounded-circle" src="{{ asset('user/img/linklogo.jpg') }}" height="100"
                        alt="">
                </div>
                <form class="mt-3 card p-5 shadow bg-dark" method="POST" action="{{ route('login') }}">
                    <h5 class="text-center">Login Form</h5>
                    <div class="line-mf"></div>
                    @if ($errors->any())
                        <div class="my-2">
                            @foreach ($errors->all() as $error)
                            <span class=" text-danger">-{{ $error }}</span>
                        @endforeach
                        </div>
                    @endif
                    @csrf
                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <input value="{{ old('email') }}" type="email" name="email" id="form2Example1"
                            class="form-control " required autocomplete="off">
                        <label class="form-label" for="form2Example1" style="margin-left: 0px">
                            <span language='eng'>Email</span><span language='mm'>အီးမေးလ်လိပ်စာ</span>
                        </label>
                    </div>
                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        <input type="password" name="password" id="form2Example2" class="form-control" required
                            autocomplete="off">
                        <label class="form-label" for="form2Example2" style="margin-left: 0px">
                            <span language='eng'>Password</span><span language='mm'>စကား၀ှက်</span>
                        </label>
                        <div class="valid-feedback">Looks good!</div>
                    </div>

                    <!-- 2 column grid layout for inline styling -->
                    <div class="row mb-4">
                        <div class="col d-flex justify-content-center">
                            <!-- Checkbox -->
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remimbercheck">
                                <label class="form-check-label" for="remimbercheck">
                                    Remember me
                                </label>
                            </div>
                        </div>

                        <div class="col">
                            <!-- Simple link -->
                            <a href="{{ route('password.request') }}">Forgot password?</a>
                        </div>
                    </div>

                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-block mb-4">
                        Sign in
                    </button>

                    <!-- Register buttons -->
                    <div class="text-center">
                        <p>Not a member? <a href="{{route('register')}}">Register</a></p>
                        <p>or sign up with:</p>
                        <button type="button" class="btn btn-primary btn-floating mx-1">
                            <i class="fab fa-facebook-f"></i>
                        </button>

                        <button type="button" class="btn btn-primary btn-floating mx-1">
                            <i class="fab fa-google"></i>
                        </button>

                        <button type="button" class="btn btn-primary btn-floating mx-1">
                            <i class="fab fa-twitter"></i>
                        </button>

                        <button type="button" class="btn btn-primary btn-floating mx-1">
                            <i class="fab fa-github"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    $(document).ready(function () {
        // $('nav,footer').hide()
        $('input').focus();
    });
</script>
@endpush
