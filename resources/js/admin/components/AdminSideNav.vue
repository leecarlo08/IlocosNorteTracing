<template>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <router-link class="nav-link" to="/super-user">
                                Home
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link" to="/super-user/schedule">
                                Schedules
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link" to="/super-user/reports">
                                Tourist Reporting
                            </router-link>
                        </li>
                    </ul>
                    <hr>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <router-link class="nav-link" to="/super-user/accounts">
                                Site Officer Accounts
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link" to="/super-user/spot">
                                Tourist Spot
                            </router-link>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</template>
