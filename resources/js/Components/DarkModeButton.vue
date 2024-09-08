<script setup>
import { onMounted } from "vue";
import { Link, router } from "@inertiajs/vue3";

const toggleMode = () => {
    const pageElement = document.documentElement;

    const darkIcon = document.querySelector("#theme-toggle-dark-icon");
    const lightIcon = document.querySelector("#theme-toggle-light-icon");

    darkIcon.classList.toggle("hidden");
    lightIcon.classList.toggle("hidden");

    if (pageElement.classList.contains("dark")) {
        pageElement.classList.remove("dark");
        pageElement.classList.add("light");

        localStorage.setItem("color-theme", "light");
    } else {
        pageElement.classList.remove("light");
        pageElement.classList.add("dark");

        localStorage.setItem("color-theme", "dark");
    }
};

onMounted(() => {
    const colorTheme = localStorage.getItem("color-theme");

    const pageElement = document.documentElement;

    const darkIcon = document.querySelector("#theme-toggle-dark-icon");
    const lightIcon = document.querySelector("#theme-toggle-light-icon");

    if (colorTheme) {
        // Set current class theme
        colorTheme == "dark"
            ? pageElement.classList.add("dark")
            : pageElement.classList.remove("dark");

        // Display icon of current theme
        colorTheme == "dark"
            ? lightIcon.classList.toggle("hidden")
            : darkIcon.classList.toggle("hidden");
    } else {
        if (window.matchMedia) {
            // Set current class theme
            window.matchMedia("(prefers-color-scheme: dark)")
                ? pageElement.classList.add("dark")
                : pageElement.classList.remove("dark");

            // Display icon of current theme
            window.matchMedia("(prefers-color-scheme: dark)")
                ? lightIcon.classList.toggle("hidden")
                : darkIcon.classList.toggle("hidden");
        }
    }
});
</script>

<template>
    <button
        @click="toggleMode"
        id="theme-toggle"
        type="button"
        class="text-gray-500 dark:text-gray-400 inline-flex items-center justify-center hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5"
    >
        <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 512 512"
            id="theme-toggle-light-icon"
            class="hidden w-5 h-5"
        >
            <path
                fill="currentColor"
                d="M361.5 1.2c5 2.1 8.6 6.6 9.6 11.9L391 121l107.9 19.8c5.3 1 9.8 4.6 11.9 9.6s1.5 10.7-1.6 15.2L446.9 256l62.3 90.3c3.1 4.5 3.7 10.2 1.6 15.2s-6.6 8.6-11.9 9.6L391 391 371.1 498.9c-1 5.3-4.6 9.8-9.6 11.9s-10.7 1.5-15.2-1.6L256 446.9l-90.3 62.3c-4.5 3.1-10.2 3.7-15.2 1.6s-8.6-6.6-9.6-11.9L121 391 13.1 371.1c-5.3-1-9.8-4.6-11.9-9.6s-1.5-10.7 1.6-15.2L65.1 256 2.8 165.7c-3.1-4.5-3.7-10.2-1.6-15.2s6.6-8.6 11.9-9.6L121 121 140.9 13.1c1-5.3 4.6-9.8 9.6-11.9s10.7-1.5 15.2 1.6L256 65.1 346.3 2.8c4.5-3.1 10.2-3.7 15.2-1.6zM160 256a96 96 0 1 1 192 0 96 96 0 1 1 -192 0zm224 0a128 128 0 1 0 -256 0 128 128 0 1 0 256 0z"
            />
        </svg>

        <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 384 512"
            id="theme-toggle-dark-icon"
            class="hidden w-5 h-5"
        >
            <path
                fill="currentColor"
                d="M223.5 32C100 32 0 132.3 0 256S100 480 223.5 480c60.6 0 115.5-24.2 155.8-63.4c5-4.9 6.3-12.5 3.1-18.7s-10.1-9.7-17-8.5c-9.8 1.7-19.8 2.6-30.1 2.6c-96.9 0-175.5-78.8-175.5-176c0-65.8 36-123.1 89.3-153.3c6.1-3.5 9.2-10.5 7.7-17.3s-7.3-11.9-14.3-12.5c-6.3-.5-12.6-.8-19-.8z"
            />
        </svg>
    </button>
    <div
        id="tooltip-toggle"
        role="tooltip"
        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip"
    >
        Toggle dark mode
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>
</template>
