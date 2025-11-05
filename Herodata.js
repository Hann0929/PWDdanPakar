let heroData = [];

fetch("dataset_hero.json")
  .then(res => res.json())
  .then(data => {
    heroData = data;
    const heroSelect = document.getElementById("heroSelect");
    data.forEach(hero => {
      const option = document.createElement("option");
      option.value = hero.hero;
      option.textContent = hero.hero;
      heroSelect.appendChild(option);
    });
  });

document.getElementById("analyzeBtn").addEventListener("click", () => {
  const selectedHero = document.getElementById("heroSelect").value;
  const resultDiv = document.getElementById("result");

  if (!selectedHero) {
    resultDiv.innerHTML = "<p>⚠️ Silakan pilih hero terlebih dahulu!</p>";
    return;
  }

  const hero = heroData.find(h => h.hero === selectedHero);
  if (!hero) {
    resultDiv.innerHTML = "<p>❌ Data hero tidak ditemukan!</p>";
    return;
  }

  let html = `<h2>${hero.hero} (${hero.role})</h2>`;
  html += "<h3>Counter Effectiveness:</h3><ul>";

  hero.counters.forEach(counter => {
    html += `
      <li>
        <strong>${counter.role}</strong> — Efektivitas: <strong>${counter.value}</strong><br>
        <em>${counter.reason}</em>
      </li>`;
  });

  html += `
    </ul>
    <button id="chooseBtn" class="back-btn">🔁 Pilih Hero Lain</button>
  `;

  resultDiv.innerHTML = html;

  // Fungsi tombol "Pilih Hero Lain"
  document.getElementById("chooseBtn").addEventListener("click", () => {
    document.getElementById("heroSelect").value = ""; // reset dropdown
    resultDiv.innerHTML = ""; // kosongkan hasil
  });
});
