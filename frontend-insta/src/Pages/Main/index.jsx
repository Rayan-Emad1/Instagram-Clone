import React, { useState, useEffect } from 'react';
import Header from '../../Components/Header';
import UserCard from '../../Components/UserCard';
import Post from '../../Components/Post';

const Main = () => {
  const [users, setUsers] = useState([]);
  const [posts, setPosts] = useState([]);

  // Fetch users and posts data from your API endpoints using useEffect

  const followUser = async (userId) => {
    // Implement API call to follow user with userId
  };

  const likePost = async (postId) => {
    // Implement API call to like post with postId
  };

  return (
    <div className="main-container">
      <Header />
      <div className="content">
        <div className="user-search">
          {users.map(user => (
            <UserCard key={user.id} user={user} followUser={followUser} />
          ))}
        </div>
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
