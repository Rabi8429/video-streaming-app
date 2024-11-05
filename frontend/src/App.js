// frontend/src/App.js
import React, { useState } from 'react';
import VideoUpload from './components/VideoUpload';
import VideoPlayer from './components/VideoPlayer';

function App() {
  const [videoUrl, setVideoUrl] = useState('');

  const handleVideoUpload = (url) => {
    setVideoUrl(url);
  };

  return (
    <div className="App">
      <h1>Video Streaming App</h1>
      <VideoUpload onVideoUpload={handleVideoUpload} />
      {videoUrl && <VideoPlayer videoUrl={videoUrl} />}
    </div>
  );
}

export default App;
