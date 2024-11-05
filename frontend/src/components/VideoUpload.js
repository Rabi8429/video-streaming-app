// frontend/src/components/VideoUpload.js
import React, { useState } from 'react';
import axios from 'axios';

const VideoUpload = () => {
  const [video, setVideo] = useState(null);

  const handleVideoChange = (e) => {
    setVideo(e.target.files[0]);
  };

  const handleUpload = async () => {
    const formData = new FormData();
    formData.append('video', video);

    try {
      await axios.post('http://localhost:5000/api/videos/upload', formData);
      alert('Video uploaded successfully!');
    } catch (error) {
      console.error('Error uploading video:', error);
      alert('Failed to upload video');
    }
  };

  return (
    <div>
      <input type="file" accept="video/*" onChange={handleVideoChange} />
      <button onClick={handleUpload}>Upload Video</button>
    </div>
  );
};

export default VideoUpload;
