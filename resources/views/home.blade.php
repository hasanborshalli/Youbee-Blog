<x-layout>
 <!-- Page Content -->
 <form action="/home/search" method="Get" style="margin-left:20px;">
  @csrf
 <input type="search" name="search" placeholder="Enter to search..." >
  <br><br><input type="submit" value="Search">
</form>
 <div class="container">

    <div class="row">
      
      <!-- Blog Entries Column -->
      <div class="col-md-12">
        @if($posts=="")
        <x-toast
        content="We couldn't find any matches for your search."
        />
      @else
        @foreach($posts as $post)
        <x-post
            title="{{$post->title}}"
            content="{{$post->content}}"
            id="{{$post->id}}"
            datePosted="{{$post->created_at->format('F d, Y \a\t g:i A')}}"
            username="{{$post->user->username}}"
            userid="{{$post->user->id}}"
            liked="{{$post->is_liked_by_user() ? 'Unlike' : 'Like'}}"
            class="{{$post->is_liked_by_user() ? 'primary' : 'default'}}"
            nbLikes="{{count($post->likes)}}"
            sharable="{{ auth()->user()->can('share', $post) ? 'true' : 'false' }}"
            followable="{{ auth()->user()->can('follow', $post->user) ? 'true' : 'false' }}"
            followed="{{$post->user->is_followed_by_user() ? '✔️Unfollow' : '➕Follow'}}"
            followedClass="{{$post->user->is_followed_by_user() ? 'success' : 'default'}}"

        />
        @endforeach
       {!! $posts->links() !!}

        
        @endif
      </div>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  
</x-layout>