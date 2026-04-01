import React, { useEffect, useState } from "react";
import axios from "axios";

function App() {
 const [entries, setEntries] = useState([]);
 const [form, setForm] = useState({
   station_name: "",
   fuel_type: "Diesel",
   price_per_liter: ""
 });

 const fetchEntries = async () => {
   const res = await axios.get("http://127.0.0.1:8000/api/fuel");
   setEntries(res.data);
 };

 useEffect(() => {
   fetchEntries();
 }, []);

 const submit = async (e) => {
   e.preventDefault();
   await axios.post("http://127.0.0.1:8000/api/fuel", form);
   fetchEntries();
 };

 const deleteEntry = async (id) => {
   await axios.delete(`http://127.0.0.1:8000/api/fuel/${id}`);
   fetchEntries();
 };

 return (
   <div style={{ padding: 20 }}>
     <h1>SmartGas Fuel Tracker</h1>

     <form onSubmit={submit}>
       <input placeholder="Station"
         onChange={(e) => setForm({...form, station_name: e.target.value})}
       />

       <select
         onChange={(e) => setForm({...form, fuel_type: e.target.value})}
       >
         <option>Diesel</option>
         <option>Unleaded</option>
         <option>Premium</option>
       </select>

       <input type="number" placeholder="Price"
         onChange={(e) => setForm({...form, price_per_liter: e.target.value})}
       />

       <button>Add</button>
     </form>

     <table border="1">
       <thead>
         <tr>
           <th>Station</th>
           <th>Fuel</th>
           <th>Price</th>
           <th>Action</th>
         </tr>
       </thead>

       <tbody>
         {entries.map(e => (
           <tr key={e.id}>
             <td>{e.station_name}</td>
             <td>{e.fuel_type}</td>
             <td style={{
               color: e.price_per_liter > 90 ? "red" : "green"
             }}>
               {e.price_per_liter}
             </td>
             <td>
               <button onClick={() => deleteEntry(e.id)}>Delete</button>
             </td>
           </tr>
         ))}
       </tbody>
     </table>
   </div>
 );
}

export default App;
