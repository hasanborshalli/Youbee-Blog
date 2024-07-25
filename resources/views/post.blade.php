<x-layout>
     <!-- Page Content -->
     <div class="container">

        <div class="row">
  
          <!-- Blog Post Content Column -->
          <div class="col-lg-12">
  
            <!-- Blog Post -->
  
            <!-- Title -->
            <h1 class="post-title">{{$post->title}}</h1>
  
            <!-- Author -->
            <a href="/user/{{$user->id}}" class="lead" style="margin-right:10px;">
              {{$user->username}}
            </a>
            @if($post->user->id!=auth()->id())
            <a class="btn btn-{{$user->is_followed_by_user() ? 'success' : 'default'}} user{{$user->id}}"
              onclick="follow({{$user->id}})" >
              {{$user->is_followed_by_user() ? '✔️Unfollow' : '➕Follow'}}
             </a>
            <br>
            @endif
            <br>
            @can('update',$post)
            <a class="btn btn-default" href="/post/edit/{{$post->id}}">Edit</a>
            @endcan
            @can('delete',$post)
            <a class="btn btn-danger" href="/post/delete/{{$post->id}}">Delete</a>
            @endcan
            

            <hr>
  
            <!-- Date/Time -->
            <p><span class="glyphicon glyphicon-time"></span> {{$post->created_at->format('F d, Y \a\t g:i A')}}</p>
  
            <hr>
  
            <!-- Post Content -->
            <p>{{$post->content}}</p>
            <hr>
  
            <!-- Blog Comments -->
  
            <!-- Comments Form -->
            @if($post->is_liked_by_user())
            <a class="btn btn-primary" onclick="like({{$post->id}})" id="post{{$post->id}}" >👍🏻Unlike</a>
            @else
            <a class="btn btn-default" onclick="like({{$post->id}})" id="post{{$post->id}}" >👍🏻Like</a>
            @endif
            
            
            <button class="btn btn-secondary" onclick="comment()">💭Comment</button>
            @can('share',$post)
            <a class="btn btn-default"  href="/post/share/{{$post->id}}">➤Share</a>
            @endcan
            
            <br>
            <small id="nbLikes">{{count($post->likes)}} Likes</small>
            <br>
            <div class="well" id="commentBlock" style="display:none;">
              <h4>Leave a Comment:</h4>
              <form role="form" method="post" action="/comment/{{$post->id}}">
                @csrf
                <div class="form-group">
                  <textarea class="form-control" name="comment" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
  
            <hr>
  
            <!-- Posted Comments -->
  
            @foreach($post->comments as $comment)
            @if($comment->comment_id==null)
            <x-comment
            comment="{{$comment->comment}}"
            name="{{$comment->user->username}}"
            datePosted="{{$comment->created_at->format('F d, Y \a\t g A')}}"
            reply="false"
            commentid="{{$comment->id}}"
            />
            
                @foreach($comment->replies as $reply)
                  <x-comment
                  comment="{{$reply->comment}}"
                  name="{{$reply->user->username}}"
                  datePosted="{{$reply->created_at->format('F d, Y \a\t g A')}}"
                  reply="true"
                  commentid="{{$reply->id}}"

                  />
                      @foreach($reply->replies as $reply)
                      <x-comment
                      comment="{{$reply->comment}}"
                      name="{{$reply->user->username}}"
                      datePosted="{{$reply->created_at->format('F d, Y \a\t g A')}}"
                      reply="true2"
                      commentid="{{$reply->id}}"

                      />
                    @endforeach
                @endforeach
              @endif
            @endforeach
  
          </div>
        </div>
        <!-- /.row -->
  
      </div>
      <!-- /.container -->
      <script>
        const commentBlock=document.getElementById('commentBlock');
        
        function comment(){
          if(commentBlock.style.display==='block'){
            commentBlock.style.display='none';
        }else{
          commentBlock.style.display='block';
        }
      }
      
    </script>

</x-layout>