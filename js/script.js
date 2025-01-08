const cloudinary = require('cloudinary').v2;

import { v2 as cloudinary } from 'cloudinary';

cloudinary.config({
    cloud_name:'dsyt4e4fp',
    api_key: process.env.CLOUDINARY_API_KEY,
    api_secret: process.env.CLOUDINARY_API_SECRET,
});

(async function () {
    const results = await cloudinary.uploader.upload
})();