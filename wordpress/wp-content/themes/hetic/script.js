
window.onload = (event) => {
  var post = document.querySelector('.c-moderation_post');
  var comment = document.querySelector('.c-moderation_comments');
  var btn_post = document.querySelector('.btn-post');
  console
  btn_post.addEventListener('click', function(){
    post.classList.remove("hidden");
    comment.classList.add("hidden");
  });

  document.querySelector('.btn-comment').addEventListener('click', function(){
    post.classList.add("hidden");
    comment.classList.remove("hidden");
  });
};
