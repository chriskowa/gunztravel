/** @type {import('tailwindcss').Config} */
export default {
  content: ['./index.html', './src/**/*.{vue,js,ts,jsx,tsx}'],
  theme: {
    extend: {
      colors: {
        brand: {
          50: '#fff9ec',
          100: '#ffefc7',
          200: '#ffe08a',
          300: '#ffc94d',
          400: '#ffb31a',
          500: '#ff9f1c',
          600: '#f28c00',
          700: '#e87900',
          800: '#c45f00',
          900: '#1a1a1a',
        },
        ink: {
          700: '#2b2b2b',
          800: '#181818',
          900: '#0c0c0c',
        },
        road: '#4b5563',
        cream: '#fffdf7',
        gold: '#ffb000',
      },
      boxShadow: {
        soft: '0 18px 60px rgba(15, 23, 42, 0.10)',
      },
    },
  },
  plugins: [],
}
