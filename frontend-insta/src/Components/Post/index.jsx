
import React, { useState, useEffect } from 'react';
import './styles.css'

const Post = ({ post, likePost}) => {

  // const [condition,setCondition] =  useState("Like");
  // const x =setCondition();
  // //tried to reset name of button
  return (
    <div className="post-card">
      <img className='post-image' src={post.image_url} alt={`Post by ${post.user_name}`} />
      <h3>{post.user_name}</h3>
      <div className='like-container'>
        <span>Likes: {post.likes}</span>
        <button className="like-button-post" onClick={() => likePost(post.id)}>Like</button>
      </div>
     
    </div>
  );
};

export default Post;