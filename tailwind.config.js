/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './*.php',
    './template-parts/**/*.php',
    './assets/js/**/*.js',
    './assets/css/tailwind.css',
  ],
  theme: {
    extend: {
      colors: {
        navy: { DEFAULT: '#1F3A93', light: '#2E4DB3', dark: '#162B70', 50: '#EEF1FB' },
        gold: { DEFAULT: '#F5B041', light: '#F8C470', dark: '#D4922E', 50: '#FEF9EE' },
        teal: { DEFAULT: '#1ABC9C', light: '#2EE0BC', dark: '#14967C', 50: '#E8FBF7' },
        warm: { DEFAULT: '#F9F7F4', dark: '#EDE9E3' },
      },
      fontFamily: {
        sans:    ['"Open Sans"', 'system-ui', 'sans-serif'],
        heading: ['"Open Sans"', 'system-ui', 'sans-serif'],
      },
      maxWidth: {
        site: '1280px',
      },
      spacing: {
        '18': '4.5rem',
        '22': '5.5rem',
      },
      boxShadow: {
        card:         '0 4px 24px rgba(31,58,147,0.08)',
        'card-hover': '0 12px 40px rgba(31,58,147,0.16)',
        nav:          '0 2px 20px rgba(31,58,147,0.10)',
      },
      borderRadius: {
        '2xl': '1rem',
        '3xl': '1.5rem',
      },
      keyframes: {
        fadeUp: {
          '0%':   { opacity: '0', transform: 'translateY(24px)' },
          '100%': { opacity: '1', transform: 'translateY(0)' },
        },
        pulse2: {
          '0%, 100%': { transform: 'scale(1)' },
          '50%':      { transform: 'scale(1.04)' },
        },
      },
      animation: {
        'fade-up': 'fadeUp 0.6s ease forwards',
        'pulse2':  'pulse2 2s ease-in-out infinite',
      },
      aspectRatio: {
        video: '16 / 9',
      },
    },
  },
  plugins: [
    require('@tailwindcss/typography'),
    require('@tailwindcss/forms'),
  ],
}
