

<h2 class="post-title">
  <a href="/post/{{$id}}">{{$title}}</a>
</h2>
@if($username != "")
<a href="/user/{{$userid}}" class="lead" style="margin-right:10px;">{{$username}}</a>
@endif
@if($followable=="true")
<a class="btn btn-{{$followedClass}} user{{$userid}}" onclick="follow({{$userid}})" >{{$followed}}</a>
@endif
<p><span class="glyphicon glyphicon-time"></span> {{$datePosted}}</p>

<p>{!! htmlspecialchars_decode($content) !!}</p>

<a class="btn btn-{{$class}}" onclick="like({{$id}})" id="post{{$id}}" >👍🏻{{$liked}}</a>
@if($sharable=="true")
<a class="btn btn-default"  href="/post/share/{{$id}}">➤Share</a>
@endif
<a class="btn btn-default"  href="/post/{{$id}}">Read More</a>
<button class="btn btn-{{in_array($id,session('read_later',[])) ? 'success' : 'default' }}" 
        id="read{{$id}}" 
        onclick="readLater({{$id}})">

{{in_array($id,session('read_later',[])) ? 'Saved' : 'Read Later' }}</button><br>
<small id="nbLikes{{$id}}">{{$nbLikes}} Likes</small>

<hr>
