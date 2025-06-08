document.addEventListener("DOMContentLoaded", () => {
    const f = async () => await RefreshRanking();
    f();
    setInterval(f, 5000);

})