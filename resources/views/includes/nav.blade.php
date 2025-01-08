<nav class="navbar navbar-expand-lg navbar-dark navbar-sticky-top" style = "background-color: #000">
    <div class="container" style="font-size:0.8rem">
        <a class="navbar-brand" href="{{ route('homepage') }}">
          <img src="{{ logo() }}" width="auto" height="30px" alt="">
        </a>
  
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
  
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('homepage') }}"> FREE TIPS</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{ route('homepage') }}/blog">BLOG</a>
            </li>

          </ul>

          @if(auth()->check() && auth()->user()->is_standard_user())
            <span class="navbar-text">
              @if(auth()->user()->subscription_active())
                <span class="text-warning"><i class="fas fa-star"></i> PREMIUM MEMBERSHIP | EXPIRES {{ strtoupper(auth()->user()->subscription_expires_at->toDayDateTimeString()) }} <i class="fas fa-star"></i></span>
              @else
                <span class="text-muted">FREE MEMBERSHIP</span>
              @endif
            </span>
          @endif
  
          <ul class="navbar-nav ml-auto">
           
            @if(auth()->check())  
                  @if(auth()->user()->is_standard_user())
                  
                    @if(auth()->user()->subscription_active())
                      @if(!auth()->user()->sms_subscription_active())
                        <li class="nav-item">
                          <a class="nav-link btn btn-sm btn-outline-warning" href="" data-toggle="modal" data-target="#make-sms-subscription-modal">SUBSCRIBE TO SMS</a>
                        </li>
                      @endif
                    @else
                      <li class="nav-item">
                        <a class="nav-link btn btn-sm btn-outline-warning" href="" data-toggle="modal" data-target="#make-subscription-modal">SUBSCRIBE NOW</a>
                      </li>
                    @endif

                    <li class="nav-item">
                      <a class="nav-link btn btn-sm btn-outline-info" href="{{ route('standard-user.history') }}">HISTORY</a>
                    </li>
                  
                @endif
            
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ auth()->user()->name }}
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a>
                    @if(auth()->user()->is_standard_user())
                      <a class="dropdown-item" href="{{ route('standard-user.subscriptions') }}">Subscriptions</a>
                    @endif
                    @if(!auth()->user()->is_admin())
                      <a class="dropdown-item" href="{{ auth()->user()->is_standard_user() ? route('standard-user.settings') : route('analyst.settings') }}">Settings</a>
                    @else
                    <a class="dropdown-item" href="{{ route('admin.settings') }}">Settings</a>
                    @endif
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                  </div>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}"> LOGIN</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}"> REGISTER</a>
                </li> 
            @endif
          </ul>
          
       </div>
    </div>
  </nav>