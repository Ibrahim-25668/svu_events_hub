// Scroll to top button functionality
const scrollToTopBtn = document.getElementById('scrollToTopBtn');

window.addEventListener('scroll', () => {
    if (window.scrollY > 300) {
        scrollToTopBtn.style.display = 'block';
    } else {
        scrollToTopBtn.style.display = 'none';
    }
});

scrollToTopBtn.addEventListener('click', () => {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
});


// Dark mode toggle functionality
const toggle = document.getElementById("themeToggle");
const label = toggle.nextElementSibling;

if (localStorage.getItem("theme") === "dark") {
    document.body.classList.add("dark");
    toggle.checked = true;
    label.textContent = "🌙";
} else {
    label.textContent = "☀️";
}

toggle.addEventListener("change", () => {
    if (toggle.checked) {
        document.body.classList.add("dark");
        localStorage.setItem("theme", "dark");
        label.textContent = "🌙";
    } else {
        document.body.classList.remove("dark");
        localStorage.setItem("theme", "light");
        label.textContent = "☀️";
    }
});

// contact check
const form = document.getElementById("contactForm");

form.addEventListener("submit", function (e) {
    e.preventDefault();

    let valid = true;

    const name = document.getElementById("name");
    const email = document.getElementById("email");
    const phone = document.getElementById("phone");
    const message = document.getElementById("message");

    // Regex
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const phoneRegex = /^[0-9]{8,15}$/;

    // Name
    if (name.value.trim() === "") {
        name.classList.add("is-invalid");
        valid = false;
    } else {
        name.classList.remove("is-invalid");
    }

    // Email
    if (!emailRegex.test(email.value)) {
        email.classList.add("is-invalid");
        valid = false;
    } else {
        email.classList.remove("is-invalid");
    }

    // Phone
    if (!phoneRegex.test(phone.value)) {
        phone.classList.add("is-invalid");
        valid = false;
    } else {
        phone.classList.remove("is-invalid");
    }

    // Message
    if (message.value.trim() === "") {
        message.classList.add("is-invalid");
        valid = false;
    } else {
        message.classList.remove("is-invalid");
    }

    // Success
    if (valid) {
        document.getElementById("successMsg").classList.remove("d-none");
        form.reset();
    }
});