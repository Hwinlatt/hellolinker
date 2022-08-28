

let activeMenu = (mainMenu, subMenu) => {
    setTimeout(() => {
        $(mainMenu).click();
    }, 500);
    $(mainMenu).addClass('active');
    $(subMenu).addClass('active');
}
