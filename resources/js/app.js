import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

const themeToggleDarkIcon = document.getElementById("theme-toggle-dark-icon");
const themeToggleLightIcon = document.getElementById("theme-toggle-light-icon");
const themeToggleButton = document.getElementById("theme-toggle");

// Function to set theme
function setTheme(isDark) {
    if (isDark) {
        document.documentElement.classList.add("dark");
        localStorage.setItem("theme", "dark");
        if (themeToggleLightIcon)
            themeToggleLightIcon.classList.remove("hidden");
        if (themeToggleDarkIcon) themeToggleDarkIcon.classList.add("hidden");
    } else {
        document.documentElement.classList.remove("dark");
        localStorage.setItem("theme", "light");
        if (themeToggleDarkIcon) themeToggleDarkIcon.classList.remove("hidden");
        if (themeToggleLightIcon) themeToggleLightIcon.classList.add("hidden");
    }
}

// Initial theme check
if (
    localStorage.getItem("theme") === "dark" ||
    (!("theme" in localStorage) &&
        window.matchMedia("(prefers-color-scheme: dark)").matches)
) {
    setTheme(true);
} else {
    setTheme(false);
}

// Listener for the toggle button
if (themeToggleButton) {
    themeToggleButton.addEventListener("click", function () {
        const isDark = document.documentElement.classList.contains("dark");
        setTheme(!isDark);
    });
}
