@if($reply=="false")
    <div class="media">
@elseif($reply=="true2")
    <div class="media" style="margin-left:120px;">
@else
    <div class="media" style="margin-left:60px;">
@endif

    <a class="pull-left" href="#">
      {{-- <img class="media-object" src="http://placehold.it/64x64" alt=""> --}}
    </a>
    <div class="media-body">
      <h4 class="media-heading">{{$name}}<br>
      <small>{{$datePosted}}</small>
      </h4>
{{$comment}}    
</div>
<button class="btn btn-primary" onclick="reply({{$commentid}})" >Reply</button>
<br><br>
            <div class="well" id="replyBlock{{$commentid}}" style="display:none">
              <h4>Leave a Reply:</h4>
              <form role="form" method="post" action="/reply/{{$commentid}}">
                @csrf
                <div class="form-group">
                  <textarea class="form-control" name="comment" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
  
            <hr>
  </div>
  <script>
    function reply(id){
        const replyBlock = document.getElementById('replyBlock'+id);
        if(replyBlock.style.display==='block'){
            replyBlock.style.display='none';
        }else{
          replyBlock.style.display='block';
        }
    }
  </script>