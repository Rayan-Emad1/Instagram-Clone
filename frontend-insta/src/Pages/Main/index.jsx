import React, { useState, useEffect } from 'react';
import Header from '../../Components/Header';
import Post from '../../Components/Post';

const Main = () => {

  const [posts, setPosts] = useState([]);

  const likePost = async (postId) => {
  };

  return (
    <div className="main-container">

      <Header />

      <div className="content">
        <div className="posts-container">
          {posts.map(post => (
            <Post key={post.id} post={post} likePost={likePost} />
          ))}
          
        </div>
      </div>
    </div>
  );
};

export default Main;
