import React, { useState, useEffect } from 'react';
import Post from '../../Components/Post';
import './styles.css'

const PostContainer = () => {

  const [posts, setPosts] = useState([]);

  const likePost = async (postId) => {
  };

  return(
    <div className="content">
      <div className="posts-container">
        {posts.map(post => (
          <Post key={post.id} post={post} likePost={likePost} />
        ))}
      </div>
    </div>
  )
 }

 export default  PostContainer