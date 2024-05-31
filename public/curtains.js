if (!localStorage.getItem('visitedBefore')) {
    const curtain = document.createElement('div');
    curtain.classList.add('curtain');
    document.body.appendChild(curtain);

    const curtainLeft = document.createElement('div');
    curtainLeft.classList.add('curtain-left');
    curtain.appendChild(curtainLeft);

    const curtainRight = document.createElement('div');
    curtainRight.classList.add('curtain-right');
    curtain.appendChild(curtainRight);

    setTimeout(() => {
        curtain.remove();
    }, 5000);
    localStorage.setItem('visitedBefore', true);
}