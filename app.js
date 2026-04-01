import React, { useEffect, useState } from "react";
import axios from "axios";

function App() {
 const [entries, setEntries] = useState([]);

 const fetchEntries = async () => {
   const res = await axios.get("http://127.0.0.1:8000/api/fuel");
   setEntries(res.data);
 };

 useEffect(() => {
   fetchEntries();
 }, []);

 return (
   <div>
     <h1>Fuel Tracker</h1>

     <ul>
       {entries.map((e) => (
         <li key={e.id}>{e.station_name} - {e.price_per_liter}</li>
       ))}
     </ul>
   </div>
 );
}

export default App;
