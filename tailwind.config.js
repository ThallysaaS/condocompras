import preset from './vendor/filament/support/tailwind.config.preset'
 
module.exports = {
    content: [
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
        './resources/css/**/*.css',
    ],
    theme: {
        extend: {
            colors: {
                primary: '#1d4ed8', // Cor personalizada
            },
        },
    },
};
