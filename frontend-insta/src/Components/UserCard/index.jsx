import React from 'react';




const UserCard = ({ user }) => {
  const token = localStorage.getItem('token');

  const followUser = async (followingId) => {
    try {
      if (!token) {
        console.log('Token not found.');
        return;
      }

      const response = await fetch('http://127.0.0.1:8000/api/follow', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          Authorization: `Bearer ${token}`,
        },
        body: JSON.stringify({ following_id: followingId }),
      });


      const data = await response.json();
      console.log(data.message);

    } catch (error) {
      console.log('Error:', error);
    }
  };

  return (
    <div className="user-card">
      <span>{user.name}</span>
      <button onClick={() => followUser(user.id)}>Follow</button>
    </div>
  );
};

export default UserCard;
