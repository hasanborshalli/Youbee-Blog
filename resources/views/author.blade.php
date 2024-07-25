<x-layout>
  
  <div id="followers-block">
    <h3>Followers</h3>
    <ul id="followers-list">
      @foreach($followers as $follower)
      <li><a href="/user/{{$follower->user->id}}">{{$follower->user->username}}</a></li>
      @endforeach
    </ul>
  </div>
  <div id="followings-block">
    <h3>Following</h3>
    <ul id="followings-list">
      @foreach($followings as $following)
      <li><a href="/user/{{$following->usersFollowing->id}}">{{$following->usersFollowing->username}}</a></li>
      @endforeach
    </ul>
  </div>
  <div class="follow-info">
    
    <div class="avatar" style="width:70px;">
      <img src="/storage/avatars/{{$user->avatar}}" width="64px" height="64px">
      @can('update',$user)
      <form action="/change-avatar/{{$user->id}}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="input-group">
        <input type="file"  style="width:100%;" class="form-control" name="avatar" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
        @error('avatar')
        <x-toast
        content="{{$message}}"
        />
        @enderror
        <input type="submit" style="width:100%;" class="btn btn-outline-secondary" id="inputGroupFileAddon04" value="Change Avatar">
      </div>
      </form>
      @else
      <br><br><br>
      @endcan
    </div>
    
      <div class="author">
        <h3>{{$user->username}}</h3>
      </div>
      <div onclick="showFollowers()" class="followers">
        <p  align="center" >{{$nbFollowers}}</p>
        <small>Followers</small>
      </div>

      <div class="followings" onclick="showFollowings()">
        <p align="center">{{$nbFollowings}}</p>
        <small>Followings</small>
      </div>

      <div class="posts">
          <p align="center">{{$nbPosts}}</p>
          <small>Posts</small>
      </div>

  </div>
    <!-- Page Content -->
    <div class="container">
        <div class="row">
           <!-- Page Title -->
          
          <!-- Blog Entries Column -->
          <div class="col-md-12">

              @if($user->id!=auth()->id())
                <a class="btn btn-{{$user->is_followed_by_user() ? 'success' : 'default'}} user{{$user->id}}"
                    onclick="follow({{$user->id}})" >
                    {{$user->is_followed_by_user() ? '✔️Unfollow' : '➕Follow'}}
                </a>
              @endif

              @foreach($posts as $post)
                <x-post
                    title="{{$post->title}}"
                    content="{{$post->content}}"
                    id="{{$post->id}}"
                    datePosted="{{$post->created_at->format('F d, Y \a\t g:i A')}}"
                    username="" 
                    userid="{{$user->id}}"
                    liked="{{$post->is_liked_by_user() ? 'Unlike' : 'Like'}}"
                    class="{{$post->is_liked_by_user() ? 'primary' : 'default'}}"
                    nbLikes="{{count($post->likes)}}"
                    sharable="{{ auth()->user()->can('share', $post) ? 'true' : 'false' }}"
                    followable="false"
                    followed=""
                    followedClass=""
                />
            @endforeach
             <!-- Pager -->
             {!! $posts->links() !!}
        </div>
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container -->
<script>
const followerBlock=document.getElementById('followers-block');
const followingBlock=document.getElementById('followings-block');

  function showFollowers(){
       if(followerBlock.style.display == "block"){
        followerBlock.style.display = "none"

       }else{
        followerBlock.style.display = "block"
        followingBlock.style.display = "none"

       }
    
    }
    function showFollowings(){
       if(followingBlock.style.display == "block"){
        followingBlock.style.display = "none"
       }else{
        followingBlock.style.display = "block"
        followerBlock.style.display = "none"

       }
    
    }

</script>
</x-layout>