@extends('layouts.auth')

@section('content')
    <div style="height: 1cm">

    </div>
    <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
        <div class="card card-bordered">
            <div class="brand-logo p-3 text-center">
                <a href="{{ url('/') }}" class="logo-link">
                    <img class="logo-light logo-img logo-img-lg" src="{{ asset('icon.png') }}" srcset="./icon.png 2x"
                        alt="logo">
                    <img class="logo-dark logo-img logo-img-lg" src="{{ asset('icon.png') }}" srcset="./icon.png 2x"
                        alt="logo-darkz">
                </a>
            </div>
            <div class="card-inner card-inner-lg">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h4 class="nk-block-title">Sign-In</h4>
                        <div class="nk-block-des">
                            <p>Access the Boosterrig panel using your username and passcode.</p>
                        </div>
                    </div>
                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <div class="form-label-group">
                            <label class="form-label" for="default-01">Email</label>
                        </div>
                        <div class="form-control-wrap">
                            <input type="email" name="email" value="{{ old('email') }}"
                                class="form-control form-control-lg" id="default-01" placeholder="Enter your or Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <label class="form-label" for="password">Password</label>
                            <a class="link link-primary link-sm" href="{{ route('password.request') }}">Forgot Code?</a>
                        </div>
                        <div class="form-control-wrap">
                            <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                            </a>
                            <input type="password" name="password" class="form-control form-control-lg" id="password"
                                placeholder="Enter your passcode">
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                    </div>
                </form>
                <div class="form-note-s2 text-center pt-4"> New on our platform? <a href="{{ route('register') }}">Create
                        an account</a>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
