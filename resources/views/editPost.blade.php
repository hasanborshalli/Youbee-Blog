<x-layout>
    <!-- Page Content -->
    <div class="container">
   
       <div class="row">
   
         <!-- Newpost content  -->
         <div class="col-lg-12 newpost">
   
           <!-- Title -->
           <h1>Edit post</h1>
   
           <!-- Newpost form -->
           <form action="/post/edit/{{$post->id}}" method="post" class="newpost-form">
             @csrf
             <div class="form-group">
               <label for="title">Title</label>
               <input type="text" id="title" name="title" class="form-control" value="{{old('title',$post->title)}}">
               @error('title')
               <p style="color:red">{{$message}}</p>
               @enderror
             </div>
   
             <div class="form-group">
               <label for="content">Content</label>
               <textarea rows="5" id="content" name="content" class="form-control">{{old('content',$post->content)}}</textarea>
               @error('content')
               <p style="color:red">{{$message}}</p>
               @enderror
             </div>
   
             <button type="submit" class="btn btn-primary">Edit</button>
           </form>
           <!-- /form -->
         </div>
   
       </div>
       <!-- /.row -->
   
     </div>
     <!-- /.container -->
   </x-layout>