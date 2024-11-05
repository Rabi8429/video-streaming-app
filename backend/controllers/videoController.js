// backend/controllers/videoController.js
const AWS = require('aws-sdk');
const multer = require('multer');
const { S3_BUCKET, AWS_ACCESS_KEY_ID, AWS_SECRET_ACCESS_KEY } = require('../config');

// Set up AWS S3
const s3 = new AWS.S3({
  accessKeyId: AWS_ACCESS_KEY_ID,
  secretAccessKey: AWS_SECRET_ACCESS_KEY,
});

// Set up multer for file upload
const upload = multer({ storage: multer.memoryStorage() });

// Upload video to S3
exports.uploadVideo = async (req, res) => {
  const { originalname, buffer } = req.file;
  
  const params = {
    Bucket: S3_BUCKET,
    Key: originalname,
    Body: buffer,
    ContentType: req.file.mimetype,
  };

  try {
    await s3.upload(params).promise();
    res.status(200).json({ message: 'Video uploaded successfully!' });
  } catch (error) {
    res.status(500).json({ error: 'Failed to upload video' });
  }
};

// Get video from S3
exports.getVideo = (req, res) => {
  const { filename } = req.params;

  const params = {
    Bucket: S3_BUCKET,
    Key: filename,
  };

  s3.getObject(params, (error, data) => {
    if (error) {
      return res.status(500).json({ error: 'Failed to retrieve video' });
    }
    res.writeHead(200, { 'Content-Type': data.ContentType });
    res.end(data.Body);
  });
};
