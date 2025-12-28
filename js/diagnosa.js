let currentIndex = 0;
let userAnswers = {};

const questionText = document.getElementById("questionText");
const answerBox = document.getElementById("answerBox");
const progress = document.getElementById("progress");
const jawabanInput = document.getElementById("jawabanInput");
const form = document.getElementById("diagnosaForm");

function renderQuestion() {
    const q = QUESTIONS_DATA[currentIndex];

    // Progress text
    progress.innerText = `QUESTION ${currentIndex + 1} / ${QUESTIONS_DATA.length}`;
    questionText.innerText = q.question;

    answerBox.innerHTML = "";
    answerBox.className = "answers";

    // Render options
    q.options.forEach(option => {
        const label = document.createElement("label");
        label.className = "answer-option";

        const input = document.createElement("input");
        input.type = "radio";
        input.name = "answer";
        input.value = option;

        // restore answer
        if (userAnswers[q.key] === option) {
            input.checked = true;
            label.classList.add("active");
        }

        const radio = document.createElement("span");
        radio.className = "custom-radio";

        const text = document.createElement("span");
        text.innerText = option.replace(/_/g, " ").toUpperCase();

        label.appendChild(input);
        label.appendChild(radio);
        label.appendChild(text);

        label.onclick = () => {
            // save answer
            userAnswers[q.key] = option;

            // visual active
            document
              .querySelectorAll(".answer-option")
              .forEach(el => el.classList.remove("active"));
            label.classList.add("active");
        };

        answerBox.appendChild(label);
    });

    // Navigation buttons
    const nav = document.createElement("div");
    nav.className = "quiz-nav";

    // Previous
    if (currentIndex > 0) {
        const prevBtn = document.createElement("button");
        prevBtn.type = "button";
        prevBtn.innerText = "← Previous";
        prevBtn.onclick = () => {
            currentIndex--;
            renderQuestion();
        };
        nav.appendChild(prevBtn);
    } else {
        nav.appendChild(document.createElement("div"));
    }

    // Next / Finish
    const nextBtn = document.createElement("button");
    nextBtn.type = "button";
    nextBtn.innerText =
        currentIndex === QUESTIONS_DATA.length - 1 ? "Finish" : "Next →";

    nextBtn.onclick = () => {
        if (!userAnswers[q.key]) {
            alert("Silakan pilih jawaban terlebih dahulu");
            return;
        }

        if (currentIndex < QUESTIONS_DATA.length - 1) {
            currentIndex++;
            renderQuestion();
        } else {
            jawabanInput.value = JSON.stringify(userAnswers);
            form.submit();
        }
    };

    nav.appendChild(nextBtn);
    answerBox.appendChild(nav);
}

// Start quiz
renderQuestion();
