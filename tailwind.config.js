module.exports = {
  mode: 'jit',
  content: [
    './public/**/*.{html,php,js}',
    './pages/**/*.{html,php,js}',
    './admin/**/*.{html,php.js}'
  ],
  theme: {
    extend: {
      colors:{
        'purple-dark':'rgba(153, 102, 255, 0.2)',
        'red-dark':'rgba(255, 99, 132, 0.2)', 
        'green-dark':'rgba(75, 192, 192, 0.2)',
        'yellow-dark': 'rgba(255, 206, 86, 0.2)',
        'blue-dark': 'rgba(54, 162, 235, 0.2)'
      },
    },
  },
  plugins: [],
}
