
    <div class="blog-masthead">
        <div class="container">
          <nav class="nav blog-nav">
            <a class="nav-link active" href="/">Home</a>

              @if( auth()->check() )
              <a class="nav-link" href="/myposts">My Posts</a>
              <a class="nav-link" href="/posts/create">Create Post</a>

                <ul class = "navbar-nav ml-auto">
                  <li class="nav-item dropdown">
                      <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                          {{ auth()->user()->name }} <span class="caret"></span>
                      </a>
                    
                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                          <a class = "dropdown-item" href = "/logout">Logout</a>
                      </div>
                  </li>
                </ul> 
                @else
                <div class = "nav blog-nav ml-auto">
                    <a class="nav-link" href="register">Register</a>
                    <a class="nav-link" href="/login">Login</a>
                </div>
              @endif
      
            {{-- <a class="nav-link ml-auto" href="#">{{ auth()->user()->name }}</a> <!-- used ml-auto meaning margin-left auto -->
          --}}

          </nav>
        </div>
      </div>
  