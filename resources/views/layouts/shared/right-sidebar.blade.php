<!-- Theme Settings -->
<div class="offcanvas offcanvas-end settings-offcanvas" tabindex="-1" id="theme-settings-offcanvas">

    <h6 class="fw-semibold px-3 m-0 py-2 font-16 bg-light">
        <span class="d-block py-2">Theme Settings</span>
    </h6>

    <div class="offcanvas-body">
        <div class="alert alert-warning" role="alert">
            <strong>Customize </strong> the overall color scheme, sidebar menu, etc.
        </div>

        <h5 class="fw-medium font-14 mt-4 mb-2 pb-1">Color Scheme</h5>

        <div class="colorscheme-cardradio">
            <div class="d-flex flex-column gap-2">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="data-bs-theme" id="layout-color-light" value="light">
                    <label class="form-check-label" for="layout-color-light">Light</label>
                </div>

                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="data-bs-theme" id="layout-color-dark" value="dark">
                    <label class="form-check-label" for="layout-color-dark">Dark</label>
                </div>
            </div>
        </div>

        <div id="layout-width">
            <h5 class="fw-medium font-14 mt-4 mb-2 pb-1">Layout Mode</h5>

            <div class="d-flex flex-column gap-2">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="data-layout-mode" id="layout-mode-fluid" value="fluid">
                    <label class="form-check-label" for="layout-mode-fluid">Fluid</label>
                </div>

                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="data-layout-mode" id="layout-mode-boxed" value="boxed">
                    <label class="form-check-label" for="layout-mode-boxed">Boxed</label>
                </div>

                <div id="layout-detached">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="data-layout-mode" id="data-layout-detached" value="detached">
                        <label class="form-check-label" for="data-layout-detached">Detached</label>
                    </div>
                </div>
            </div>
        </div>

        <h5 class="fw-medium font-14 mt-4 mb-2 pb-1">Topbar Color</h5>

        <div class="d-flex flex-column gap-2">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="data-topbar-color" id="topbar-color-light" value="light">
                <label class="form-check-label" for="topbar-color-light">Light</label>
            </div>

            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="data-topbar-color" id="topbar-color-dark" value="dark">
                <label class="form-check-label" for="topbar-color-dark">Dark</label>
            </div>

            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="data-topbar-color" id="topbar-color-brand" value="brand">
                <label class="form-check-label" for="topbar-color-brand">Brand</label>
            </div>
        </div>

        <div>
            <h5 class="fw-medium font-14 mt-4 mb-2 pb-1">Menu Color</h5>

            <div class="d-flex flex-column gap-2">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="data-menu-color" id="leftbar-color-light" value="light">
                    <label class="form-check-label" for="leftbar-color-light">Light</label>
                </div>

                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="data-menu-color" id="leftbar-color-dark" value="dark">
                    <label class="form-check-label" for="leftbar-color-dark">Dark</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="data-menu-color" id="leftbar-color-brand" value="brand">
                    <label class="form-check-label" for="leftbar-color-brand">Brand</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="data-menu-color" id="leftbar-color-gradient" value="gradient">
                    <label class="form-check-label" for="leftbar-color-gradient">Gradient</label>
                </div>
            </div>
        </div>

        <div id="layout-position">
            <h5 class="my-3 font-16 fw-bold">Layout Position</h5>

            <div class="d-flex flex-column gap-2">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="data-layout-position" id="layout-position-fixed" value="fixed">
                    <label class="form-check-label" for="layout-position-fixed">Fixed</label>
                </div>

                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="data-layout-position" id="layout-position-scrollable" value="scrollable">
                    <label class="form-check-label" for="layout-position-scrollable">Scrollable</label>
                </div>
            </div>
        </div>

        <div id="sidebar-size">
            <h5 class="fw-medium font-14 mt-4 mb-2 pb-1">Sidebar Size</h5>

            <div class="d-flex flex-column gap-2">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="data-sidenav-size" id="leftbar-size-default" value="default">
                    <label class="form-check-label" for="leftbar-size-default">Default</label>
                </div>

                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="data-sidenav-size" id="leftbar-size-compact" value="compact">
                    <label class="form-check-label" for="leftbar-size-compact">Compact</label>
                </div>

                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="data-sidenav-size" id="leftbar-size-small" value="condensed">
                    <label class="form-check-label" for="leftbar-size-small">Condensed</label>
                </div>

                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="data-sidenav-size" id="leftbar-size-full" value="full">
                    <label class="form-check-label" for="leftbar-size-full">Full Layout</label>
                </div>

                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="data-sidenav-size" id="leftbar-size-fullscreen" value="fullscreen">
                    <label class="form-check-label" for="leftbar-size-fullscreen">Fullscreen Layout</label>
                </div>
            </div>
        </div>
    </div>


    <div class="offcanvas-footer border-top px-3 py-2 text-center">
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-light w-50" id="reset-layout">Reset</button>
            <a href="https://themeforest.net/item/konrix-tailwind-css-admin-dashboard-template/46001985?ref=coderthemes" class="btn btn-danger w-50" target="_blank"><i class="mdi mdi-basket me-1"></i> Buy</a>
        </div>
    </div>
</div>
