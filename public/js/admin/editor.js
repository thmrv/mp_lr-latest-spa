function darkFix() {
    return document.querySelector('.dark iframe').contentDocument.style.background = 'red'
}

(function () {
    darkFix();
})();
