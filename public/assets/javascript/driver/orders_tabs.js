const tabBox = document.querySelector('.tab_box');
const tabs = tabBox.querySelectorAll('.tab_btn');
const movingLine = tabBox.querySelector('.line');

tabs.forEach(tab => {
    tab.addEventListener('click', () => {
        const tabWidth = tab.offsetWidth;
        const tabLeft = tab.offsetLeft;
        movingLine.style.width = `${tabWidth}px`;
        movingLine.style.left = `${tabLeft}px`;

        // remove the "active" class from all tabs
        tabs.forEach(t => t.classList.remove('active'));

        // add the "active" class to the clicked tab
        tab.classList.add('active');
    });

    tab.addEventListener('mouseover', () => {
        const tabWidth = tab.offsetWidth;
        const tabLeft = tab.offsetLeft;
        movingLine.style.width = `${tabWidth}px`;
        movingLine.style.left = `${tabLeft}px`;
    });

    tab.addEventListener('mouseout', () => {
        // check if any tab has the "active" class
        const activeTab = tabBox.querySelector('.active');
        if (!activeTab) {
            movingLine.style.width = '0';
        }
    });
});

