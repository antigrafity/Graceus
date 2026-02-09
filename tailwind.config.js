/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./index.html",
    "./products/**/*.html"
  ],
  theme: {
    extend: {
      colors: {
        ink: "#e7eefc",
        "ink-soft": "#a9b9d6",
        primary: "#004aad",
        "primary-strong": "#0b2f72",
        accent: "#2ea6ff",
        line: "rgba(90, 135, 210, 0.28)"
      },
      fontFamily: {
        display: ["Oswald", "sans-serif"],
        sans: ["Space Grotesk", "sans-serif"]
      }
    }
  },
  plugins: []
};
