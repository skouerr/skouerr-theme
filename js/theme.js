import '../src/styles/style.scss'


document.addEventListener("DOMContentLoaded", function() {
    // Your JS code here
    console.log('Hello Skouerr');

    handlePage404();



});


const handlePage404 = () => {
    const historyBackButton = document.querySelector('.history-back');
    if (historyBackButton) {
        historyBackButton.addEventListener('click', () => {
            window.history.back();
        });
    }
}