console.log('lapin');

jQuery('.btn-post').on('click', function(){
  console.log('hello');
  jQuery('.c-moderation_post').removeClass('hidden');
  jQuery('.c-moderation_comments').addClass('hidden');
});

jQuery('.btn-comment').on('click', function(){
  jQuery('.c-moderation_comments').removeClass('hidden');
  jQuery('.c-moderation_post').addClass('hidden');
});
