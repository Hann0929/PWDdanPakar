const heroes = [
  { name: "Chou", role: "Fighter", rank: "epic", counterTo: ["Alucard", "Miya"], img: "https://upload.wikimedia.org/wikipedia/en/f/f7/Chou_Mobile_Legends.png" },
  { name: "Khufra", role: "Tank", rank: "legend", counterTo: ["Gusion", "Lancelot"], img: "https://upload.wikimedia.org/wikipedia/en/2/23/Khufra_Mobile_Legends.png" },
  { name: "Saber", role: "Assassin", rank: "mythic", counterTo: ["Gusion", "Harley"], img: "https://upload.wikimedia.org/wikipedia/en/e/e2/Saber_Mobile_Legends.png" },
  { name: "Minsitthar", role: "Fighter", rank: "honor", counterTo: ["Lancelot"], img: "https://upload.wikimedia.org/wikipedia/en/9/9f/Minsitthar_Mobile_Legends.png" },
  { name: "Franco", role: "Tank", rank: "glory", counterTo: ["Alucard", "Miya"], img: "https://upload.wikimedia.org/wikipedia/en/1/1f/Franco_Mobile_Legends.png" },
];

// 🔹 Tombol Analisis
document.getElementById("analyzeBtn").addEventListener("click", () => {
  const selectedHero = document.getElementById("heroSelect").value;
  const selectedRank = document.getElementById("rankFilter").value;
  const resultArea = document.getElementById("resultArea");

  if (!selectedHero) {
    resultArea.innerHTML = `<p style="color:#0ef;">⚠️ Silakan pilih hero terlebih dahulu.</p>`;
    return;
  }

  // 🔸 Filter berdasarkan hero dan rank
  let counters = heroes.filter(h => h.counterTo.includes(selectedHero));
  if (selectedRank !== "semua") counters = counters.filter(h => h.rank === selectedRank);

  // 🔸 Tampilkan hasil
  if (counters.length === 0) {
    resultArea.innerHTML = `<p style="color:#f55;">❌ Tidak ditemukan hero counter untuk rank tersebut.</p>`;
    return;
  }

  resultArea.innerHTML = counters.map(hero => `
    <div class="hero-card">
      <img src="${hero.img}" alt="${hero.name}" />
      <h3>${hero.name}</h3>
      <p>${hero.role} - Rank: ${hero.rank.toUpperCase()}</p>
    </div>
  `).join('');
});

// 🔹 Tombol Kembali
function goBack() {
  window.history.back();
}
