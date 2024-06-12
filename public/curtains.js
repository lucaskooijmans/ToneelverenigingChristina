if (localStorage.getItem('lastCurtainDateTime') === null
    || new Date() - new Date(localStorage.getItem('lastCurtainDateTime')) > 120000) { // 2 minutes
    const curtain = document.createElement('div');
    curtain.classList.add('curtain');
    document.body.appendChild(curtain);

    const curtainLeft = document.createElement('div');
    curtainLeft.classList.add('curtain-left');
    curtain.appendChild(curtainLeft);

    const curtainRight = document.createElement('div');
    curtainRight.classList.add('curtain-right');
    curtain.appendChild(curtainRight);

    localStorage.setItem('lastCurtainDateTime', new Date());

    setTimeout(() => {
        curtain.remove();
    }, 5000);
}