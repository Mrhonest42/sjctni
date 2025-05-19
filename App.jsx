import { useState } from 'react'
import './App.css';
import Class from "./assets/Class.json";

function App() {
  //const data = Class.json();
  console.log(Class[0].id);
  const students = Class[0].students[1];
  console.log(students);

  return (
    <>
    <div className="container">
      <div className="top w-75 bg-info p-3">
        <h1>St. Joseph's College Tiruchirappalli - 02</h1>
        <h2>Attendance Website</h2>
        <h4>Carmel Pushpa Raj</h4>
      </div>
      <div className="bottum w-75">
        {students.map((index,std)=>(
          <button key={index}>{std}</button>
        ))}
      </div>
    </div>
    </>
  )
}

export default App
