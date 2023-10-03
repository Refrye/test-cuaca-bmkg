// Fungsi untuk menampilkan data cuaca ke dalam elemen HTML
function displayWeatherData(data) {
const time = new Date(data["time"]);
const formatter = new Intl.DateTimeFormat("id-ID", {
    timeZone: "Asia/Jakarta",
    year: "numeric",
    month: "numeric",
    day: "numeric",
    hour: "numeric",
    minute: "numeric",
    second: "numeric",
});

document.getElementById("city").textContent = data["location"];
document.getElementById("timestamp").textContent = formatter.format(time);
document.getElementById("description").textContent = data["current_weather"];
document.getElementById("temperature").textContent = data["temperature"];
document.getElementById("humidity").textContent = data["humidity"];
}

// Mengambil data cuaca untuk daerah tertentu dari PHP menggunakan (AJAX)
const selectedArea = "Jombang"; // Ganti dengan daerah yang Anda inginkan

fetch(`lokasi.php?area=${selectedArea}`)
.then((response) => response.json())
.then((data) => {
    displayWeatherData(data);
})
.catch((error) => console.error("Error:", error));
