   <!-- Bootstrap Core CSS -->
   <link href="/css/bootstrap.min.css" rel="stylesheet">

   <!-- Custom CSS -->
   <link href="/css/simple-blog-template.css" rel="stylesheet">
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/home">YouBee Blog</a>
      </div>
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
          <li>
            <a href="/about">About</a>
          </li>
          @guest
          <li>
            <a href="/login">Login</a>
          </li>
          
          <li>
            <a href="/signup">Sign up</a>
          </li>
          @endguest
          @auth
          <li>
            <a href="/newpost">Create Post</a>
          </li>
          <li>
            <a href="/home/savedPosts">Saved Posts</a>
          </li>
          <li>
            <a href="/user/{{auth()->id()}}">Profile</a>
          </li>
          <li>
            <a href="/logout">Logout</a>
          </li>
          @endauth
        </ul>
      </div>
      <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
  </nav>