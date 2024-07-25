<x-layout>
  @php
  $errorMessages = [];

  if($errors->has('password')) {
      $errorMessages[] = $errors->first('password');
  }

  if($errors->has('username')) {
      $errorMessages[] = $errors->first('username');
  }
@endphp

@if(!empty($errorMessages))
  <x-toast :content="implode($errorMessages)" />
@endif
   <!-- Page Content -->
   <div class="container">

    <div class="row">

      <div class="col-lg-2"></div>

      <!-- Login content  -->
      <div class="col-lg-8 login">

        <!-- Title -->
        <h1>Login</h1>

        <!-- Login form -->
        <form action="/login" method="post" class="login-form">
          @csrf
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" class="form-control">
            {{-- @error('username')
            <x-toast
            content="{{$message}}"
            />
            @enderror --}}
          </div>

          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control">
            {{-- @error('password')
            <x-toast
            content="{{$message}}"
            />
            @enderror --}}
          </div>

          <button id="submit-button" type="submit" class="btn btn-primary">Log in</button>
          <p>Don't have an account? <a href="/signup">Sign Up Now</a></p>
        </form>
        <!-- /form -->
      </div>

      <div class="col-lg-2"></div>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->
  
</x-layout>