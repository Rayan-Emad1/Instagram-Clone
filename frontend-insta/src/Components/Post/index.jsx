
import React, { useState, useEffect } from 'react';

const Post = ({ post, likePost}) => {

  // const [condition,setCondition] =  useState("Like");
  // const x =setCondition();
  // //tried to reset name of button
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