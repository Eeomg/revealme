
   
    var likebtn = document.getElementsByClassName("likepost")
    var countlikepost = document.getElementsByClassName("countlikepost")

    var comuntbtn = document.getElementsByClassName("comuntbtn")
    var commentinp = document.getElementsByClassName("commentinp")
    var countomments = document.getElementsByClassName("countomments")
    var commentcontainer = document.getElementsByClassName("commentcontainer")
    var postcomment = document.getElementsByClassName("postcomment")
    var deletecomment = document.getElementsByClassName("deletecomment")
    var deletecommentlen = deletecomment.length
    var btnlen = comuntbtn.length
    var likebtnlen = likebtn.length
    
// add friend 
    let addfriend = document.getElementById("addfriend")

    if(addfriend){

      let status = addfriend.getAttribute("status")

      if(status == 0 ){

        addfriend.style.backgroundColor = "red"
        document.getElementById("spantext").innerText = "delete request" 

      }else if(status == 1){

        document.getElementById("spantext").innerText = "friend"

      }else if(status == 2){

        document.getElementById("spantext").innerText = "confirm" 

      }

      addfriend.addEventListener("click", function(event){

        friendid = this.getAttribute("getid")

        $.post("/Friend/friendHandeler/"+friendid,{
        },function(data){
          if(data == 0 ){

            addfriend.style.backgroundColor = "red"
            document.getElementById("spantext").innerText = "delete request" 

          }else if(data == 3){

            addfriend.style.backgroundColor = "rgb(23, 162, 184)"
            document.getElementById("spantext").innerText = "Add friend" 

          }
          else if(data == 1){

            addfriend.style.backgroundColor = "rgb(23, 162, 184)"
            document.getElementById("spantext").innerText = "friend" 

          }
        })
      })
    }
  
  // confirm friend
    let confirmfriendbtn = document.getElementsByClassName("confirmfriendbtn")
    let confirmfriendcont = document.getElementsByClassName("confirmfriendcont")
    function addConfirmFriendEvent(confirmfriendbtn,confirmfriendcont) 
    {
      confirmfriendbtn.addEventListener("click", function(event) {
        friendid = confirmfriendbtn.getAttribute("friendid")
        $.post("/Friend/confirmFriend/"+friendid,{ 
        },function(data){
          confirmfriendcont.style.display = "none"
        })
      })
    }
  
    for (var i = 0; i < confirmfriendbtn.length; i++){
      addConfirmFriendEvent(confirmfriendbtn[i],confirmfriendcont[i])
    }
  
  
  
  // Like Settings

    function addLikeEvent(likebtn,countlikepost) 
    {
        likebtn.addEventListener("click", function(event) {
        postid = likebtn.getAttribute("postid")
        $.get("/Like/Likehandeler/"+postid,{ 
        },function(data){
          countlikepost.innerHTML = data
        })
      })
    }
  
    for (var k = 0; k < likebtnlen ;k++){
      addLikeEvent(likebtn[k],countlikepost[k])
    }
  
  // comments settings 
    function addCommmentEvent(comuntbtn,commentinp,countomments,commentcontainer) {
      comuntbtn.addEventListener("click", function(event) {
        postid  = comuntbtn.getAttribute("postid")
        comment = commentinp.value

        $.post("/Comments/addComments/"+postid+"/"+comment+"",{ 
        },function(data){
          console.log(data)
          commentinp.value = ""
          array = data.split("{thismydata}")
          countomments.innerHTML = array[0]
          commentcontainer.innerHTML = array[1] + commentcontainer.innerHTML
          postcomment = document.getElementsByClassName("postcomment")
          deletecomment = document.getElementsByClassName("deletecomment")
          deletecommentlen = deletecomment.length
          for (var l = 0; l < deletecommentlen; l++){
            deleteCommmentEvent(deletecomment[l],postcomment[l]);
          }
        })
      })
    }
  
    for (var j = 0; j < btnlen; j++){
        console.log()
      addCommmentEvent(comuntbtn[j],commentinp[j],countomments[j],commentcontainer[j]);
  
    }
    // 
  
  
    function deleteCommmentEvent(deletecomment,postcomment){
      deletecomment.addEventListener("click", function(event) {
        commentid = deletecomment.getAttribute("commentid")
        $.get("/Comments/delComment/"+commentid,{ 
        },function(data){
          postcomment.style.display = "none"
        })
      })
    }
  
    for (var l = 0; l < deletecommentlen; l++){
      deleteCommmentEvent(deletecomment[l],postcomment[l]);
    }
  

