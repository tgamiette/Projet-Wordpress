
window.onload = (event) => {
  var post = document.querySelector('.c-moderation_post');
  var comment = document.querySelector('.c-moderation_comments');
  var btn_post = document.querySelector('.btn-post');
  var btn_comment = document.querySelector('.btn-comment');

  btn_post.addEventListener('click', function(){
    post.classList.remove("hidden");
    comment.classList.add("hidden");
    btn_post.classList.add('active');
    btn_comment.classList.remove('active');

  });

  btn_comment.addEventListener('click', function(){
    post.classList.add("hidden");
    comment.classList.remove("hidden");
    btn_comment.classList.add('active');
    btn_post.classList.remove('active');
  });

};
