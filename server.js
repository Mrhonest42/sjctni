require('dotenv').config();
const express = require('express');
const mongoose = require('mongoose');
const cors = require('cors');

const app = express();
app.use(express.json());
app.use(cors());

mongoose.connect(process.env.DATABASE_URL);
const db = mongoose.connection;
db.on('err', (err)=> console.error("Error in connection ", err));
db.once('open', ()=> console.log("Database connected"));

const routes = require('./routes/Router');
app.use('/studentERP', routes);

const PORT = process.env.PORT || 5000;
app.listen(PORT, ()=> console.log(`server running at http://localhost:${PORT}`));