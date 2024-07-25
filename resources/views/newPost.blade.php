<x-layout>
 <!-- Page Content -->
 <div class="container">

    <div class="row">

      <!-- Newpost content  -->
      <div class="col-lg-12 newpost">

        <!-- Title -->
        <h1>New post</h1>

        <!-- Newpost form -->
        <form action="/newpost" method="post" class="newpost-form">
          @csrf
          <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" class="form-control">
          </div>

          <div class="form-group">
            <label for="content">Content</label>
            <textarea rows="5" id="content" name="content" class="form-control"></textarea>
          </div>

          <button type="submit" class="btn btn-primary">Post</button>
        </form>
        <!-- /form -->
      </div>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->
</x-layout>