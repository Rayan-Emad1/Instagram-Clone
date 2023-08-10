import React, { useState, useEffect } from 'react';

const UserProfileInfo = () => {
  const [totalLikes, setTotalLikes] = useState(0);
  const [totalFollowers, setTotalFollowers] = useState(0);

  const fetchUserInfo = async () => {
    try {
      const token = localStorage.getItem('token');
      if (!token) {
        console.log('Token not found.');
        return;
      }

      const likesResponse = await fetch('http://127.0.0.1:8000/api/user/likes', {
        method: 'GET',
        headers: {
          Authorization: `Bearer ${token}`,
        },
      });

      const followersResponse = await fetch('http://127.0.0.1:8000/api/user/followers', {
        method: 'GET',
        headers: {
          Authorization: `Bearer ${token}`,
        },
      });

      const likesData = await likesResponse.json();
      const followersData = await followersResponse.json();

      setTotalLikes(likesData.total_likes);
      setTotalFollowers(followersData.total_followers);

    } catch (error) {
      console.log('Error:', error);
    }
  };

  useEffect(() => {
    fetchUserInfo();

  }, []); 

  return (
    <div className="user-profile-info">
      <p>Total Likes: {totalLikes}</p>
      <p>Total Followers: {totalFollowers}</p>
    </div>
  );
};

export default UserProfileInfo;
