<x-layout>
 
    <!-- Page Content -->
    <div class="container">

        <div class="row">
  
          <div class="col-lg-2"></div>
  
          <!-- Signup content  -->
          <div class="col-lg-8 signup">
  
            <!-- Title -->
            <h1>Sign up</h1>
  
            <!-- Login form -->
            <form action="/blog/signup" method="post" class="signup-form">
              @csrf
              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="form-control" required>
                @error('username')
                <p style="color:red">{{$message}}</p>
                @enderror
              </div>
  
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
                @error('password')
                <p style="color:red">{{$message}}</p>
                @enderror
              </div>
  
              <div class="form-group">
                <label for="password">Password Confirmation</label>
                <input type="password" id="confirmation" name="password_confirmation" class="form-control" required>
                @error('password_confirmation')
                <p style="color:red">{{$message}}</p>
                @enderror
              </div>
  
              <div class="form-group">
                <label for="username">Email</label>
                <input type="email" id="email" name="email" class="form-control" required>
                @error('email')
                <p style="color:red">{{$message}}</p>
                @enderror
              </div>
              <button id="submit-button" type="submit" class="btn btn-primary">Sign up</button>
              <p>Already have an account? <a href="/login">Login now</a></p>

            </form>
            <!-- /form -->
          </div>
  
          <div class="col-lg-2"></div>
  
        </div>
        <!-- /.row -->
  
      </div>
      <!-- /.container -->
</x-layout>