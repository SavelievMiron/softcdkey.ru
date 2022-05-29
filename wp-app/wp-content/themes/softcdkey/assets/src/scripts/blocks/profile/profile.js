if (document.getElementById('profile') !== null) {
    const sidebarTabs = document.querySelectorAll('.profile-sidebar__tab'),
    panels = document.querySelectorAll('.profile-panel__tabs'),
    panelTabs = document.querySelectorAll('.profile-panel__tab'),
    tabContents = document.querySelectorAll('.profile-panel__content');

    if (sidebarTabs.length !== 0) {
        sidebarTabs.forEach((tab) => {
            tab.addEventListener('click', (e) => {
                const tab = e.target,
                panel = document.querySelector(`[data-panel=${tab.dataset.tab}]`),
                tabContent = document.querySelector(`[data-tab-content=${tab.dataset.tab}]`);

                sidebarTabs.forEach((el) => el.classList.remove('is-active'));
                panels.forEach((el) => el.classList.remove('is-active'));
                tabContents.forEach((el) => el.classList.remove('is-active'));

                tab.classList.add('is-active');
                panel.classList.add('is-active');
                tabContent.classList.add('is-active');
            });
        })
    }

    if (panelTabs.length !== 0) {
        panelTabs.forEach((tab) => {
            tab.addEventListener('click', (e) => {
                const tab = e.target,
                panel = tab.closest('.profile-panel__tabs'),
                panelTabContent = document.querySelector(`[data-panel-content=${tab.dataset.panel_tab}]`),
                panelContent = panelTabContent.closest('.profile-panel__content');

                Array.prototype.forEach.call(panel.children, function (el) {
                    el.classList.remove('is-active');
                });
                Array.prototype.forEach.call(panelContent.children, function (el) {
                    el.classList.remove('is-active');
                });

                tab.classList.add('is-active');
                panelTabContent.classList.add('is-active');
            });
        })
    }

}
