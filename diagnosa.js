let dataset = [];

fetch("data.json")
  .then(response => response.json())
  .then(data => {
    dataset = data;
    populateHeroSelect(data);
  })
  .catch(error => {
    console.error("Gagal memuat data.json:", error);
    document.getElementById("heroSelect").innerHTML = `
      <option value="">⚠️ Data gagal dimuat</option>
    `;
  });

document.addEventListener("DOMContentLoaded", function() {
  const heroSelect = document.getElementById("heroSelect");
  heroSelect.addEventListener("change", function() {
    if (this.value) {
      this.classList.add("filled");
    } else {
      this.classList.remove("filled");
    }
  });
});


function populateHeroSelect(data) {
  const select = document.getElementById("heroSelect");
  select.innerHTML = `<option value="">-- Pilih Hero --</option>`;
  data.forEach(hero => {
    const option = document.createElement("option");
    option.value = hero.hero;
    option.textContent = hero.hero;
    select.appendChild(option);
  });
}
//fungsion
function diagnoseHero() {
  const heroName = document.getElementById("heroSelect").value;
  const resultBox = document.getElementById("result");

  if (!heroName) {
    resultBox.innerHTML = "<p class='warning'>⚠️ Silakan pilih hero terlebih dahulu!</p>";
    return;
  }

  const heroData = dataset.find(h => h.hero === heroName);
  if (!heroData) {
    resultBox.innerHTML = "<p>Data tidak ditemukan.</p>";
    return;
  }

  let html = `
    <h2>Hasil Diagnosa untuk ${heroData.hero}</h2>
    <p><strong>Role:</strong> ${heroData.role}</p>
    <div class="counter-list">
  `;

  heroData.counters.forEach(counter => {
    const percent = (counter.value * 100).toFixed(0);
    const confidenceColor =
      counter.value >= 0.8 ? "#00FF99" :
      counter.value >= 0.5 ? "#FFD700" : "#FF6666";

    html += `
      <div class="counter-item">
        <h3>${counter.role}</h3>
        <div class="progress-bar">
          <div class="progress-fill" style="width:${percent}%; background:${confidenceColor};"></div>
        </div>
        <p class="confidence" style="color:${confidenceColor}">
          Tingkat Kepercayaan: ${percent}%
        </p>
        <p>${counter.reason}</p>
      </div>
    `;
  });

  html += `</div>`;
  resultBox.innerHTML = html;
}

function goBack() {
  window.location.href = "index.html";
}

function goInfo() {
  window.location.href = "info.html";
}
