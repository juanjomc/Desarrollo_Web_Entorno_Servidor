function setCookie(name, value, days) {
    const d = new Date();
    d.setTime(d.getTime() + (days * 24 * 60 * 60 * 1000));
    let expires = "expires=" + d.toUTCString();
    document.cookie = `${name}=${value};${expires};path=/`;
}

function getCookie(name) {
    const cookieArr = document.cookie.split("; ");
    for (let i = 0; i < cookieArr.length; i++) {
        const cookiePair = cookieArr[i].split("=");
        if (name === cookiePair[0]) {
            return cookiePair[1];
        }
    }
    return null;
}

document.addEventListener("DOMContentLoaded", function() {
    const theme = getCookie('theme') || 'light';
    document.getElementById("theme-selector").value = theme;
    setTheme(theme); //Cargamos el tema al inicio, habiendo leido la cookie.

    document.getElementById("theme-selector").addEventListener("change", function() {
        const selectedTheme = this.value;
        setTheme(selectedTheme);
        setCookie('theme', selectedTheme, 30);
    });

    const language = getCookie('language') || 'es';
    document.getElementById("language-selector").value = language;
    setLanguage(language);

    document.getElementById("language-selector").addEventListener("change", function() {
        const selectedLanguage = this.value;
        setLanguage(selectedLanguage);
        setCookie('language', selectedLanguage, 30);
    });

});

function setTheme(theme) {
    const themeStyle = document.getElementById("theme-style");
    themeStyle.href = theme === 'dark' ? 'css/dark.css' : 'css/light.css';
}



