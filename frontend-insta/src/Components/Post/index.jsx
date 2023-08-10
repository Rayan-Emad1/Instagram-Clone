import React from 'react';

const Post = ({ post, likePost }) => {
  return (
    <div className="post-card">
      <img src={post.image_url} alt={`Post by ${post.user_name}`} />
      <span>{post.user_name}</span>
      <span>Likes: {post.likes}</span>
      <button onClick={() => likePost(post.id)}>Like</button>
    </div>
  );
};

export default Post;
