export default function Dashboard({ entries }) {
  return (
    <div>
      <h1>Fuel Entries</h1>
      {entries.map(e => (
        <div key={e.id}>
          {e.station_name} - {e.price_per_liter}
        </div>
      ))}
    </div>
  );
}