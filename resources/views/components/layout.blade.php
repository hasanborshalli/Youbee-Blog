<x-navbar/>
@if(session()->has('success'))
<div id="toast" class="toast">
  <div class="toast-header">
  <strong class="mr-auto">Youbee</strong>
  <button type="button" id="closeButton"onclick="close()" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button> 
    </div>
  <p id="message">{{session('success')}}</p>
</div>
@endif
{{$slot}} 
<script>
  const toast=document.getElementById('toast');
  const closeButton = document.getElementById('closeButton');
  closeButton.addEventListener('click',function(){
    toast.style.display = "none"
  });
    function like(id){
      let btn=document.getElementById('post'+id);
      let nbLikes=document.getElementById('nbLikes'+id);
      let options={
        method:"POST",
        headers:{
          'X-CSRF-TOKEN': '{{csrf_token()}}',
          'Content-Type': 'application/json'
        }
      }
      fetch('/post/like/'+id,options)
      .then(response => response.json())
      .then((data)=>{;
        if (data.liked){
          btn.innerHTML="👍🏻Unlike";
          btn.classList.remove('btn-default');
          btn.classList.add('btn-primary');
          let currentLikes=parseInt(nbLikes.textContent);
          let newLikes=currentLikes+1;
          nbLikes.innerHTML=newLikes+" Likes";
        }else{
          btn.innerHTML="👍🏻Like";
          btn.classList.remove('btn-primary');
          btn.classList.add('btn-default');
          let currentLikes=parseInt(nbLikes.textContent);
          let newLikes=currentLikes-1;
          nbLikes.innerHTML=newLikes+" Likes";
        }
      })
      .catch(error=>console.error("Error: ",error));
    }
    function follow(id){
      let FollowButtons=document.querySelectorAll('.user'+id);
      let options={
        method:"POST",
        headers:{
          'X-CSRF-TOKEN': '{{csrf_token()}}',
          'Content-Type': 'application/json'
        }
      }
      fetch('/user/follow/'+id,options)
      .then(response => response.json())
      .then((data)=>{;
        if (data.followed){
          FollowButtons.forEach((FollowButton)=>{
            FollowButton.innerHTML="✔️Unfollow";
            FollowButton.classList.remove('btn-default');
            FollowButton.classList.add('btn-success');
          })
        }else{
          FollowButtons.forEach((FollowButton)=>{
            FollowButton.innerHTML="➕Follow";
            FollowButton.classList.add('btn-default');
            FollowButton.classList.remove('btn-success');
          })
        }
      })
      .catch(error=>console.error("Error: ",error));
    }
    function readLater(id){
      let readbtn=document.getElementById('read'+id);
      let options={
        method:"POST",
        headers:{
          'X-CSRF-TOKEN': '{{csrf_token()}}',
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({id: id})
      };
      fetch('/home/read-later',options)
      .then(response => response.json())
      .then((data)=>{
        if (data.status=="added"){
          readbtn.innerHTML="Saved";
          readbtn.classList.remove('btn-default');
          readbtn.classList.add('btn-success');
        }else{
          readbtn.innerHTML="Read Later";
          readbtn.classList.remove('btn-success');
          readbtn.classList.add('btn-default');
          
        }
      })
      .catch(error=>console.error("Error: ",error));

    }
</script>
<x-footer/>