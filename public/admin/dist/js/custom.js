let activeMenu = (mainMenu, subMenu) => {
    setTimeout(() => {
        $(mainMenu).click();
    }, 500);
    $(mainMenu).addClass("active");
    $(subMenu).addClass("active");
};

let loading = () => {
    return `<div class="text-center">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>`;
};
