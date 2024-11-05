// routes/videoRoutes.js
const express = require('express');
const multer = require('multer');
const videoController = require('../controllers/videoController');
const router = express.Router();

const upload = multer({ dest: 'uploads/' });

router.post('/upload', upload.single('video'), videoController.uploadVideo);
router.get('/stream/:key', videoController.streamVideo);

module.exports = router;
