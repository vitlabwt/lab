// src/App.js
import React, { useState, useEffect } from 'react';
import axios from 'axios';

const App = () => {
  const [results, setResults] = useState([]);
  const [subject, setSubject] = useState('');
  const [mse_marks, setMseMarks] = useState('');
  const [ese_marks, setEseMarks] = useState('');

  useEffect(() => {
    fetchResults();
  }, []);

  const fetchResults = async () => {
    try {
      const response = await axios.get('http://localhost:3001/results');
      setResults(response.data);
    } catch (error) {
      console.error('Error fetching results:', error);
    }
  };

  const addResult = async () => {
    try {
      await axios.post('http://localhost:3001/results', {
        subject,
        mse_marks,
        ese_marks,
      });
      fetchResults();
      setSubject('');
      setMseMarks('');
      setEseMarks('');
    } catch (error) {
      console.error('Error adding result:', error);
    }
  };

  return (
    <div>
      <h1>College Semester Results</h1>
      <table>
        <thead>
          <tr>
            <th>Subject</th>
            <th>MSE Marks</th>
            <th>ESE Marks</th>
            <th>Total Marks</th>
          </tr>
        </thead>
        <tbody>
          {results.map(result => (
            <tr key={result.id}>
              <td>{result.subject}</td>
              <td>{result.mse_marks}</td>
              <td>{result.ese_marks}</td>
              <td>{result.total_marks}</td>
            </tr>
          ))}
        </tbody>
      </table>
      <div>
        <h2>Add Result</h2>
        <label>
          Subject:
          <input
            type="text"
            value={subject}
            onChange={e => setSubject(e.target.value)}
          />
        </label>
        <label>
          MSE Marks:
          <input
            type="number"
            value={mse_marks}
            onChange={e => setMseMarks(e.target.value)}
          />
        </label>
        <label>
          ESE Marks:
          <input
            type="number"
            value={ese_marks}
            onChange={e => setEseMarks(e.target.value)}
          />
        </label>
        <button onClick={addResult}>Add Result</button>
      </div>
    </div>
  );
};

export default App;
