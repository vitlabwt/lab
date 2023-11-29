// server/server.js
const express = require('express');
const cors = require('cors');
const bodyParser = require('body-parser');
const mysql = require('mysql');

const app = express();
const port = 3001;

app.use(cors());
app.use(bodyParser.json());

const db = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: 'Sckposyn#123',
  database: 'college_results',
});

db.connect(err => {
  if (err) {
    console.error('Error connecting to MySQL:', err);
  } else {
    console.log('Connected to MySQL database');
  }
});

app.get('/results', (req, res) => {
  const query = 'SELECT * FROM results';

  db.query(query, (err, results) => {
    if (err) {
      console.error('Error fetching results:', err);
      res.status(500).send('Internal Server Error');
    } else {
      res.json(results);
    }
  });
});

app.post('/results', (req, res) => {
    const { subject, mseMarks, eseMarks } = req.body;
    const totalMarks = Math.round((mseMarks * 0.3 + eseMarks * 0.7));
  
    const query = 'INSERT INTO results (subject, mse_marks, ese_marks, total_marks) VALUES (?, ?, ?, ?)';
  
    db.query(query, [subject, mseMarks, eseMarks, totalMarks], err => {
      if (err) {
        console.error('Error adding result:', err);
        res.status(500).send('Internal Server Error');
      } else {
        res.sendStatus(200);
      }
    });
  });

app.listen(port, () => {
  console.log(`Server is running on port ${port}`);
});
